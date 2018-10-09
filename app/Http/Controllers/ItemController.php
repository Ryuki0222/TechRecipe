<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\Flow;
use App\Models\Skill;
use App\Models\Tag;
use App\Models\User;

class ItemController extends Controller
{
    public function show($id)
    {
        $work = Work::where('hash', $id)->first();
        $work_id = $work->id;
        $flows = Flow::where('work_id', $work_id)->get();
        //タグを取得する
        $skills = Skill::where('work_id', $work_id)->get();
        $tags = array();
        foreach($skills as $skill){
            $tag = Tag::where('id', $skill->tag_id)->first();
            $tags[] = $tag;
        }
        //ユーザー情報を取得
        $user_id = $work->user_id;
        $user = User::where('github_id', $user_id)->first();

        return view('item', ["flows" => $flows, "numberofflow" => count($flows), "work" => $work, "tags" => $tags, "user" => $user]);
    }
}