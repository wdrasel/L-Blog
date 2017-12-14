<?php

namespace App\Http\Controllers;

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use PragmaRX\Tracker\Support\Minutes;
use Tracker;

class BlogController extends Controller
{

    protected $limit = 2;
    public function index(){



        $posts = Post::with('author','tags','category','comments')
                            ->latestFirst()
                            ->published()
                            ->filter(request()->only(['term','year','month']))
                            ->paginate($this->limit);


          return view('blog.index',compact( 'posts','pageViews'));


    }

    public function category(Category $category){

        $categoryName= $category->title;

        $posts= $category->Posts()
                         ->with('author','tags','comments')
                         ->LatestFirst()
                         ->published()
                         ->paginate($this->limit);




        return view('blog.index',compact('posts','categoryName'));

    }

    public function tag(Tag $tag){

        $tagName= $tag->name;

        $posts= $tag->Posts()
            ->with('author','category','comments')
            ->LatestFirst()
            ->published()
            ->paginate($this->limit);

        return view('blog.index',compact('posts','tagName'));

    }




    public function author(User $author){

        $authorName=$author->name;

        $posts= $author->posts()
                      ->with('category','tags','comments')
                      ->LatestFirst()
                      ->published()
                      ->paginate($this->limit);



        return view('blog.index',compact('posts','authorName'));
    }



    public function show(Post $post){

        $post->increment('view_count');

        $postComments =$post->comments()->paginate(2);

         Tracker::logByRouteName('post.show')
            ->where(function($query)
            {
                $query
                    ->where('parameter', 'slug')
                    ->where('value', '$slug');
            })
            ->count();



        return view('blog.show',compact('post','postComments'));
    }



}
