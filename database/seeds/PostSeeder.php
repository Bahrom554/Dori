<?php

use App\Models\Post;
use Illuminate\Database\Seeder;
use Faker\Factory;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class PostSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $posts = [];
        $types=[Post::TYPE_NEW,Post::TYPE_POST,Post::TYPE_PRODUCT,Post::TYPE_STUFF];
        $faker = Factory::create();
        $date = Carbon::create(2019, 10, 23, 6, 0, 0);

        for ($i = 0; $i <=100 ; $i++) {
            $date->addDays(1);
             $type=$types[rand(0,3)];
            $posts[] = [
                'title' => $faker->sentence(rand(8, 12)),
                'subtitle' => $faker->text(rand(250, 300)),
                'created_at' => clone ($date),
                'updated_at' => clone ($date),
                'type' =>$type,
                'parent_id'=>Post::whereNUll('parent_id')->where('type',$type)->first()->id
            ];
        }
        DB::table('posts')->insert($posts);
    }
}
