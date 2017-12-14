<?php

namespace App;

use GrahamCampbell\Markdown\Facades\Markdown;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laratrust\Traits\LaratrustUserTrait;

class User extends Authenticatable
{
    use LaratrustUserTrait;

    protected $table = 'users';

    protected $fillable = ['name', 'email', 'password', 'author_id', 'id','slug','bio'];


    protected $hidden = ['password', 'remember_token',];

    public function posts()
    {
        return $this->hasMany(Post::class,'author_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function gravatar()
    {
        $email = $this->email;
        $default = asset('https://www.pwddelhi.gov.in/img/loggin.png');
        $size = 100;

        return "https://www.gravatar.com/avatar/" . md5(strtolower(trim($email))) . "?d=" . urlencode($default) . "&s=" . $size;
    }

    public function getBioHtmlAttribute($value)
    {

        return $this->bio ? Markdown::convertToHtml(e($this->bio)) : Null;
    }

    public function setPasswordAttribute($value){
        if (!empty($value)){
            $this->attributes['password'] = bcrypt($value);
        }
    }
}
