<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Str;

class JobCategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('job_categories')->insert([
            [
                'id' => Str::uuid(),
                'category' => 'Craft Workers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'category' => 'Laborers and Helpers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'category' => 'Office and Clerical Workers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'category' => 'Officials and Managers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'category' => 'Operatives',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'category' => 'Professionals',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'category' => 'Sales Workers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'category' => 'Service Workers',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'category' => 'Software Developer',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'category' => 'Technical Officer',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id' => Str::uuid(),
                'category' => 'Technicians',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ]
        ]);
    }
}
