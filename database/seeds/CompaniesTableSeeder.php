<?php

use Illuminate\Database\Seeder;
use App\companie;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        companie::create([
        	'database'=>'at_em1'
        ]);
        companie::create([
        	'database'=>'at_em2'
        ]);
        companie::create([
        	'database'=>'at_em3'
        ]);
        companie::create([
        	'database'=>'at_em4'
        ]);
        companie::create([
        	'database'=>'at_em5'
        ]);
        companie::create([
        	'database'=>'at_em6'
        ]);
        companie::create([
        	'database'=>'at_em7'
        ]);
        companie::create([
        	'database'=>'at_em8'
        ]);
    }
}
