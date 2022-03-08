<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Str;

class DepartmentTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('departments')->insert([
            [
                'id'   => Str::uuid(),
                'name' => 'QA Department',
                'description' =>  'QA Department',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id'   => Str::uuid(),
                'name' => 'Software Development',
                'description' =>  'Software Development',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id'   => Str::uuid(),
                'name' => 'Management',
                'description' =>  'Management',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id'   => Str::uuid(),
                'name' => 'Human Resource',
                'description' =>  'Human Resource',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id'   => Str::uuid(),
                'name' => 'Sales & Marketing',
                'description' =>  'Sales & Marketing',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id'   => Str::uuid(),
                'name' => 'Accounts',
                'description' =>  'Accounts',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id'   => Str::uuid(),
                'name' => 'Engineer',
                'description' =>  'Engineer',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ]
        ]);
    }
}
