<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class WorkingDaysTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('working_days')->insert([
            [
                'id' => Str::uuid(),
                'day' => 'saturday',
                'work'=> 0,
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'day' => 'sunday',
                'work'=> 0,
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'day' => 'monday',
                'work'=> 1,
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'day' => 'tuesday',
                'work'=> 1,
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'day' => 'wednesday',
                'work'=> 1,
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'day' => 'thursday',
                'work'=> 1,
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'day' => 'friday',
                'work'=> 1,
                'user_id' => User::all()->random()->id
            ]
        ]);
    }
}
