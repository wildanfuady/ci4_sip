<?php namespace App\Database\Seeds;

class AdminSeeder extends \CodeIgniter\Database\Seeder
{
    public function run()
    {
        $data = [
            'username'  => 'admin',
            'name'      => 'Admin',
            'email'     => 'admin@example.com',
            'password'  => '$2y$10$sOKww3LkoNzBtuW5SKxcJOVcY5eN3L1UsTMZpzgWLDd5MfiZ2mmNe',
            'status'    => 'Active',
            'level'     => 'Admin'
        ];
        $this->db->table('users')->insert($data);
    }
} 