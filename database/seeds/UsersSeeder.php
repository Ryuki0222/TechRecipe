<?php

use Illuminate\Database\Seeder;
use App\Models\User;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for($i = 0; $i < 10; $i++){
            $user = new User;
            $user->github_id = $i."".$i."".$i."".$i."".$i."".$i."".$i."".$i."";
            $user->user_name = "user".$i;
            $user->img_path = "./image".$i;
            $user->email_address = $i."".$i."".$i.".example.com";
            $user->created_at = date('Y-m-d H:i:s');
            $user->updated_at = date('Y-m-d H:i:s');
            $user->save();
        }
    }
}
