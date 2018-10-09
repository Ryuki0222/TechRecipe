<?php

use Illuminate\Database\Seeder;
use App\Models\Skill;

class SkillsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 0; $i < 100; $i++){
            $skill = new Skill;
            $skill->work_id = intval(sprintf("%d%d", $i, $i));
            $skill->tag_id = $i;
            $skill->save();
        }
    }

}
