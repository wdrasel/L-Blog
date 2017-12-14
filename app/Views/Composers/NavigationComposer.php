<?php
namespace App\views\Composers;
use App\Category;
use App\Comment;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\View\View;
use PragmaRX\Tracker\Support\Minutes;
use Tracker;


class NavigationComposer
{
    public function compose(View $view){

        $this->composeCategories($view);

        $this->composePopularPosts($view);

        $this->composeTags($view);

        $this->composeArchives($view);

        $this->composeLatestPosts($view);

        $this->composeTotalUsers($view);

        $this->composeTotalPosts($view);

        $this->composeTotalCategories($view);

        $this->composeTotalTrash($view);





    }


    private function composeCategories(View $view){

        $categories= Category::with(['posts' => function($query){
            $query->published();

        }])->orderBy('title','asc')->get();

        $view->with('categories', $categories);
    }

    private function composeTags(View $view)
    {
        $tags = Tag::has('posts')->get();
        $view->with('tags',$tags);
    }

    private function composeArchives(View $view)
    {
        $archives = Post::archives();

        $view->with('archives',$archives);
    }

    private function composePopularPosts(View $view){

        $popularPosts= Post::published()->popular()->take(5)->get();

        $view->with('popularPosts', $popularPosts);
    }

    private function composeLatestPosts(View $view){

        $latestPostss = Post::latestFirst()->published()->take(5)->get();

        $view->with('latestPostss', $latestPostss);

    }

    private function composeTotalUsers(View $view){
        $usersCount =User::count();

        $view->with('usersCount',$usersCount);
    }
    private function composeTotalCategories(View $view){
        $categoriesCount =Category::count();

        $view->with('categoriesCount',$categoriesCount);
    }
    private function composeTotalPosts(View $view){
        $postsCount =Post::count();

        $view->with('postsCount',$postsCount);
    }
    private function composeTotalTrash(View $view){
        $trashCount =Post::onlyTrashed()->count();


        $view->with('trashCount',$trashCount);

    }










}



























?>