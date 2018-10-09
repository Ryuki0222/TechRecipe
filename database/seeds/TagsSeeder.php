<?php

use Illuminate\Database\Seeder;
use App\Models\Tag;

class TagsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 0; $i < 10; $i++){
            $tag = new Tag;
            $tag->tag_name = "tag".$i;
            $tag->created_at = date('Y-m-d H:i:s');
            $tag->save();
        }
    }
}
