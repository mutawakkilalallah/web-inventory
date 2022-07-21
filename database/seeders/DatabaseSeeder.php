<?php

namespace Database\Seeders;

use DateTime;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Seeder Data User
        DB::table('users')->insert(
            [
                'name' => "Mrs. Rifqoh",
                'username' => "cahh",
                'password' => Hash::make(1234),
                'role' => 'field-manager',
                'created_by' => 1,
                'created_at' => new DateTime(),
                'updated_by' => 1,
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => "Mrs. Alfi",
                'username' => "picu",
                'password' => Hash::make(1234),
                'role' => 'team-field',
                'created_by' => 1,
                'created_at' => new DateTime(),
                'updated_by' => 1,
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('users')->insert(
            [
                'name' => "Mrs. Az Zahroh",
                'username' => "puput",
                'password' => Hash::make(1234),
                'role' => 'manager',
                'created_by' => 1,
                'created_at' => new DateTime(),
                'updated_by' => 1,
                'updated_at' => new DateTime(),
            ]
        );

        // Seeder Data Model
        DB::table('types')->insert(
            [
                'model' => "C-100",
                'type' => "Acces Point",
                'desc' => 'AP C100',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('types')->insert(
            [
                'model' => "FWR-8610RW",
                'type' => "RF TV",
                'desc' => 'RF TV FULLWELL',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('types')->insert(
            [
                'model' => "G-010G-A",
                'type' => "ONT",
                'desc' => 'ONT 1 Port Alcatel',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('types')->insert(
            [
                'model' => "G-010G-Q",
                'type' => "ONT",
                'desc' => 'ONT 1 Port Nokia',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('types')->insert(
            [
                'model' => "G-140W-H",
                'type' => "ONT",
                'desc' => 'ONT 4 Port Nokia',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('types')->insert(
            [
                'model' => "G-241W-A",
                'type' => "ONT",
                'desc' => 'ONT 4 Port Alcatel',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('types')->insert(
            [
                'model' => "HA-020W-B",
                'type' => "Acces Point",
                'desc' => 'AP Beacon',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('types')->insert(
            [
                'model' => "HWC53",
                'type' => "STB",
                'desc' => 'STB TV',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('types')->insert(
            [
                'model' => "OFN50-WD",
                'type' => "RF TV",
                'desc' => 'RF TV Astro',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('types')->insert(
            [
                'model' => "WP838I-BT",
                'type' => "Acces Point",
                'desc' => 'AP WP838',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
        DB::table('types')->insert(
            [
                'model' => "WP8722-BT",
                'type' => "Acces Point",
                'desc' => 'AP WP8722',
                'created_at' => new DateTime(),
                'updated_at' => new DateTime(),
            ]
        );
    }
}
