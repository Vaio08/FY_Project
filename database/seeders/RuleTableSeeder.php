<?php

namespace Database\Seeders;

use App\Models\Rule;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RuleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rule::create(['name' => 'Min_age']);
        Rule::create(['name' => 'Max_age']);
        Rule::create(['name' => 'Occupation']);
        Rule::create(['name' => 'Max_time']);
    }
}
