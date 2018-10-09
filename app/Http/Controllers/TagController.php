<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Work;
use App\Models\Tag;
use App\Models\Skill;


class TagController extends Controller
{
    public function show($tag_id)
    {
        $tag_name = $this->getTagName($tag_id);
        $skills = Skill::where('tag_id', $tag_id)->get();
        $works_id = array();
        foreach($skills as $skill){
            $works_id[] = $skill->work_id;
        }
        $works = array();
        foreach($works_id as $work_id){
            $work = Work::where('id', $work_id)->first();
            $works[] = $work;
        }
        $message = '「'.$tag_name.'」タグのレシピ一覧';
        return view('index', ['works' => $works, 'message' => $message]);
    }

    private function getTagName($id) {
        $tags = Tag::where('id', $id)->get();
        foreach ($tags as $tag) {
            $tag_name = $tag->tag_name;
        }
        return $tag_name;
    }
}