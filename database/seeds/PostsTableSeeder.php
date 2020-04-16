<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //Categories
        $category1 = Category::create([
            'name' => 'Marketing'
        ]);
        $category2 = Category::create([
            'name' => 'News'
        ]);
        $category3 = Category::create([
            'name' => 'Product'
        ]);

        //Tags
        $tag1 = Tag::create([
            'name' => 'Customers'
        ]);
        $tag2 = Tag::create([
            'name' => 'Job'
        ]);
        $tag3 = Tag::create([
            'name' => 'Record'
        ]);

        $author1 = User::create([
            'name' => 'Game Loft',
            'email' => 'games@gmail.com',
            'password' => Hash::make('password'),
        ]);
        $author2 = User::create([
            'name' => 'sony Loft',
            'email' => 'sony@gmail.com',
            'password' => Hash::make('password'),
        ]);

        //Posts
        $post1 = $author1->posts()->create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Best practices for minimalist design',
            'content' => 'TheSaaS is a responsive, professional, and multipurpose SaaS, Software, Startup and WebApp landing template powered by Bootstrap 4. TheSaaS is a powerful and super flexible tool for any kind of landing pages.',
            'category_id' => $category1->id,
            'image' => '1.jpg'
        ]);
        $post2 = $author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Best practices for minimalist design',
            'content' => 'TheSaaS is a responsive, professional, and multipurpose SaaS, Software, Startup and WebApp landing template powered by Bootstrap 4. TheSaaS is a powerful and super flexible tool for any kind of landing pages.',
            'category_id' => $category2->id,
            'image' => '2.jpg'
        ]);
        $post3 = $author2->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Best practices for minimalist design',
            'content' => 'TheSaaS is a responsive, professional, and multipurpose SaaS, Software, Startup and WebApp landing template powered by Bootstrap 4. TheSaaS is a powerful and super flexible tool for any kind of landing pages.',
            'category_id' => $category3->id,
            'image' => '3.jpg'
        ]);
        $post4 = $author1->posts()->create([
            'title' => 'Congratulate and thank to Maryam for joining our team',
            'description' => 'Best practices for minimalist design',
            'content' => 'TheSaaS is a responsive, professional, and multipurpose SaaS, Software, Startup and WebApp landing template powered by Bootstrap 4. TheSaaS is a powerful and super flexible tool for any kind of landing pages.',
            'category_id' => $category1->id,
            'image' => '4.jpg'
        ]);

        $post1->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag3->id, $tag3->id]);
        $post3->tags()->attach([$tag1->id, $tag3->id]);
        $post4->tags()->attach([$tag3->id]);
    }
}
