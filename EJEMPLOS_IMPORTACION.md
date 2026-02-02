# Ejemplos de Archivos de Importación

## Ejemplo 1: Tienda de Dulces

```csv
nombre,descripcion,precio,stock,categoria_id
Chocolate Negro Premium,Chocolate 70% cacao importado de Bélgica,8.99,50,1
Galletas de Vainilla,Galletas caseras con esencia de vainilla natural,3.50,120,2
Brownies de Chocolate,Brownies caseros con nueces,4.99,80,1
Helado de Fresa,Helado artesanal de fresa,5.50,60,3
Caramelos Duros,Caramelos de frutas surtidas,2.00,200,1
Donas Glaseadas,Donas frescas con glaseado de chocolate,3.99,100,2
Cheesecake de Limón,Cheesecake casero con topping de limón,7.99,30,3
Macarrones de Almendra,Macarrones franceses de colores,6.50,45,2
```

## Ejemplo 2: Panadería

```csv
nombre,descripcion,precio,stock,categoria_id
Pan Blanco,Pan integral recién horneado,2.50,150,4
Pan de Centeno,Pan de centeno 100% puro,3.00,80,4
Croissants,Croissants franceses mantequilla,1.50,200,5
Baguette,Baguette crujiente,2.00,100,4
Pan Dulce,Pan dulce con chocolate,2.75,120,5
Bagels,Bagels de semillas variadas,1.75,90,4
Focaccia,Focaccia italiana con hierbas,3.50,60,4
```

## Ejemplo 3: Repostería Fina

```csv
nombre,descripcion,precio,stock,categoria_id
Torta Tres Leches,Torta tradicional tres leches,12.99,25,3
Tiramisú Casero,Tiramisú italiano auténtico,8.50,20,3
Fraisier,Torta de fresas y crema,10.99,30,3
Black Forest,Torta selva negra con cereza,11.50,20,3
Lemon Pie,Tarta de limón cremosa,7.99,40,3
Tarta de Chocolate,Tarta chocolate 60% cacao,9.99,35,3
Semifreddo de Vainilla,Postre semifrío de vainilla,6.50,25,3
```

## Consideraciones para tu Archivo

### ✅ QUÉ SÍ HACER

1. **Mantén el orden de columnas**
   ```
   nombre,descripcion,precio,stock,categoria_id
   ```

2. **Usa precios con decimales**
   ```
   5.99  ✓ Correcto
   5,99  ✗ Incorrecto (usa punto, no coma)
   ```

3. **Usa números enteros para stock**
   ```
   100   ✓ Correcto
   100.5 ✗ Incorrecto (debe ser entero)
   ```

4. **Verifica que el ID de categoría exista**
   ```
   categoria_id debe ser un número que existe en tu tabla de categorías
   ```

5. **Completa todos los campos**
   ```
   Chocolate,Buen chocolate,5.99,100,1  ✓ Válido
   Chocolate,Buen chocolate,5.99,,1     ✗ Inválido (stock vacío)
   ```

### ❌ QUÉ NO HACER

1. **No cambies el orden de las columnas**
   ```
   categoria_id,nombre,descripcion,precio,stock  ✗ Incorrecto
   ```

2. **No dejes filas completamente vacías en el medio**
   ```
   Producto1,Desc1,5.99,100,1
   
   Producto2,Desc2,6.99,50,1  ✗ Fila vacía en el medio
   ```

3. **No uses comillas en los datos a menos que sea CSV válido**
   ```
   "Chocolate","Descripción",5.99,100,1  - Puede causar problemas
   ```

4. **No incluyas caracteres especiales en encabezados**
   ```
   nombre_producto,descripción  ✗ Usa los nombres exactos
   nombre,descripcion           ✓ Correcto
   ```

5. **No dejes la primera fila sin encabezados**
   ```
   nombre,descripcion,precio,stock,categoria_id  ✓ Siempre debe estar
   ```

## Plantilla Vacía Lista para Usar

```csv
nombre,descripcion,precio,stock,categoria_id


```

Copia esto en un archivo .csv y completa con tus productos.

## Cómo Preparar tu Archivo

### Opción 1: Excel
1. Abre Excel
2. Crea las columnas: nombre, descripcion, precio, stock, categoria_id
3. Completa tus productos
4. Guarda como "productos.xlsx"
5. Importa en la aplicación

### Opción 2: Google Sheets
1. Crea una hoja con las columnas requeridas
2. Completa los datos
3. Descarga como CSV (archivo → descargar → CSV)
4. Importa en la aplicación

### Opción 3: Editor de Texto
1. Abre bloc de notas o editor de texto
2. Copia la plantilla vacía
3. Completa los datos (datos separados por comas)
4. Guarda como "productos.csv"
5. Importa en la aplicación

## Validación de Datos

Antes de importar, verifica:
- ✓ Todos los nombres están completos
- ✓ Todos los precios son números válidos
- ✓ Todos los stocks son números enteros
- ✓ Todos los IDs de categoría existen
- ✓ No hay filas vacías entre los datos

## Máximo Número de Productos

Puedes importar hasta **5 MB** de datos, lo que corresponde aproximadamente a:
- **~5,000 productos** en un archivo CSV simple
- **~1,000 productos** en un archivo Excel con muchas columnas

Si necesitas importar más, divide en varios archivos.
