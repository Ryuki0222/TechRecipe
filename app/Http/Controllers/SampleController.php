<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Users;

class SampleController extends Controller
{
    public function model()
    {
        // Usersモデルのインスタンス化
        $md = new Users();

        // データ取得
        $data = $md->getData();

        // ビューを返す
        return view('index', ['data' => $data]);
    }
}
