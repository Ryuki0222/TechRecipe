<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Work;
use App\Models\Skill;

class IndexController extends Controller
{
    public function index(){
        $works = Work::all();
        $message = '';
        return view('index', ['works' => $works, 'message' => $message]);
    }
}