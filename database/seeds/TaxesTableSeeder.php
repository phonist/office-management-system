<?php

use Illuminate\Database\Seeder;
use App\User;
use Illuminate\Support\Str;

class TaxesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   

        DB::table('taxes')->insert([
            [
                'id'   => Str::uuid(),
                'name' => 'GST 50',
                'rate' =>  15,
                'type' => 'Percentage',
                'user_id' => User::all()->random()->id
            ],[
                'id'   => Str::uuid(),
                'name' => 'GST 0%',
                'rate' => 0,
                'type' => 'Percentage',
                'user_id' => User::all()->random()->id
            ],[
                'id'   => Str::uuid(),
                'name' => 'GST 15%',
                'rate' => 50,
                'type' => 'Percentage',
                'user_id' => User::all()->random()->id
            ]
        ]);
    }
}
