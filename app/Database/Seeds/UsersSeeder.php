<?php

namespace App\Database\Seeds;

use CodeIgniter\Database\Seeder;

class UsersSeeder extends Seeder
{
    public function run()
    {
        $guestUser = [
            'name' => 'Convidado',
            'email'    => 'guest@guest.com',
            'password' => password_hash('guest', PASSWORD_DEFAULT),
            'profile_type' => 'guest',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($guestUser);

        $adminUser = [
            'name' => 'Administrador',
            'email'    => 'admin@admin.com',
            'password' => password_hash('admin', PASSWORD_DEFAULT),
            'profile_type' => 'admin',
            'created_at' => date('Y-m-d H:i:s'),
        ];

        $this->db->table('users')->insert($adminUser);
    }
}
