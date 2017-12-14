<?php

use Faker\Factory;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //reset the user table
        DB::statement('SET FOREIGN_KEY_CHECKS =0');
        DB::table('users')->truncate();

        //genarate 3 user/author
        $faker= Factory::create();
        DB::table('users')->insert([

            [
                'name'    => 'wd rasel',
                'slug'    => 'wd-rasel' ,
                'email'   => 'wd2rasel@gmail.com',
                'password'=>  bcrypt('secret'),
                'bio'     => $faker->text(rand(250, 300))
             ],

            [
                'name'  => 'wd siyam',
                'slug'    => 'wd-siyam' ,
                'email' => 'wd2siyam@gmail.com',
                'password'=> bcrypt('secret'),
                'bio'     => $faker->text(rand(250, 300))
            ],

            [
                'name' => 'wd nerub',
                'slug'    => 'wd-nerub' ,
                'email' => 'nerubnerub2015@gmail.com',
                'password' =>bcrypt('secret'),
                'bio'     => $faker->text(rand(250, 300))
            ]



        ]);
    }
}
