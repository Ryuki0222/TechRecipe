<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Reference extends Model
{
    //テーブル名
    protected $table = "references";
    
    //登録データ(ブラックボックス)
    protected $guarded = ['id'];

    protected $timestamp = true;
    
    public function getData() {
        $data = DB::table($this->table)->get();
        return $data;
    }
}