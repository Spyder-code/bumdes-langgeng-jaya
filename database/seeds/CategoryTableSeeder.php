<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::create([
            'type'      => 0,
            'nama'      => "Daging Segar"
        ]);
        Category::create([
            'type'      => 0,
            'nama'      => "Sayuran"
        ]);
        Category::create([
            'type'      => 0,
            'nama'      => "Empon-empon"
        ]);
        Category::create([
            'type'      => 0,
            'nama'      => "Buah Segar"
        ]);
        Category::create([
            'type'      => 0,
            'nama'      => "Ikan Segar"
        ]);
        Category::create([
            'type'      => 0,
            'nama'      => "Mentega & Telur"
        ]);
        Category::create([
            'type'      => 0,
            'nama'      => "Bahan Memasak"
        ]);
        Category::create([
            'type'      => 0,
            'nama'      => "Kebutuhan Sehari-hari"
        ]);
        Category::create([
            'type'      => 0,
            'nama'      => "Makanan Ringan"
        ]);
        Category::create([
            'type'      => 0,
            'nama'      => "Minuman"
        ]);
        Category::create([
            'type'      => 0,
            'nama'      => "lain-lain"
        ]);
        Category::create([
            'type'      => 1,
            'nama'      => "Kesehatan"
        ]);
        Category::create([
            'type'      => 1,
            'nama'      => "Tips & Trick"
        ]);
        Category::create([
            'type'      => 1,
            'nama'      => "Perkebunan"
        ]);
        Category::create([
            'type'      => 1,
            'nama'      => "Perikanan"
        ]);
        Category::create([
            'type'      => 1,
            'nama'      => "Pelayaran"
        ]);
        Category::create([
            'type'      => 1,
            'nama'      => "Teknologi"
        ]);
    }
}
