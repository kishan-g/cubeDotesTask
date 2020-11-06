<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            [
                'name' => 'super admin',
                'email' => 'superadmin@gmail.com',
                'password' => '$2y$10$z2/jVlFipMlurGPzVNttpegs0JzLR2wD8CHSO4ik4bhHs1aij6KKi', // password
            ],
            [
                'name' => 'editor',
                'email' => 'editor@gmail.com',
                'password' => '$2y$10$z2/jVlFipMlurGPzVNttpegs0JzLR2wD8CHSO4ik4bhHs1aij6KKi', // password
            ],
            [
                'name' => 'reader',
                'email' => 'reader@gmail.com',
                'password' => '$2y$10$z2/jVlFipMlurGPzVNttpegs0JzLR2wD8CHSO4ik4bhHs1aij6KKi', // password
            ],
        ]);
    }
}
