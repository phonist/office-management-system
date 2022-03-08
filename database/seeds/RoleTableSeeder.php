<?php

use Illuminate\Database\Seeder;
use App\Role;
use App\User;
use Illuminate\Support\Str;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $role=[
            [
                'id' => Str::uuid(),
                'name' => 'admin',
                'display_name' => 'System admin',
                'description' => 'Have all permission',
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'name'=>  'user',
                'display_name'=> 'User',
                'description'=> 'Have limited permission',
                'user_id' => User::all()->random()->id
            ]
        ];
        foreach($role as $key => $value){
            Role::create($value);
        }
    }
}
