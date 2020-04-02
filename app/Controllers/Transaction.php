<?php namespace App\Controllers;

use CodeIgniter\Controller;
use App\Models\Product_model;
use App\Models\Transaction_model;

use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
 
class Transaction extends Controller
{
    protected $helpers = [];

    public function __construct()
    {
        helper(['form']);
        $this->transaction_model = new Transaction_model();
        $this->product_model = new Product_model();
    }

    public function index()
    {
        $data['transactions'] = $this->transaction_model->getTransaction();
        echo view('transaction/index', $data);
    }

    public function import()
    {
        echo view('transaction/import');
    }

    public function proses_import()
    {
        $validation =  \Config\Services::validation();

        $file = $this->request->getFile('trx_file');

        $data = array(
            'trx_file'           => $file,
        );

        if($validation->run($data, 'transaction') == FALSE){

            session()->setFlashdata('errors', $validation->getErrors());
            return redirect()->to(base_url('transaction/import'));
        
        } else {

            // ambil extension dari file excel
            $extension = $file->getClientExtension();
            
            // format excel 2007 ke bawah
            if('xls' == $extension){
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xls();
            // format excel 2010 ke atas
            } else {
                $reader = new \PhpOffice\PhpSpreadsheet\Reader\Xlsx();
            }
            
            $spreadsheet = $reader->load($file);
            $data = $spreadsheet->getActiveSheet()->toArray();

            foreach($data as $idx => $row){
                
                // lewati baris ke 0 pada file excel
                // dalam kasus ini, array ke 0 adalahpara title
                if($idx == 0) {
                    continue;
                }
                
                // get product_id from excel
                $product_id     = $row[0];
                // get trx_date from excel
                $trx_date       = $row[1];
                // tampilkan harga product berdasarkan product_id menggunakan function getTrxPrice()
                $trx_price      = $this->getTrxPrice($row[0]);

                $data = [
                    "product_id"    => $product_id,
                    "trx_date"      => date('Y-m-d', strtotime($trx_date)),
                    "trx_price"     => $trx_price
                ];

                $simpan = $this->transaction_model->insertTransaction($data);
            }

            if($simpan)
            {
                session()->setFlashdata('success', 'Imported Transaction successfully');
                return redirect()->to(base_url('transaction')); 
            }
        }
    }

    public function getTrxPrice($product_id)
    {
        $price = $this->product_model->getPrice($product_id);
        $data = $price['product_price'];
        return $data;
    }

    public function export()
    {
        // ambil data transaction dari database
        $transactions = $this->transaction_model->getTransaction();
        // panggil class Sreadsheet baru
        $spreadsheet = new Spreadsheet;
        // Buat custom header pada file excel
        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1', 'No')
                    ->setCellValue('B1', 'Product')
                    ->setCellValue('C1', 'Date')
                    ->setCellValue('D1', 'Price');
        // define kolom dan nomor
        $kolom = 2;
        $nomor = 1;
        // tambahkan data transaction ke dalam file excel
        foreach($transactions as $data) {

            $spreadsheet->setActiveSheetIndex(0)
                        ->setCellValue('A' . $kolom, $nomor)
                        ->setCellValue('B' . $kolom, $data['product_name'])
                        ->setCellValue('C' . $kolom, date('j F Y', strtotime($data['trx_date'])))
                        ->setCellValue('D' . $kolom, "Rp. ".number_format($data['trx_price']));

            $kolom++;
            $nomor++;

        }
        // download spreadsheet dalam bentuk excel .xlsx
        $writer = new Xlsx($spreadsheet);

        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename="Laporan_Transaction.xlsx"');
        header('Cache-Control: max-age=0');

        $writer->save('php://output');
    }
}