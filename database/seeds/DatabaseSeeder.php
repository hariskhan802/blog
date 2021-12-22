<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        // $this->call(PostsSeeder::class);
        DB::table('users')->insert([
                'name' => 'haris',
                'email' => 'haris@gmail.com',
                'password' => bcrypt('haris'),
                'email_verified_at' => now(),
                'image' => '',
                
            ]);
        DB::table('categories')->insert([
                'name' => 'Cat 1',
                'description' => Str::random(40),
                'image' => '',
                'user_id' => '1',
                
            ]);
        for ($i=1; $i<=50; $i++) {
            $data = [];
            for ($j=1; $j<=1000; $j++) { 
                $data[] = [
                    'title' => Str::random(10),
                    'description' => Str::random(10).'@gmail.com',
                    'image' => 'post-1639784088.jpg',
                    'cat_id' => 1,
                    'user_id' => 1,
                ];
            }
            DB::table('posts')->insert($data);
        }
        for ($i=1; $i<=10; $i++) {
            $data = [];
            for ($j=1; $j<=1000; $j++) {
                $data[] = [
                    'comment' => Str::random(40),
                    'post_id' => $i,
                    'user_id' => 1,
                    
                ];
            }
            DB::table('comments')->insert($data);
        }
        
    }
}
