<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        $data = [
            [
                'name' => 'Lutviana',
                'email' => 'adminku@gmail.com',
                'password' => password_hash('admin', PASSWORD_BCRYPT),
                'role' => 'admin'
            ],
            [
                'name' => 'Fifian',
                'email' => 'siswa@gmail.com',
                'password' => password_hash('siswa', PASSWORD_BCRYPT),
                'role' => 'siswa'
            ],
            [
                'name' => 'Evidah',
                'email' => 'guru@gmail.com',
                'password' => password_hash('guru', PASSWORD_BCRYPT),
                'role' => 'guru'
            ]
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
