<?php

use Illuminate\Database\Seeder;
use App\Models\Work;

class WorksSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= 10; $i++)
        {
            $work = new Work;
            $work->hash = $this->createHash(5);
            $work->work_name = "project".$i;
            $work->work_description = "じゅんちゃん".$i;
            $work->work_img_path = "./image/junkichi".$i."".$i;
            $work->user_id = $i * $i - $i;
            $work->product_time = $i."光年";
            $work->github_url = "https://github/junkichi".$i;
            $work->save();

        }
    }

    // ハッシュを作成する
    private function createHash($length) {
        $str = array_merge(range('a', 'z'), range('0', '9'), range('A', 'Z'));
        $r_str = '';
        for ($i = 0; $i < $length; $i++) {
            $r_str .= $str[rand(0, count($str) - 1)];
        }
        return $r_str;
    }
}
