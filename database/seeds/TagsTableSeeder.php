<?php

use App\Post;
use App\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->truncate();

        $php = new Tag();
        $php->name = 'PHP';
        $php->slug='php';
        $php->save();

        $laravel = new Tag();
        $laravel->name = 'LARAVEL';
        $laravel->slug='laravel';
        $laravel->save();

        $haking = new Tag();
        $haking->name = 'HACKING';
        $haking->slug='hacking';
        $haking->save();

        $vueJs = new Tag();
        $vueJs->name = 'vueJs';
        $vueJs->slug='vuejs';
        $vueJs->save();


        $tags= [
          $php->id,
          $laravel->id,
          $haking->id,
          $vueJs->id

        ];

        foreach (Post::all() as $post)
        {
            shuffle($tags);
            for ($i = 0; $i< rand(0,count($tags)-1); $i++)
            {
                $post->tags()->detach($tags[$i]);
                $post->tags()->attach($tags[$i]);
            }
        }
    }
}
