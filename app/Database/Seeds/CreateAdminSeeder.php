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
                'password' => \Config\Services::encrypter()->encrypt('admin'),
                'isVerified' => true,
                'isAdmin' => true,
                'createdAt' => time(),
                'updatedAt' => time(),
            ];

            // Insert the data into the 'users' table
            $this->db->table('users')->insert($adminData);
        }
    }
}
