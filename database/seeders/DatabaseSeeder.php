<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Device;
use App\Models\Type;
use App\Models\User;
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
       User::factory(2)->create();
       User::factory(2)->teamField()->create();
       User::factory(2)->manager()->create();

       Type::factory(9)->create();

       Device::factory(3)->create();
       Device::factory(3)->in()->create();
       Device::factory(3)->onHandBad()->create();
       Device::factory(3)->outGood()->create();

       Customer::factory(3)->create();
       Customer::factory(3)->newCustomer()->create();
    }
}
