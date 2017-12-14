<?php

namespace App\Http\Controllers\adminpanel;

use App\Http\Requests\PostRequest;
use App\Post;
use Illuminate\Http\Request;
use Intervention\Image\Facades\Image;
use phpDocumentor\Reflection\Types\Parent_;

class BlogController extends AdminpanelController
{
    protected $uploadPath;


    public function __construct()
    {
        parent::__construct();

        $this->uploadPath= public_path(config('cms.image.directory'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $onlyTrashed = FALSE;

        if (($status = $request->get('status')) && $status == 'trash'){

            $posts=Post::onlyTrashed()->with('category','author')->latest()->paginate($this->limit);

            $postCount= Post::onlyTrashed()->count();

            $onlyTrashed= TRUE;
        }
        elseif($status=='scheduled'){

            $posts=Post::scheduled()->with('category','author')->latest()->paginate($this->limit);

            $postCount= Post::scheduled()->count();

        }
        elseif($status=='draft'){

            $posts=Post::draft()->with('category','author')->latest()->paginate($this->limit);

            $postCount= Post::draft()->count();

        }
        elseif($status=='published'){

            $posts=Post::published()->with('category','author')->latest()->paginate($this->limit);

            $postCount= Post::published()->count();

        }
        elseif($status=='own'){

            $posts=$request->user()->posts()->with('category','author')->latest()->paginate($this->limit);

            $postCount= $request->user()->posts()->count();

        }
        else{

            $posts=Post::with('category','author')->latest()->paginate($this->limit);

            $postCount= Post::count();

        }

        $statusList= $this->statusList($request);

        return view('adminpanel.blog.index', compact('posts', 'postCount','onlyTrashed','statusList'));

    }

    private function statusList($request){

        return [
          'own'      => $request->user()->posts()->count(),
          'all'      => Post::count(),
          'published'=> Post::published()->count(),
          'scheduled'=> Post::scheduled()->count(),
          'draft'    => Post::draft()->count(),
          'trash'    => Post::onlyTrashed()->count(),
        ];
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Post $post)
    {
        return view('adminpanel.blog.create')->withPost($post);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(PostRequest $request)
    {
          $data= $this->handleRequest($request);

       $newPost= $request->user()->posts()->create($data);

       $newPost->createTags($data['post_tags']);

        return redirect('/adminpanel/blog')->with('message','Your post was created succesfully');
    }

    private function handleRequest($request){

        $data= $request->all();

        if ($request->hasfile('image')){

            $image= $request->file('image');
            $fileName=$image->getClientOriginalName();

            $destination =$this->uploadPath;

            $successUploaded = $image->move($destination, $fileName);


            if ($successUploaded){

                $width=config('cms.image.thumbnail.width');
                $height=config('cms.image.thumbnail.height');
                $extension=$image->getClientOriginalExtension();
                $thumbnail = str_replace(".{$extension}","_thumb.{$extension}",$fileName);

                Image::make($destination. '/'.$fileName)
                    ->resize($width,$height)
                    ->save($destination.'/'.$thumbnail) ;
            }

            $data['image'] = $fileName;
        }

        return $data;
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $post=Post::findOrFail($id);

        return view('adminpanel.blog.edit')->withPost($post);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(PostRequest $request, $id)
    {
        $post= Post::findOrFail($id);

        $oldImage=$post->image;

        $data =$this->handleRequest($request);

        $post->update($data);

        $post->createTags($data['post_tags']);

        if ($oldImage !== $post->image){

            $this->removeImage($oldImage);
        }

        return redirect('/adminpanel/blog')->with('message','Your post was update succesfully');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
          Post::findOrFail($id)->delete();

          return redirect('/adminpanel/blog')->with('trash-message',['Your post move to trash successfully !',$id]);
    }

    public function forceDestroy($id){

         $post= Post::withTrashed()->findOrFail($id);

         $post->forceDelete();

         $this->removeImage($post->image);

        return redirect('/adminpanel/blog/?status=trash')->with('message','Your Post deleted successfully');
    }
    public function restore($id)
    {
        $post = Post::withTrashed()->findOrFail($id);
        $post->restore();

        return redirect()->back()->with('message', 'You post has been moved from the Trash');
    }

    private function removeImage($image){

        if (! empty($image)){

            $imagePath = $this->uploadPath. '/'.$image;

            $extension= substr(strrchr($image, '.'),1);

            $thumbnail = str_replace(".{$extension}","_thumb.{$extension}", $image);

            $thumbnailPath = $this->uploadPath. '/' . $thumbnail;

            if (file_exists($imagePath)) unlink($imagePath);

            if (file_exists($thumbnailPath)) unlink($thumbnailPath);
        }
    }
}
