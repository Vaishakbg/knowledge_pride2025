<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CountryCitySeeder extends Seeder
{
    public function run(): void
    {
        // Insert Countries
        $countries = [
            ['name' => 'United States', 'code' => 'US', 'currency_name' => 'United States Dollar', 'currency_code' => 'USD', 'currency_symbol' => '$', 'rate' => 1.00],
            ['name' => 'India', 'code' => 'IN', 'currency_name' => 'Indian Rupee', 'currency_code' => 'INR', 'currency_symbol' => '₹', 'rate' => 74.50],
            ['name' => 'United Kingdom', 'code' => 'GB', 'currency_name' => 'British Pound', 'currency_code' => 'GBP', 'currency_symbol' => '£', 'rate' => 0.82],
            ['name' => 'Canada', 'code' => 'CA', 'currency_name' => 'Canadian Dollar', 'currency_code' => 'CAD', 'currency_symbol' => 'C$', 'rate' => 1.30],
            ['name' => 'Australia', 'code' => 'AU', 'currency_name' => 'Australian Dollar', 'currency_code' => 'AUD', 'currency_symbol' => 'A$', 'rate' => 1.40],
        ];

        DB::table('countries')->insert($countries);

        // Get Country IDs
        $countriesMap = DB::table('countries')->pluck('id', 'code');

        // Insert Cities
        $cities = [
            ['name' => 'New York', 'country_id' => $countriesMap['US']],
            ['name' => 'Los Angeles', 'country_id' => $countriesMap['US']],
            ['name' => 'Mumbai', 'country_id' => $countriesMap['IN']],
            ['name' => 'Delhi', 'country_id' => $countriesMap['IN']],
            ['name' => 'London', 'country_id' => $countriesMap['GB']],
            ['name' => 'Manchester', 'country_id' => $countriesMap['GB']],
            ['name' => 'Toronto', 'country_id' => $countriesMap['CA']],
            ['name' => 'Vancouver', 'country_id' => $countriesMap['CA']],
            ['name' => 'Sydney', 'country_id' => $countriesMap['AU']],
            ['name' => 'Melbourne', 'country_id' => $countriesMap['AU']],
        ];

        DB::table('cities')->insert($cities);
    }
}
