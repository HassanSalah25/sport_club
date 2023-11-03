<?php

namespace Database\Seeders;
use App\Models\Branchs;

use Illuminate\Database\Seeder;

class BranchsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Branchs::factory()->count(20)->create();
    }
}
