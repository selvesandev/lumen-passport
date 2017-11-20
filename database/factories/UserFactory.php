<?php

$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'uid' => str_random(32),
        'firstName' => $faker->firstName,
        'lastName' => $faker->lastName,
        'email' => $faker->email,
        'middleName' => $faker->lastName,
//        'cust_password' => \Illuminate\Support\Facades\Hash::make('secret'),
        'address' => $faker->address,
        'zipCode' => $faker->postcode,
        'username' => $faker->userName,
        'city' => $faker->city,
        'state' => $faker->state,
        'country' => $faker->country,
        'phone' => $faker->phoneNumber,
        'mobile' => $faker->phoneNumber,
        'role' => \App\User::BASIC_ROLE,
        'isActive' => rand(0, 1),
        'profileImage' => $faker->imageUrl('100')
    ];
});


$factory->define(\App\Login::class, function (\Faker\Generator $faker) use ($factory) {
    return [
        'uid' => factory(\App\User::class)->create()->uid,
        'password' => \Illuminate\Support\Facades\Hash::make('secret'),
    ];
});