<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(UserTableSeeder::class);

        $this->call(PostTableSeeder::class);

        $this->call(CategoriesTableSeeder::class);

        $this->call(RoleTableSeeder::class);

        $this->call(PermissionsTableSeeder::class);

        $this->call(TagsTableSeeder::class);

        $this->call(CommentsTableSeeder::class);
    }
}
