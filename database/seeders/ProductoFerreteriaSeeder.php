<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Categoria;

class ProductoFerreteriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Buscar la categoría 'Ferretería' (o crearla si no existe para evitar errores)
        $categoria = Categoria::firstOrCreate(
            ['nombre' => 'Ferretería'],
            ['descripcion' => 'Herramientas y materiales de construcción']
        );

        $productos = [
            [
                'nombre' => 'Martillo de uña',
                'descripcion' => 'Martillo de acero forjado con mango de fibra de vidrio.',
                'precio' => 25000,
                'stock' => 50,
                'imagen' => 'imagenes/martillo.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Destornillador Phillips',
                'descripcion' => 'Destornillador punta estrella mango ergonómico.',
                'precio' => 12000,
                'stock' => 100,
                'imagen' => 'imagenes/destornillador.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Llave Inglesa Ajustable',
                'descripcion' => 'Llave ajustable de 10 pulgadas acero cromado.',
                'precio' => 35000,
                'stock' => 30,
                'imagen' => 'imagenes/llave_inglesa.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Taladro Percutor',
                'descripcion' => 'Taladro eléctrico 600W con velocidad variable.',
                'precio' => 150000,
                'stock' => 15,
                'imagen' => 'imagenes/taladro.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Cinta Métrica 5m',
                'descripcion' => 'Flexómetro profesional con carcasa resistente.',
                'precio' => 18000,
                'stock' => 80,
                'imagen' => 'imagenes/cinta_metrica.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Juego de Brocas',
                'descripcion' => 'Set de 10 brocas para madera, metal y concreto.',
                'precio' => 45000,
                'stock' => 40,
                'imagen' => 'imagenes/brocas.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Alicate Universal',
                'descripcion' => 'Alicate de electricidad 8 pulgadas.',
                'precio' => 22000,
                'stock' => 60,
                'imagen' => 'imagenes/alicate.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Sierra de Mano',
                'descripcion' => 'Serrucho profesional para madera 20 pulgadas.',
                'precio' => 28000,
                'stock' => 25,
                'imagen' => 'imagenes/sierra.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Nivel de Burbuja',
                'descripcion' => 'Nivel de aluminio 60cm con 3 burbujas.',
                'precio' => 32000,
                'stock' => 20,
                'imagen' => 'imagenes/nivel.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'nombre' => 'Caja de Herramientas',
                'descripcion' => 'Organizador plástico 19 pulgadas con bandeja.',
                'precio' => 55000,
                'stock' => 10,
                'imagen' => 'imagenes/caja_herramientas.jpg',
                'categoria_id' => $categoria->id,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('productos')->insert($productos);
    }
}
