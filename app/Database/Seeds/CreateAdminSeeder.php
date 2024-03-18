<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class CreateAdminSeeder extends Seeder
{
    public function run()
    {
        $adminExists = $this->db->table('users')->where('isAdmin', true)->countAllResults() > 0;
        if (!$adminExists) {
            $adminData = [
                'name' => 'admin',
                'email'    => 'admin@example.com',
                'phoneNumber' => '1234567897',
                'password' => base64_encode(\Config\Services::encrypter()->encrypt('admin')),
                'isAdmin' => true,
            ];

            // Insert the data into the 'users' table
            $this->db->table('users')->insert($adminData);
        }
    }
}