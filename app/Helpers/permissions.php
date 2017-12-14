<?php

use App\Post;

function check_user_permissions($request, $actionName = Null, $id =Null){
    //get current user login
    $currentUser = $request->user();

    //get current action name

    if ($actionName) {
        $currentActionName = $actionName;

    } else {
        $currentActionName = $request->route()->getActionName();
    }


    list($controller , $method ) = explode('@',$currentActionName);

    $controller = str_replace(["App\\Http\\Controllers\\adminpanel\\", "Controller"], "", $controller);

    $crudPermissionsMap = [
        //'create'=> ['create','store'],
        //'update' => ['edit','update'],
        // 'delete' => ['delete','restore','forceDestroy'],
        // 'read'=> ['index','view']
        'crud' => ['create','store','edit','update','destroy','restore','forceDestroy','index','view']
    ];

    $classMap= [
        'Blog' => 'post',
        'Categories'=>'category',
        'Users' => 'user'
    ];

    foreach ($crudPermissionsMap as $permission => $methods){
        //if the current method exist in the list,
        //well check the permission

        if (in_array($method, $methods) && isset($classMap[$controller])) {

            $className = $classMap[$controller];

            if ($className=='post' && in_array($method,['edit','update','destroy','restore','forceDestroy'])){
                   $id = !is_null($id) ? $id : $request->route('blog');
                //if the current user has not update-others-post/delete-others-posts
                //make sure he/she only modify his /her own post

                if ($id && (! $currentUser->can('update-others-post') || ! $currentUser->can('delete-others-post'))){

                    $post =Post::withTrashed()->find($id);

                    if ($post->author_id !== $currentUser->id){

                        return false;
                    }


                }
            }

            //if the user has not permission don't allow next request
            elseif (! $currentUser->can("{$permission}-{$className}")) {

                // redirect(url('/home'));
                return false;
            }

            //dd("{$permission}-{$className}");
            break;
        }
    }
    return true;
}