<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(App\Bug::class, function (Faker $faker) {
    return [
        'Title' => $faker->text(50),
        'Description' => $faker->text(200),
        'Category'=> $faker->randomElement(array('Design','Production','Testing','Development')),
        'Priority' => $faker->randomElement(array('Closed','Open','Processing')),
        'Sprint'=> $faker->text(7),
        'Version'=> $faker->text(7),
        'Environment'=> $faker->text(7),
        'Components'=> $faker->text(7),
        'Labels'=> $faker->text(7),

        //foreign keys
        'project_id' => $faker->randomElement([1,2,3,4,5,6,]),
        'created_by'=> $faker->randomElement([1,2,3,4,5,6,7,8,9,10]),
    ];
});
