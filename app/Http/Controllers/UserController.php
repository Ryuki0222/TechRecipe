<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Work;

class UserController extends Controller
{

  public function show($user_name)
    {
        //usersテーブルから$user_nameの情報を取得
        $user = User::where('user_name', $user_name)->first();
        //$user_namenの$user_idを取得
        $user_id = $user->github_id;

        //$user_nameのwork情報を取得
        $works = Work::where('user_id', $user_id)->get();

        $message = '「'.$user_name.'」さんのレシピ一覧';
        return view('index', ['works' => $works, 'message' => $message]);
    }
}

