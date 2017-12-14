<?php

use App\Role;
use App\User;
use Illuminate\Database\Seeder;
use App\Permission;
use Illuminate\Support\Facades\DB;

class PermissionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->truncate();
        //crud post
        $crudPost = new Permission();
        $crudPost->name = "crud-post";
        $crudPost->save();

        //update other post
        $updateOtherPost = new Permission();
        $updateOtherPost->name = "update-others-post";
        $updateOtherPost->save();

        //delete other post
        $deleteOtherPost = new Permission();
        $deleteOtherPost->name = "delete-others-post";
        $deleteOtherPost->save();

        //crud category
        $crudCategory = new Permission();
        $crudCategory->name = "crud-category";
        $crudCategory->save();

        //crud user
        $crudUser = new Permission();
        $crudUser->name = "crud-user";
        $crudUser->save();


        //attach roles permissions

        $admin = Role::where('name','admin')->first();

        $editor = Role::where('name','editor')->first();

        $author = Role::where('name','author')->first();

        $admin->detachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory,$crudUser]);
        $admin->attachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory,$crudUser]);

        $editor->detachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory]);
        $editor->attachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory]);

        $author->detachPermissions([$crudPost]);
        $author->attachPermissions([$crudPost]);


        $user1 = User::find(1);
        $user1->detachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory,$crudUser]);
        $user1->attachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory,$crudUser]);

        //second user as editor

        $user2 = User::find(2);
        $user2->detachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory]);
        $user2->attachPermissions([$crudPost,$updateOtherPost,$deleteOtherPost,$crudCategory]);

        //third user as author

        $user3 = User::find(3);
        $user3->detachPermissions([$crudPost]);
        $user3->attachPermissions([$crudPost]);


    }
}
