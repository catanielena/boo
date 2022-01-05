<?php

use Illuminate\Database\Seeder;
use App\Cuisine;
use Illuminate\Support\Str;

class CuisinesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        
        $cuisines = [
            [
                "name" => "Americano",
                "image" => "https://drive.google.com/file/d/1IKQmtNsdnYCSMsRAvH_gSTo_3JMMRiRr/view?usp=sharing"
            ], 
            [
                "name" => "Cinese",
                "image" => "https://drive.google.com/file/d/1SiPdUIdibzvzJJ7uXoMmWt5Z9Y0JKQXu/view?usp=sharing"
            ], 
            [
                "name" => "Giapponese",
                "image" => "https://drive.google.com/file/d/1qLAr3d2MBtjuqWepqkRcZEfIxSJPbfjQ/view?usp=sharing"
            ], 
            [
                "name" => "Hamburger",
                "image" => "https://drive.google.com/file/d/16Rzdz0IzgP3jVaeuuimA0fPV1Rl_R8Ci/view?usp=sharing"
            ], 
            [
                "name" => "Italiano",
                "image" => "https://drive.google.com/file/d/1mwhsvJUO1Aku384Ww3Kk0Kyo3DJga7Tw/view?usp=sharing"
            ], 
            [
                "name" => "Piadine",
                "image" => "https://drive.google.com/file/d/1KEBOp_Zq7mUsm63_dqCmgqw2Y9wszJoR/view?usp=sharing"
            ], 
            [
                "name" => "Pizza",
                "image" => "https://drive.google.com/file/d/166SrYGOYFohy3--mM8GMuE3T6qNHf0Nl/view?usp=sharing"
            ],
        ];

        foreach($cuisines as $cuisine)
        {
            $newCuisine = new Cuisine();
            $newCuisine->name = $cuisine["name"];
            $newCuisine->image = $cuisine["image"];
            $newCuisine->slug = Str::of($cuisine["name"])->slug('-');
            $newCuisine->save();
        }
    }
}
