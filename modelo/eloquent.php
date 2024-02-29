<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Illuminate\Database\Capsule\Manager as Capsule;
use Illuminate\Database\Eloquent\Model;

class Conexion {
    public function conectar() {
        define('HOST', 'localhost');
        define('NAME', 'pelishd'); 
        define('USER', 'root'); 
        define('PASS', ''); 

        try {
            $capsule = new Capsule;
            $capsule->addConnection([
                'driver'        => 'mysql',
                'host'          => HOST,
                'database'      => NAME,
                'username'      => USER,
                'password'      => PASS,
                'charset'       => 'utf8',
                'collation'     => 'utf8_unicode_ci',
                'prefix'        => '',
            ]);
            $capsule->bootEloquent();

            return $capsule;

        } catch (Exception $e) {
            echo "Error de conexión: " . $e->getMessage();
            return null;
        }
    }
}

class Pelicula extends Model
{
    // Nombre de la tabla en la base de datos
    protected $table = 'peliculas';

    // Nombre de la columna que es la clave primaria
    protected $primaryKey = 'ID';

    // Indica si el modelo debe registrar automáticamente las marcas de tiempo (created_at y updated_at)
    public $timestamps = false;

    // Los atributos que se pueden asignar de forma masiva (en una inserción o actualización)
    protected $fillable = ['NOMBRE', 'DESCRIPCION', 'POSTER', 'TRAILERKEY'];

    // Si tienes columnas que no quieres que se asignen de forma masiva, puedes usar la propiedad guarded
    // protected $guarded = ['id'];
}

class Director extends Model
{
    protected $table = 'Directores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre', 'apellido'];
}

class Actor extends Model
{
    protected $table = 'Actores';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre', 'apellido'];
}

class Genero extends Model
{
    protected $table = 'Generos';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = ['nombre'];
}

class PeliculaDirector extends Model
{
    protected $table = 'Pelicula_Director';
    public $timestamps = false;
    protected $fillable = ['pelicula_id', 'director_id'];
}

class PeliculaActor extends Model
{
    protected $table = 'Pelicula_Actor';
    public $timestamps = false;
    protected $fillable = ['pelicula_id', 'actor_id'];
}

class PeliculaGenero extends Model
{
    protected $table = 'Pelicula_Genero';
    public $timestamps = false;
    protected $fillable = ['pelicula_id', 'genero_id'];
}

?>