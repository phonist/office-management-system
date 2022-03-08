<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\User;
use Illuminate\Support\Str;

class LeaveTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('leave_types')->insert([
            [
                'id'=> Str::uuid(),
                'name' => 'Sick Leave',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id'=> Str::uuid(),
                'name' => 'Earn Leave',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id'=> Str::uuid(),
                'name' => 'Yearly Leave',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ],[
                'id'=> Str::uuid(),
                'name' => 'Medical Leave',
                'created_at'=> Carbon::now(),
                'updated_at'=> Carbon::now(),
                'user_id' => User::all()->random()->id
            ]

        ]);
    }
}
