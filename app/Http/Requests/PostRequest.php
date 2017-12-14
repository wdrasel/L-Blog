<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use PhpParser\Node\Stmt\Case_;

class PostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {


        $rules = [
            'title' => 'required|max:100',
            'slug' => 'required|unique:posts',
            'body' => 'required',
            /*'published_at' => 'date_format:Y-m-d H:i:s',*/
            'category_id' => 'required',
            'excerpt'=>'required|max:400',
            'image'=>'mimes:jpg,jpeg,bmp,png,JPG',

        ];


        switch ($this->method()){
            case 'PUT':
            case  'PATCH':
                $rules['slug']= 'required|unique:posts,slug,'.$this->route('blog');
                break;
        }

        return $rules;
    }
}
