<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => bcrypt(str_random(10)),
        'remember_token' => str_random(10),
    ];
});

$factory->define( App\Customer::class, function( Faker\Generator $faker ) {
	return [
		'user_id' => 1,
		'first_name' => $faker->firstName,
		'last_name' => $faker->lastName,
		'name' => $faker->name,
		'email' => $faker->email
	];
});

$factory->define( App\Transaction::class, function( Faker\Generator $faker ) {
	return [
		'customer_id' => rand( 1, 10 ),
		'amazon_order_id' => '002-0815581-0329' . rand( 100, 999 ),
		'recipient_email' => $faker->email,
		'recipient_name' => $faker->name,
		'total' => $faker->randomFloat( 2, 10, 150 )
	];
});