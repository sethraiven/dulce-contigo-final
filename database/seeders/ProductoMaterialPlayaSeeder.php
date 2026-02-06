<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class ProductoMaterialPlayaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar la categoría 'Material de playa'
        $categoria = Categoria::firstOrCreate(
            ['nombre' => 'Material de playa'],
            ['descripcion' => 'Materiales de construcción y agregados']
        );

        $productos = [
            [
                'nombre' => 'Cemento Gris 50kg',
                'descripcion' => 'Cemento gris de uso general para construcción.',
                'precio' => 28000,
                'stock' => 100,
                'imagen' => 'imagenes/cemento.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Arena de Río (m3)',
                'descripcion' => 'Arena lavada de río ideal para pañetes y mezclas.',
                'precio' => 65000,
                'stock' => 50,
                'imagen' => 'imagenes/arena_rio.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Arena de Peña (m3)',
                'descripcion' => 'Arena amarilla para pega de ladrillo.',
                'precio' => 55000,
                'stock' => 45,
                'imagen' => 'imagenes/arena_pena.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Gravilla (m3)',
                'descripcion' => 'Triturado de 3/4 para concretos.',
                'precio' => 75000,
                'stock' => 40,
                'imagen' => 'imagenes/gravilla.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Bloque N°5',
                'descripcion' => 'Bloque de arcilla para muros estructurales.',
                'precio' => 1800,
                'stock' => 2000,
                'imagen' => 'imagenes/bloque5.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Ladrillo Tolete',
                'descripcion' => 'Ladrillo macizo recocido tradicional.',
                'precio' => 900,
                'stock' => 5000,
                'imagen' => 'imagenes/ladrillo.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cal Hidratada 10kg',
                'descripcion' => 'Cal para mezclas y blanqueo.',
                'precio' => 12000,
                'stock' => 60,
                'imagen' => 'imagenes/cal.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Varilla Corrugada 1/2"',
                'descripcion' => 'Varilla de acero de 6 metros para refuerzo.',
                'precio' => 24000,
                'stock' => 150,
                'imagen' => 'imagenes/varilla.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Estuco Plástico 1gl',
                'descripcion' => 'Estuco listo blanco de alta adherencia.',
                'precio' => 35000,
                'stock' => 30,
                'imagen' => 'imagenes/estuco.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Yeso 25kg',
                'descripcion' => 'Yeso de construcción para acabados finos.',
                'precio' => 22000,
                'stock' => 25,
                'imagen' => 'imagenes/yeso.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('productos')->insert($productos);
    }
}
