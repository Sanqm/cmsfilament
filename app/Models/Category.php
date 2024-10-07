<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Category extends Model
{
    use HasFactory;
    // public $table="nombre_de_la_tabla" -> esta línea la especifícariamos 
    // si no hubiesemos seguidos las buenas praćticas de nomeclatura de laravel
    // para indicar que este es el nombre de la tabla que vamos a usar 
    protected $guarded = []; // acordemonos que con esta línea estamos indicando 
    // que se pueden rellenar todos los campos cosa que no se debería realizar en produccción
    // tenemos un ejemplo en la tabla users de como se puede usar correctamente esto
    
    public function posts():HasMany{
        return $this->hasMany(Post::class);
    }

}
