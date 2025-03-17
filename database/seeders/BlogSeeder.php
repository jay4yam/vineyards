<?php

namespace Database\Seeders;

use App\Models\Blog;
use App\Models\Blog_Translate;
use App\Models\Category;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Sequence;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Blog::factory()->count(15)
            ->for(User::find(110607))
            ->has(
                Blog_Translate::factory()
                    ->count(2)
                    ->state( new Sequence(['locale' => 'en'],['locale' => 'fr'])), 'translates'
            )
            ->hasAttached(
                Tag::factory()->count(3)->state(new Sequence( ['locale' => 'en'],['locale' => 'fr'], ['locale' => 'de']))
            )
            ->hasAttached(
                Category::factory()->count(2)->state(new Sequence( ['locale' => 'en'],['locale' => 'fr'], ['locale' => 'de']))
            )
            ->create();
    }
}
