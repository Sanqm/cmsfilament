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

 
    public function view($slug){ // acordarse de que esta variable que empleamos más abajo se esta pasando por parámetros en la vista
        $post = Post::where('slug', $slug)->first(); // variable metemos todos los post 
        return view('view', ['post' => $post]); // lo enviamos a la vista dentro de un array asociativo aque solo mandamos el econtrado en la linea anterior
    }//

}