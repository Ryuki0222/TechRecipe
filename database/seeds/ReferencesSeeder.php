<?php

use Illuminate\Database\Seeder;
use App\Models\Reference;

class ReferencesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 1; $i <= 10; $i++)
        {
            $reference = new Reference;
            $reference->flow_id = $i;
            $reference->ref_name = "hello";
            $reference->ref_url = "https://g";
            $reference->save();
        }
    }
}
