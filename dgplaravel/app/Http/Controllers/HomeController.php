<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
//calling the model
use App\User;
use Auth;
//for model based notification
use App\Notifications\TaskCompleted;
//for custom notification
use Illuminate\Support\Facades;
use Notifications;


class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    protected $id = 0;
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
        //session
        $this->id = Auth::user()->id;
        User::find($this->id)->notify(new TaskCompleted);
        return view('home');
    }
}
