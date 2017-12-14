<?php

use App\Category;
use App\Post;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->truncate();

        DB::table('categories')->insert([

        [
            'title'=> 'Uncategorized',
            'slug'=> 'uncategorized'
        ],

        [
            'title'=> 'Web Design',
            'slug'=> 'web-design'
        ],

        [
            'title'=> 'Web Programing',
            'slug'=> 'web-programing'
        ],
        [
            'title'=> 'Internet',
            'slug'=> 'internet'
        ],
        [
            'title'=> 'Social Marketing',
            'slug'=> 'social-marketing'
        ],
        [
            'title'=> 'Photography',
            'slug'=> 'photography'
        ],
        [
            'title'=> 'Haking',
            'slug'=> 'haking'
        ],
        [
            'title'=> 'Laravel',
            'slug'=> 'laravel'
        ],
        [
            'title'=> 'Vue js',
            'slug'=> 'vue-js'
        ]



    ]);

        // TODO: update post data


        $categories = Category::pluck('id');

        foreach (Post::pluck('id') as $postId){

            $categoryId =$categories[rand(0,$categories->count()-1)];

            DB::table('posts')
                ->where('id',$postId)
                ->update(['category_id' => $categoryId]);
        }
    }
}
