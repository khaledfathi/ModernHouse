<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        \App\Models\User::create([
            'name' => 'admin',
            'phone'=>'01002049971',
            'password'=> Hash::make('admin'),
            'type'=>'admin', 
            'status'=>'enabled'
        ]);
        
        $projectStatus = [
            'قيد التنفيذ',
            'تم التسليم',
            'تم التسليم ولدية مديونية',
            'انتهى ولم يتم التسليم',
            'مؤجل',
        ]; 
        foreach($projectStatus as $status){
            \App\Models\ProjectStatusModel::create([
                'status'=>$status

            ]); 
        }
    }
}
