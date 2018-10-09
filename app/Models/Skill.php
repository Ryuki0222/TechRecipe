<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class Skill extends Model
{
    //テーブル名
    protected $table = "skills";

    //登録データ(ブラックボックス)
    protected $guarded = ['id'];

    //
    protected $timestamp = true;

    private $primarykey = "tag_id";

    public function getData($word=null)
    {
        $query = DB::table($this->table);
        if($github_id != null) $query->where('github_id', $github_id);
        $data = $query->get();
        return $data;
    }

    public function work_skill(){
        return $this->belongsTo('App\Models\Work');
    }

    public function tag(){
        return $this->hasOne('App\Models\Tag', 'id', 'tag_id');
    }

    public function insert($tag_id, $work_id)
    {
        $query = DB::table($this->table);
        $now = Carbon::now();
        $query->insert([
            'tag_id' => $tag_id,
            'work_id' => $work_id,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }

}
