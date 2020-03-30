<?php namespace Config;

class Validation
{
	public $ruleSets = [
		\CodeIgniter\Validation\Rules::class,
		\CodeIgniter\Validation\FormatRules::class,
		\CodeIgniter\Validation\FileRules::class,
		\CodeIgniter\Validation\CreditCardRules::class,
	];

	public $templates = [
		'list'   => 'CodeIgniter\Validation\Views\list',
		'single' => 'CodeIgniter\Validation\Views\single',
	];

	public $category = [
        'category_name'     => 'required',
        'category_status'     => 'required'
	];
	
	public $category_errors = [
        'category_name' => [
            'required'    => 'Nama category wajib diisi.',
        ],
        'category_status'    => [
            'required' => 'Status category wajib diisi.'
        ]
	];
	
	public $product = [
		'category_id'           => 'required',
		'product_name'          => 'required',
		'product_price'         => 'required',
		'product_sku'           => 'required',
		'product_status'        => 'required',
		'product_image'         => 'uploaded[product_image]|mime_in[product_image,image/jpg,image/jpeg,image/gif,image/png]|max_size[product_image,1000]',
		'product_description' 	=> 'required'
	];

	public $product_errors = [
		'category_id' 	=> [
			'required' 	=> 'Nama category wajib diisi.',
		],
		'product_name'	=> [
			'required' 	=> 'Nama product wajib diisi.'
		],
		'product_price' => [
			'required' 	=> 'Harga product wajib diisi.'
		],
		'product_sku'  	=> [
			'required' 	=> 'Kode product wajib diisi.'
		],
		'product_status'=> [
			'required' 	=> 'Status product wajib diisi.'
		],
		'product_image'=> [
			'mime_in' 	=> 'Gambar product hanya boleh diisi dengan jpg, jpeg, png atau gif.',
			'max_size'	=> 'Gambar product maksimal 1mb',
			'uploaded'	=> 'Gambar product wajib diisi'
		],
		'product_description'   => [
			'required' 			=> 'Description product wajib diisi.'
		]
	];

	public $transaction = [
		'trx_file'         => 'uploaded[trx_file]|ext_in[trx_file,xls,xlsx]|max_size[trx_file,1000]',
	];

	public $transaction_errors = [
		'trx_file'=> [
			'ext_in' 	=> 'File Excel hanya boleh diisi dengan xls atau xlsx.',
			'max_size'	=> 'File Excel product maksimal 1mb',
			'uploaded'	=> 'File Excel product wajib diisi'
		]
	];
}
