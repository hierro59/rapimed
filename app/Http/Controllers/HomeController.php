<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        /* $id = Auth::user()->id;
        $role = DB::Table('model_has_roles')->where('model_id', '=', $id)->get();
        if ($role[0]->role_id != 3) {
            $array = [];
            $citas = DB::Table('citas')->orderBy('created_at', 'DESC')->get();
            $specialist = DB::Table('specialist')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
            for ($i = 0; $i < count($citas); $i++) {
                $myspecialist = DB::Table('specialist')->select('id', 'name', 'email', 'degree', 'specialty')->where('id', '=', $citas[$i]->specialist_id)->get();
                array_push($array, $myspecialist);
            }
            return view('home', compact('citas', 'array', 'specialist', 'id'));
        } elseif ($role[0]->role_id == 4) {
            $citas = DB::Table('citas')->where('specialist_id', '=', $id)->get();
            return view('home', compact('citas'));
        } else {
            $citas = DB::Table('citas')->where('user_id', '=', $id)->get();
            for ($i = 0; $i < count($citas); $i++) {
                echo $citas[$i];
                //$specialist = DB::Table('users')->where('id', '=', $id)->get();
            }
            return view('home', compact('citas'));
        } */
        $id = Auth::user()->id;
        $specialist = DB::Table('specialists')->select('id', 'name', 'email', 'degree', 'specialty')->where('status', '=', 1)->get();
        return view('home', compact('specialist', 'id'));
    }
}
