<?php

use Illuminate\Database\Seeder;
use App\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Company::create([
            'nama'        => "Warung Beta",
            'alamat'      => "kalidami gang VII no 4 SBY",
            'nomor'       =>  "+62 812-3454-0202",
            'open_at'     =>  "07:00",
            'closed_at'   =>  "21:00",
        ]);
    }
}
