<?php

namespace App;

use Carbon\Carbon;
use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;



class Post extends Model
{

    use SoftDeletes;

    protected $dates = ['published_at'];

    protected $table = 'posts';

    protected $fillable = ['id','author_id','title',  'slug', 'excerpt', 'body', 'category_id', 'published_at', 'image'];


    //protected $fillable=['view_count'];


    public function author()
    {

        return $this->belongsTo(User::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function tags()
    {
       return $this->belongsToMany(Tag::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function commentsNumber($lavel = 'Comment')
    {
         $commentsNumber = $this->comments->count();

        return $commentsNumber ." ".str_plural($lavel,$commentsNumber) ;
    }
    public function commentsNumber2($lavel = '')
    {
        $commentsNumber = $this->comments->count();

        return $commentsNumber ." ".str_plural($lavel,$commentsNumber) ;
    }

    public function setPublishedAtAttribute($value)
    {

        $this->attributes['published_at'] = $value ?: NULL;
    }


    public function getImageUrlAttribute($value)
    {

        $imageUrl = "";

        if (!is_null($this->image)) {
            $directory = Config('cms.image.directory');
            $imagePath = public_path() . "/{$directory}/" . $this->image;
            if (file_exists($imagePath)) $imageUrl = asset("{$directory}/" . $this->image);


        }
        return $imageUrl;
    }

    public function getImageThumbUrlAttribute($value)
    {
        $imageThumUrl = "";

        if (!is_null($this->image)) {
            $directory = Config('cms.image.directory');
            $text = substr(strrchr($this->image, '.'), 1);
            $thumbnail = str_replace(".{{$text}}", "_thumb.{{$text}}", $this->image);
            $imagePath = public_path() . "/{$directory}/" . $thumbnail;
            if (file_exists($imagePath)) $imageThumUrl = asset("{$directory}/" . $thumbnail);
        }

        return $imageThumUrl;
    }

    public function getDateAttribute($value)
    {

        return is_null($this->published_at) ? '' : $this->published_at->diffForHumans();
    }



    /*public function getBodyHtmlAttribute($value)
    {

        return $this->body ? Markdown::convertToHtml(e($this->body)) : NULL;
    }*/

    public function getExcerptHtmlAttribute($value)
    {
        return $this->excerpt ? Markdown::convertToHtml(e($this->excerpt)) : NULL;
    }

    public function getTagsHtmlAttribute()
    {
        $anchors = [];

        foreach ($this->tags as $tag){

            $anchors[]= '<a href="' .route('tag',$tag->slug).'">'.$tag->name.'<a/>';
        }
        return implode(" , " , $anchors);
    }

    public function dateFormatted($showTimes = false)
    {
        $format = "d/m/Y";
        if ($showTimes) $format = $format . " H:i:s";
        return $this->created_at->format($format);
    }

    public function publicationLabel()
    {
        if (!$this->published_at) {
            return '<span class="label label-warning">Draft</span>';
        } elseif ($this->published_at && $this->published_at->isFuture()) {
            return '<span class="label label-info">Schedule</span>';
        } else {
            return '<span class="label label-success">Published</span>';
        }
    }

    public function scopeRetrievePageVisitsFrom($query){
        return $query->retrievePageVisitsFrom(Carbon::now()->subWeeks(2));
    }



    public function scopeLatestFirst($query)
    {

        return $query->orderBy('published_at', 'desc');
    }

    public function scopePopular($query)
    {
        return $query->orderBy('view_count', 'desc');
    }

    public function scopePublished($query)
    {

        return $query->where("published_at", "<=", Carbon::now());
    }

    public function scopeScheduled($query)
    {
        return $query->where("published_at", ">", Carbon::now());
    }

    public function scopeDraft($query)
    {

        return $query->whereNull("published_at");
    }

    public function scopeFilter($query,$filter)
    {
        if (isset($filter['month']) && $month =$filter['month']){

            $query->whereMonth('published_at',Carbon::parse($month)->month);
        }

        if (isset($filter['year']) && $year =$filter['year']){

            $query->whereYear('published_at',[Carbon::parse($year)->year]);
        }

        if (isset($filter['term']) && $term = $filter['term']){

            $query->where(function ($q) use($term){

                /*$q->whereHas('author',function ($qr) use($term){
                   $qr->where('name' , 'LIKE',"%{$term}%");
                });
                $q->whereHas('category',function ($qr) use($term){
                    $qr->where('title' , 'LIKE',"%{$term}%");
                });*/

                $q->orwhere('title','LIKE',"%{$term}%");
                $q->orWhere('excerpt','LIKE', "%{$term}%");
            });
        }
    }

    public static function archives()
    {
        return static::selectRaw('COUNT(id) as post_count, year(published_at) year, monthname(published_at) month')
            ->published()
            ->groupBy('year','month')
            ->orderByRaw('min(published_at) desc')
            ->get();
    }

    public function createComment(array $data)
    {
        $this->comments()->create($data);
    }

    public function createTags($tagString)
    {
        $tags = explode("," ,$tagString);

        $tagIds = [];

        foreach ($tags as $tag){

            /*$newTag = new Tag();

            $newTag->name = ucwords(trim($tag));
            $newTag->slug = str_slug($tag);
            $newTag->save();*/

            $newTag = Tag::firstOrCreate(['slug'=> str_slug($tag)],['name'=>trim($tag)]);

            $tagIds[]=$newTag->id;

        }

        $this->tags()->sync($tagIds);
    }








}
