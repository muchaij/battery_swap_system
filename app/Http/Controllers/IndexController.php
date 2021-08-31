<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
class IndexController extends Controller
{
    public function index(){
        if(\DB::table("users")->where("role", 1)->count() == 0){
            $user = new User;
            $user->firstname = "Admin";
            $user->lastname = "Admin";
            $user->email = "admin@gmail.com";
            $user->password = \Hash::make("admin");
            $user->role = 1;
            $user->status = 1;
            $user->save();
        }
        return view('index');
    }
}
