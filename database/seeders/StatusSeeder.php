<?php

namespace Database\Seeders;

use App\Models\Status;
use Illuminate\Database\Seeder;

class StatusSeeder extends Seeder
{

    public function run()
    {
//        Status::factory()->count(2)->create();
        $status =new Status();
        $status->description='activo';
        $status->save();
        $status1 =new Status();
        $status1->description='inactivo';
        $status1->save();

    }
}
