<?php

use App\Enums\{RoleEnum, SexEnum};
use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            'firstname' => str_random(10),
            'lastname' => str_random(10),
            'birthday' => '0001-01-01',
            'email' => 'sudo@root.fr',
            'email_verified_at' => Carbon::now()->format('Y-m-d H:i:s'),
            'password' => bcrypt('rootpassword'),
            'role' => RoleEnum::ADMIN,
            'sex' => SexEnum::MALE,
        ]);
    }
}
