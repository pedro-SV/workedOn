<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TicketsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('tickets')->insert([
            'external_id' => 'JIRA-' . random_int(1, 1000),
            'title' => str_random(20),
        ]);
    }
}
