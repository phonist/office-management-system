<?php

use Illuminate\Database\Seeder;
use Carbon\Carbon;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clients')->insert([
            [
                'name' => 'Client_name',
                'company' => 'ZWEEC Analytic Pte Ltd',
                'phone' => '12345678',
                'open_balance' => '',
                'fax' => '',
                'email' => 'user@zweec.com',
                'website' => 'https://google.com',
                'billing_address'=> '67, Ayer Rajah Crescent, #07-21/26',
                'shipping_address'=> '67, TechCom',
                'note' => 'Water Security',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ],[
                'name' => 'Client_name_2',
                'company' => 'Secur Tec',
                'phone' => '87654321',
                'open_balance' => '',
                'fax' => '',
                'email' => 'user@zweec.com',
                'website' => 'https://google.com',
                'billing_address'=> '67, Ayer Rajah Crescent, #07-21/26',
                'shipping_address'=> '67, TechCom',
                'note' => 'Security',
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
