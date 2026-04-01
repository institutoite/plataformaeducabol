<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

use App\Models\Price;

class PriceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Price::create([
            'name' => 'Bs. 30',
            'value' => 30
        ]);

        Price::create([
            'name' => 'Bs. 40',
            'value' => 40
        ]);

        Price::create([
            'name' => 'Bs. 50',
            'value' => 50
        ]);
    }
}
