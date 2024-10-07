<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class HomeController extends Controller //administrará las vistas públicas de nuestra aplicación 
{
    
    
    public function index(){
        $posts = Post::all(); // variable metemos todos los post 
        return view('home', ['posts' => $posts]); // lo enviamos a la vista dentro de un array asociativo
    }//



}
