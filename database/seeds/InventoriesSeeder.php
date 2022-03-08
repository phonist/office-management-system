<?php

use Illuminate\Database\Seeder;

class InventoriesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('inventories')->insert([
            [
                'name' => 'tiger barb',
                'model_no'  => 'tiger',
                's_price' => '12.11',
                's_information' => 'fishes',
                'p_price' => '13.11',
                'p_information' => 'fishes for testing',
                'quantity' => '23',
                'category_id' => 3,
                'tax_id' => 2,
            ],[
                'name' => 'monitor',
                'model_no'  => 'screen',
                's_price' => '120.11',
                's_information' => 'office',
                'p_price' => '120.11',
                'p_information' => 'for office used',
                'quantity' => '20',
                'category_id' => 1,
                'tax_id' => 2,
            ],[
                'name' => 'laptop',
                'model_no'  => 'lenovo',
                's_price' => '2590.11',
                's_information' => 'office',
                'p_price' => '2610.21',
                'p_information' => 'for working',
                'quantity' => '12',
                'category_id' => 2,
                'tax_id' => 2,
            ]
        ]);
    }
}
