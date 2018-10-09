<?php

use Illuminate\Database\Seeder;
use App\Flow;

class FlowsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        for($i = 1; $i <= 10; $i++){
            $flow = new Flow;
            $flow->work_id = $i;
            $flow->flow_description = "hello!";
            $flow->flow_img_path = "./image".$i;
            $flow->flow_no = $i;
            $flow->save();
        }
    }
}
