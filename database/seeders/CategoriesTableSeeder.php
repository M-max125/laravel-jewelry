<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Carbon\Carbon;
use App\Models\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        Category::insert([
        
            ['name'=>'Rings','slug'=>'handmade rings','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Necklaces','slug'=>'handmade necklaces','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Earrings','slug'=>'handmade earrings','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Bracelets','slug'=>'handmade bracelets','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Brooches','slug'=>'handmade brooches','created_at'=>$now,'updated_at'=>$now],
            ['name'=>'Pendants','slug'=>'handmade pendants','created_at'=>$now,'updated_at'=>$now],
        ]);

        // Category::create([
        //     'name' =>'Rings',
        //     'slug' => 'handmade rings'
        // ]);

        // Category::create([
        //     'name' =>'Necklaces',
        //     'slug' => 'handmade Necklaces'
        // ]);

        // Category::create([
        //     'name' =>'Earrings',
        //     'slug' => 'handmade Earrings'
        // ]);

        // Category::create([
        //     'name' =>'Bracelets',
        //     'slug' => 'handmade Bracelets'
        // ]);

        // Category::create([
        //     'name' =>'Brooches',
        //     'slug' => 'handmade Brooches'
        // ]);

        // Category::create([
        //     'name' =>'Pendants',
        //     'slug' => 'handmade Pendants'
        // ]);
    }
}
