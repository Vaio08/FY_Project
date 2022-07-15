<?php

namespace Database\Seeders;

use App\Models\InsuranceCategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class InsuranceCategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('insurance_categories')->insert([
            'name' => 'Life',
        ]);

        DB::table('insurance_categories')->insert([
            'name' => 'Health',
        ]);

        DB::table('insurance_categories')->insert([
            'name' => 'Car',
        ]);
    }
}
