<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Skill;
use App\Models\User;
use App\Models\Work;
use App\Models\Tag;

class SearchController extends Controller
{
    public function search(Request $request) {
        $query = $request->q;
        $search_words = explode(' ', $query);

        //worksを格納する配列
        $works_array = array();
        foreach ($search_words as $word) {
            //$wordがタグの場合
            $tag = Tag::where('tag_name', $word)->first();
            if($tag != NULL) {
                $skills = Skill::where('tag_id', $tag->id)->get();
                $works = array();
                foreach($skills as $skill){
                    $work = Work::where('id', $skill->work_id)->first();
                    $works[] = $work;
                }
                $works_array[] = $works;
                continue;
            }

            //$wordユーザーの場合
            $user = User::where('user_name', $word)->first();
            if(isset($user)) {
                $works = Work::where('user_id', $user->github_id)->get();

                $works_array[] = $works;
                continue;
            }
            //検索ワードの場合
            $_works = Work::where('work_name', 'LIKE', '%'.$word.'%')->get();
            $works = [];
            foreach($_works as $work){
                $works[] = $work;
            }
            $works_array[] = $works;
        }
        $result = $works_array[0];
        if(count($result) > 1) {
            foreach($works_array as $works){
                $result = array_intersect($result, $works);
            }
        }
        if (count($result) < 1) {
            $message = '「'.$query.'」に合致するレシピは見つかりませんでした';
        } else {
            $message = '「'.$query.'」の検索結果';
        }

        return view('index', ['works' => $result, 'message' => $message]);
    }
}
