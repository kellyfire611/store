<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon\Carbon::now();
        DB::table('users')->insert(
            [
                ['id' => 1, 'name' => 'sysadmin', 'email' => 'sysadmin@sysadmin.com', 'password' => Hash::make('sysadmin'), 'created_at' => $now]
            ]
        );

        DB::statement('ALTER TABLE `users` AUTO_INCREMENT=1;');
    }
}
