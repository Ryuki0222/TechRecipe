<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Flow extends Model
{
    //テーブル名
    protected $table = "flows";

    //登録データ(ブラックボックス)
    protected $guarded = ['id'];

    protected $timestamp = true;

    public function work_flow()
    {
        return $this->hasMany('App\Models\Work_Flow');
    }

    public function getData()
    {
        $data = DB::table($this->table)->get();
        return $data;
    }
}
