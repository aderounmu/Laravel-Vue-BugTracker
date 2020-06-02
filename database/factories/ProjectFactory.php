<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Project::class, function (Faker $faker) {
    return [
        //
        'Title' => $faker->text(50),
        'Description' => $faker->text(200),
        'created_by'=> $faker->randomElement([1,2,3,4,5,6,7,8,9,10])
    ];
});
