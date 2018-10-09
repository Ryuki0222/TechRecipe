<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;

class User extends Model implements AuthenticatableContract
{
    use Authenticatable;
    //テーブル名
    protected $table = 'users';
    //登録データ(ブラックボックス)
    protected $guarded = ['id'];
    //時間
    public $timestamps = true;

    public function Work_Skill()
    {
        return $this->belongsTo('App\Models\Work');
    }

    public function getData($github_id=null)
    {
        $query = DB::table($this->table);
        if($github_id != null) $query->where('github_id', $github_id);
        $data = $query->get();
        return $data;
    }

    public function insert($github_id, $user_name, $img_path, $email_address)
    {
        $query = DB::table($this->table);
        $now = Carbon::now();
        $query->insert([
            'github_id' => $github_id,
            'user_name' => $user_name,
            'img_path' => $img_path,
            'email_address' => $email_address,
            'created_at' => $now,
            'updated_at' => $now,
        ]);
    }
}
