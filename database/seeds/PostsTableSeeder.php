<?php

use App\Category;
use App\Post;
use App\Tag;
use App\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $author1 = User::create([
            'name' => 'Sami Ahmed',
            'email' => 'sami@gmail.com',
            'password' => Hash::make('rootadmin'),
        ]);

        $author2 = User::create([
            'name' => 'Shuvon Ahmed',
            'email' => 'shuvon@gmail.com',
            'password' => Hash::make('rootadmin'),
        ]);

        $author3 = User::create([
            'name' => 'Shaker Ahmed',
            'email' => 'shaker@gmail.com',
            'password' => Hash::make('rootadmin'),
        ]);

        $tag1 = Tag::create([
            'name' => 'job'
        ]);
        $tag2 = Tag::create([
            'name' => 'record'
        ]);
        $tag3 = Tag::create([
            'name' => 'customer'
        ]);

        $category1 = Category::create([
            'name' => 'Web'
        ]);
        $category2 = Category::create([
            'name' => 'Android'
        ]);
        $category3 = Category::create([
            'name' => 'Marketing'
        ]);

        $post100 = $author1->posts()->create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.in reprehenderit perspiciatis dignissimos pariatur quae numquam.',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit rem itaque exercitationem magni blanditiis architecto possimus, hic ducimus dolor facere ratione vel ullam in reprehenderit perspiciatis dignissimos pariatur quae numquam. ',
            'category_id' => $category1->id,
            'image' => 'posts/1.jpg',
        ]);
        $post2 = $author2->posts()->create([
            'title' => 'Top 5 brilliant content marketing strategies',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.in reprehenderit perspiciatis dignissimos pariatur quae numquam.',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit rem itaque exercitationem magni blanditiis architecto possimus, hic ducimus dolor facere ratione vel ullam in reprehenderit perspiciatis dignissimos pariatur quae numquam. ',
            'category_id' => $category2->id,
            'image' => 'posts/2.jpg',
        ]);

        $post3 = $author3->posts()->create([
            'title' => 'Best practices for minimalist design with example',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.in reprehenderit perspiciatis dignissimos pariatur quae numquam.',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit rem itaque exercitationem magni blanditiis architecto possimus, hic ducimus dolor facere ratione vel ullam in reprehenderit perspiciatis dignissimos pariatur quae numquam. ',
            'category_id' => $category3->id,
            'image' => 'posts/3.jpg',
        ]);

        $post4 = $author2->posts()->create([
            'title' => 'We relocated our office to a new designed garage',
            'description' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit.in reprehenderit perspiciatis dignissimos pariatur quae numquam.',
            'content' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Impedit rem itaque exercitationem magni blanditiis architecto possimus, hic ducimus dolor facere ratione vel ullam in reprehenderit perspiciatis dignissimos pariatur quae numquam. ',
            'category_id' => $category1->id,
            'image' => 'posts/4.jpg',
        ]);

        $post100->tags()->attach([$tag1->id, $tag2->id]);
        $post2->tags()->attach([$tag3->id, $tag2->id]);
        $post3->tags()->attach([$tag1->id, $tag2->id]);
        $post4->tags()->attach([$tag1->id, $tag3->id]);


    }
}
