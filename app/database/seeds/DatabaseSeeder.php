<?php

use App\Autopark;
use App\Car;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);

        factory(Autopark::class, 5)->create();
        factory(Car::class, 20)->create()->each(function($car) {
            $car->autoparks()->sync(
                Autopark::all()->random(3)
            );
        });
    }
}
