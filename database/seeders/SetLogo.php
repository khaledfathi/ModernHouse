<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SetLogo extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\SettingModel::create(['key'=>'logo' , 'value'=>'assets/images/logo/modern_house_logo.png']); 
    }
}
