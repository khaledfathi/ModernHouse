<?php 
use App\Models\SettingModel;

function Logo (){
    //get relative path for logo image from settings table on database
    $found = SettingModel::where('key' , 'logo')->first(); 
    if ($found){
        return $found->value;

    }
}