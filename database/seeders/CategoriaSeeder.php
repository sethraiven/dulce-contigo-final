<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            [
                'nombre' => 'Postres',
                'descripcion' => 'Deliciosos postres artesanales'
            ],
            [
                'nombre' => 'Conservas',
                'descripcion' => 'Conservas caseras de calidad'
            ],
            [
                'nombre' => 'Dulces',
                'descripcion' => 'Golosinas dulces variadas'
            ],
            [
                'nombre' => 'Ferretería',
                'descripcion' => 'Herramientas y materiales de construcción'
            ]
        ];

        foreach ($categorias as $categoria) {
            Categoria::updateOrCreate(
                ['nombre' => $categoria['nombre']],
                ['descripcion' => $categoria['descripcion']]
            );
        }
    }
}
