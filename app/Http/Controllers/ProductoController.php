<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Producto;
use App\Models\Categoria;

class ProductoController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except(['show', 'buscar']);
    }
    
     public function index()
    {
    $productos = Producto::with('categoria')->get();
    $categorias = Categoria::all();
    return view('productos.index', compact('productos', 'categorias'));
    }


    public function create()
    {
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('productos.create', compact('categorias'));

    }


    public function store(Request $request)
{
    // Validación de los campos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validar la imagen
    ]);

    $rutaImagen = null;
        if ($request->hasFile('imagen')) {
            $rutaImagen = $request->file('imagen')->store('productos', 'public');
        }

    // Crear el producto
    Producto::create([
        'nombre' => $request->nombre,
        'descripcion' => $request->descripcion,
        'precio' => $request->precio,
        'stock' => $request->stock,
        'categoria_id' => $request->categoria_id,
        'imagen' => $rutaImagen,
    ]);

    // Redirigir al listado
    return redirect()->route('productos.index')->with('success', 'Producto creado exitosamente.');
}

    public function show(string $id)
    {
        $producto = Producto::with('categoria')->findOrFail($id); // Obtener el producto con la relación de categoría
        return view('productos.show', compact('producto'));
 //
    }


    public function edit(string $id)
    {
        $producto = Producto::findOrFail($id);
        $categorias = Categoria::all(); // Obtener todas las categorías
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, string $id)
{
    // Validación de los campos
    $request->validate([
        'nombre' => 'required|string|max:255',
        'descripcion' => 'required|string',
        'precio' => 'required|numeric',
        'stock' => 'required|integer',
        'categoria_id' => 'required|exists:categorias,id',
        'imagen' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
    ]);

    $producto = Producto::findOrFail($id);

    $data = $request->all();

    // Si se sube una nueva imagen, guárdala y actualiza el campo
    if ($request->hasFile('imagen')) {
        $rutaImagen = $request->file('imagen')->store('productos', 'public');
        $data['imagen'] = $rutaImagen;
    } else {
        // Si no se sube nueva imagen, no modificar el campo imagen
        unset($data['imagen']);
    }

    $producto->update($data);

    // Redirigir al listado con mensaje
    return redirect()->route('productos.index')->with('success', 'Producto actualizado exitosamente.');
}


    public function destroy(string $id)
    {
        $producto = Producto::findOrFail($id);
        $producto->delete();

        // Redirigir al listado con mensaje
        return redirect()->route('productos.index')->with('success', 'Producto eliminado exitosamente.');
    }

    public function importarExcel(Request $request)
    {
        $request->validate([
            'archivo' => 'required|mimes:xlsx,xls,csv|max:5120',
        ]);

        try {
            $archivo = $request->file('archivo');
            $rutaTemporal = $archivo->store('temp');
            $rutaCompleta = storage_path('app/' . $rutaTemporal);

            // Procesar el archivo
            $productosImportados = 0;
            $errores = [];

            // Procesar como CSV directamente (funciona para .csv y .xlsx exportados como CSV)
            $productosImportados = $this->procesarCSV($rutaCompleta, $errores);

            // Eliminar archivo temporal
            if (file_exists($rutaCompleta)) {
                unlink($rutaCompleta);
            }

            if ($productosImportados > 0) {
                $mensaje = "Se importaron $productosImportados productos exitosamente.";
                if (!empty($errores)) {
                    $mensaje .= " Se encontraron " . count($errores) . " errores.";
                }
                return redirect()->route('productos.index')->with('success', $mensaje);
            } else {
                $mensajeError = "No se importó ningún producto. ";
                if (!empty($errores)) {
                    $mensajeError .= "Errores: " . implode(', ', array_slice($errores, 0, 3));
                }
                return redirect()->route('productos.index')->with('error', $mensajeError);
            }
        } catch (\Exception $e) {
            return redirect()->route('productos.index')->with('error', 'Error al procesar el archivo: ' . $e->getMessage());
        }
    }

    private function procesarCSV($rutaArchivo, &$errores)
    {
        $productosImportados = 0;

        try {
            $handle = fopen($rutaArchivo, 'r');
            if (!$handle) {
                $errores[] = "No se pudo abrir el archivo";
                return 0;
            }

            $fila = 0;
            while (($data = fgetcsv($handle, 2000, ',')) !== false) {
                $fila++;
                // Saltear la primera fila (encabezados)
                if ($fila === 1) {
                    continue;
                }

                // Saltar filas vacías
                if (empty(array_filter($data))) {
                    continue;
                }

                $producto = $this->crearProductoDesdeRow($data, $fila, $errores);
                if ($producto) {
                    $productosImportados++;
                }
            }
            fclose($handle);
        } catch (\Exception $e) {
            $errores[] = "Error al procesar el archivo: " . $e->getMessage();
        }

        return $productosImportados;
    }

    private function crearProductoDesdeRow($row, $numeroFila, &$errores)
    {
        try {
            // Mapear columnas esperadas
            // Esperado: nombre, descripcion, precio, stock, categoria_id
            if (count($row) < 5) {
                $errores[] = "Fila $numeroFila: Faltan columnas requeridas";
                return null;
            }

            $nombre = trim($row[0] ?? '');
            $descripcion = trim($row[1] ?? '');
            $precio = trim($row[2] ?? '');
            $stock = trim($row[3] ?? '');
            $categoria_id = trim($row[4] ?? '');

            // Validaciones
            if (empty($nombre)) {
                $errores[] = "Fila $numeroFila: El nombre es requerido";
                return null;
            }

            if (empty($descripcion)) {
                $errores[] = "Fila $numeroFila: La descripción es requerida";
                return null;
            }

            if (!is_numeric($precio) || $precio < 0) {
                $errores[] = "Fila $numeroFila: El precio debe ser un número válido";
                return null;
            }

            if (!is_numeric($stock) || $stock < 0 || intval($stock) != $stock) {
                $errores[] = "Fila $numeroFila: El stock debe ser un número entero válido";
                return null;
            }

            if (empty($categoria_id) || !is_numeric($categoria_id)) {
                $errores[] = "Fila $numeroFila: El ID de categoría es requerido y debe ser un número";
                return null;
            }

            // Verificar que la categoría exista
            $categoria = Categoria::find($categoria_id);
            if (!$categoria) {
                $errores[] = "Fila $numeroFila: La categoría con ID $categoria_id no existe";
                return null;
            }

            // Crear el producto
            $producto = Producto::create([
                'nombre' => $nombre,
                'descripcion' => $descripcion,
                'precio' => (float) $precio,
                'stock' => (int) $stock,
                'categoria_id' => (int) $categoria_id,
                'imagen' => null,
            ]);

            return $producto;
        } catch (\Exception $e) {
            $errores[] = "Fila $numeroFila: " . $e->getMessage();
            return null;
        }
    }
    public function buscar(Request $request)
    {
        $query = $request->input('query');
        
        $productos = Producto::with('categoria')
            ->where('nombre', 'LIKE', "%{$query}%")
            ->orWhere('descripcion', 'LIKE', "%{$query}%")
            ->get();
            
        $categorias = Categoria::all();
        
        return view('productos.resultados', compact('productos', 'query', 'categorias'));
    }
}
