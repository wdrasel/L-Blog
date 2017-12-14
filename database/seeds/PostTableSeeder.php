<?php

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Faker\Factory;

class PostTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //TODO:: reset the post table

        DB::table('posts')->truncate();

       //TODO:: genarate 36 dummy post data

        $posts=[];
        $faker = Factory::create();
        $date =Carbon::now()->modify('-1 year');


        for ($i = 1; $i <= 26; $i++){

            $image = "Post_image_".rand(1,26). ".jpg";
            $date->addDays(10);
            $createDate=clone ($date);
            $publishedDate=clone ($date);

            $posts[]=[

                'author_id' => rand(1, 3),
                'title' => $faker->sentence(rand(8,8)),
                'slug' => $faker->slug(),
                'excerpt'=> $faker->text(rand(400,400)),
                'body' => $faker->paragraph(rand(10,15),true),
                'image'=> $image,
                'created_at'=> $createDate,
                'updated_at' =>$createDate,
                'published_at' => $i < 30 ? $publishedDate : ( rand(0, 1) == 0 ? NULL : $publishedDate->addDays(4) ),
                'view_count' => rand(1,10)*10

            ];
        }
        DB::table('posts')->insert($posts);




    }
}
