<?php namespace App\Database\Seeds;

class CategorySeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data1 = [
            'category_name'     => 'Masakan',
            'category_status'   => 'Active'
        ];
        $data2 = [
            'category_name'     => 'Minuman',
            'category_status'   => 'Active'
        ];
        $this->db->table('categories')->insert($data1);
        $this->db->table('categories')->insert($data2);
    }
} 