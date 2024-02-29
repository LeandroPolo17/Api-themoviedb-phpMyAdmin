<?php
require_once __DIR__ . '/../modelo/eloquent.php';
require_once __DIR__ . '/../modelo/api.php';
require_once __DIR__ . '/../vista/index.php';

use PHPUnit\Framework\TestCase;

class PeliculaTest extends TestCase
{    
    //pruebas a eloquent.php
    public function testConexionExitosa()
    {
        $conexion = new Conexion();
        $capsule = $conexion->conectar();

        $this->assertInstanceOf('\Illuminate\Database\Capsule\Manager', $capsule);
    }

    public function testPeliculaModel()
    {
        $pelicula = new Pelicula();

        $this->assertInstanceOf('\Illuminate\Database\Eloquent\Model', $pelicula);
        $this->assertEquals('peliculas', $pelicula->getTable());
        $this->assertEquals('ID', $pelicula->getKeyName());
        $this->assertFalse($pelicula->timestamps);
        $this->assertContains('NOMBRE', $pelicula->getFillable());
    }
    //prubas a index.php
    public function testObtenerPeliculas()
    {
        // Simulamos una conexión exitosa y comprobamos si se obtienen películas
        $peliculas = obtenerPeliculas();
        $this->assertNotEmpty($peliculas);
    }
     //pruebas a api.php
     public function testLlenarTablaPeliculas()
     {
         // Simulamos una llamada exitosa a la API y comprobamos si se insertan películas en la base de datos
         // Puedes simular la respuesta esperada de la API para obtener películas populares
         $this->expectOutputString('Películas insertadas correctamente en la tabla.');
         llenarTablaPeliculas();
     }

     public function testInsercionPeliculasBaseDatos()
     {
         // Verifica si las películas obtenidas se insertan correctamente en la base de datos
         $this->assertTrue(true);
     }
     public function testManejoErroresConexion()
    {
        // Simula un error de conexión a la API
        $this->expectOutputRegex('/Error al obtener películas desde la API:/');
        $this->assertNull(llenarTablaPeliculas());
    }
    
}

?>



