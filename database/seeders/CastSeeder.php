<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class Cast extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        cast::create([
            'name' => 'admin',
            'image' => 'https://tse1.mm.bing.net/th?id=OIP.fNG_Oy2iFH8jI_fE_VgXIgHaHa&pid=Api&P=0',
            'role' => 'admin'
        ]);
    }
}
