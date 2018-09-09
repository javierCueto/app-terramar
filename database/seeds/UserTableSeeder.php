<?php

use Illuminate\Database\Seeder;
use App\User;


class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
        	'name'=>'JJavier',
            'email'=>'root@root.com',
            'password'=>bcrypt('root1.'),
            'role_id'=>1
        ]);

        // User::create([
        //     'name'=>'Jose',
        //     'email'=>'javelie@outlook.com',
        //     'password'=>bcrypt('123456'),
        //     'role_id'=>3,
        //     'companie_id'=>1
        // ]);
          
    }
}
