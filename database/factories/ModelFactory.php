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

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'status'         => 'active',
        'remember_token' => str_random(10),
        'role_id'        => $faker->numberBetween(1,2)
    ];
});

$factory->define(App\Client::class, function (Faker\Generator $faker) {
    return [
        'name'       => $faker->company,
        'website'    => $faker->url,
        'logo'       => $faker->imageUrl,
        'created_at' => Carbon::now()
    ];
});

$factory->define(App\Project::class, function (Faker\Generator $faker) {

    $random_number = $faker->randomDigitNotNull;
    $date = new DateTimeImmutable($faker->dateTimeThisMonth->format('Y-m-d H:i:s'));
    $end = $date->modify('+'.$random_number.' days');

    return [
        'name'        => $faker->catchPhrase,
        'description' => $faker->paragraph,
        'client_id'   => NULL,
        'category_id' => NULL,
        'work_hours'  => round( $faker->randomFloat(NULL, 1, 200), 1 ),
        'start_date'  => $date,
        'end_date'    => $end,
        'status'      => $faker->randomElement( ['not started','pending','in progress','stalled','completed'] ),
        'created_at'  => Carbon::now()
    ];
});

$factory->define(App\Task::class, function (Faker\Generator $faker) {

    $random_number = $faker->randomDigitNotNull;
    $date = new DateTimeImmutable($faker->dateTimeThisMonth->format('Y-m-d H:i:s'));
    $end = $date->modify('+'.$random_number.' days');

    return [
        'name'       => $faker->catchPhrase,
        'user_id'    => $faker->numberBetween(1,11),
        'body'       => $faker->paragraph,
        'task_time'  => round( $faker->randomFloat(NULL, 1, 200), 1 ),
        'start_date' => $date,
        'end_date'   => $end,
        'status'     => $faker->randomElement( ['not started','pending','in progress','stalled','completed'] ),
        'created_at' => Carbon::now()
    ];
});


$factory->define(App\Time::class, function (Faker\Generator $faker) {

    $date = new DateTimeImmutable($faker->dateTimeThisMonth->format('Y-m-d H:i:s'));
    $hours = round( $faker->randomFloat(NULL, 1, 8) * 4 ) / 4;

    return [
        'hours'       => $hours,
        'description' => $faker->paragraph,
        'user_id'     => $faker->numberBetween(1,11),
        'task_id'     => $faker->numberBetween(1,500),
        'created_at'  => $date,
    ];
});
