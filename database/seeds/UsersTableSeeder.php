<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = [
            [
                'id' => Str::uuid(),
                'email' => 'admin@byteoffice.com',
                'name' => 'admin',
                'f_name' => 'buzzer',
                'l_name' => 'admin',
                'terminate_status'=>false,
                'id_number' => 'b02321',
                'password' => bcrypt('123qwe'),
                'role'=>'admin'
            ]
        ];
        foreach($users as $key => $value){
            User::create($value);
        }
    }
}
