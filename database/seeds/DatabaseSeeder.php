<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(PoiTableSeeder::class);
        factory(\App\Poi::class, 10)->create();
    });
    }
}
