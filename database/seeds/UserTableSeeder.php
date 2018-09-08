<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Document;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // User::create([
        // 	'name'=>'Javier',
        //     'email'=>'javier@xmen.com',
        //     'password'=>bcrypt('123456'),
        //     'role_id'=>1
        // ]);
           $cont=0;

        while($cont<500){

            if($cont<100){

                 Document::create([
                      'name'=>'Javier',
                         'uuid'=>'javier@xmen.com',
                         'document'=>'a.jpg',
                         'url'=>'files/bios/2018-09',
                         'date'=>'2018-04-30',
                         'user_id'=>'2',
                         'companie_id'=>'1'
                     ]); 

            }

            if($cont<150){
                 Document::create([
                      'name'=>'Javier',
                         'uuid'=>'javier@xmen.com',
                         'document'=>'a.jpg',
                         'url'=>'files/bios/2018-09',
                         'date'=>'2018-03-06',
                         'user_id'=>'2',
                         'companie_id'=>'1'
                     ]); 
                
            }

            if($cont<200){
                 Document::create([
                      'name'=>'Javier',
                         'uuid'=>'javier@xmen.com',
                         'document'=>'a.jpg',
                         'url'=>'files/bios/2018-09',
                         'date'=>'2018-09-06',
                         'user_id'=>'2',
                         'companie_id'=>'1'
                     ]); 
                
            }

            if($cont<300){
                 Document::create([
                      'name'=>'Javier',
                         'uuid'=>'javier@xmen.com',
                         'document'=>'a.jpg',
                         'url'=>'files/bios/2018-09',
                         'date'=>'2018-01-16',
                         'user_id'=>'2',
                         'companie_id'=>'1'
                     ]); 
                
            }

                      

                       $cont++;
        }
         



    }
}
