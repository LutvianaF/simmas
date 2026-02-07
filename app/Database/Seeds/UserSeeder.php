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
                'email' => 'siswa@gmail.com',
                'password' => password_hash('siswa', PASSWORD_BCRYPT),
                'role' => 'siswa'
            ],
            [
                'name' => 'Lutviana',
                'email' => 'guru@gmail.com',
                'password' => password_hash('guru', PASSWORD_BCRYPT),
                'role' => 'guru'
            ]
        ];
        $this->db->table('users')->insertBatch($data);
    }
}
