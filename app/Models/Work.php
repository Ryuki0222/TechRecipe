<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Work extends Model
{
    //テーブル名
    protected $table = "works";

    //登録データ(ブラックボックス)
    protected $guarded = ['id'];

    protected $timestamp = true;

    public function skill()
    {
        return $this->hasMany('App\Models\Skill', 'work_id', 'id');
    }

    public function user()
    {
        return $this->hasOne('App\Models\User', 'github_id', 'user_id');
    }

    public function getData()
    {
        $data = DB::table($this->table)->get();
        return $data;
    }
}
