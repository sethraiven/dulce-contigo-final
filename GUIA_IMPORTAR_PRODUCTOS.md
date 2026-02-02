# Guía de Importación de Productos desde Excel

## Descripción
Esta funcionalidad permite importar múltiples productos desde un archivo Excel (.xlsx, .xls) o CSV de forma rápida y eficiente.

## Campos Requeridos
El archivo debe contener las siguientes columnas en este orden exacto:

1. **nombre** - Nombre del producto (texto, máximo 255 caracteres)
2. **descripcion** - Descripción detallada del producto (texto)
3. **precio** - Precio del producto (número decimal, ej: 5.99)
4. **stock** - Cantidad disponible en inventario (número entero, ej: 100)
5. **categoria_id** - ID de la categoría del producto (número entero, debe existir en la tabla)

## Formatos Soportados
- **.xlsx** - Excel moderno (2007 en adelante)
- **.xls** - Excel clásico (97-2003)
- **.csv** - Comma Separated Values (valores separados por comas)

## Pasos para Importar

### 1. Preparar el Archivo
Crea un archivo Excel o CSV con los siguientes datos:

**Encabezados (Primera fila):**
```
nombre,descripcion,precio,stock,categoria_id
```

**Ejemplo de datos:**
```
nombre,descripcion,precio,stock,categoria_id
Chocolate Negro,Chocolate premium de alta calidad,5.99,100,1
Galletas de Vainilla,Galletas crujientes con sabor a vainilla,2.50,150,2
Torta de Fresa,Torta casera con relleno de fresa fresca,8.99,50,3
Caramelos Variados,Surtido de caramelos dulces,3.25,200,1
Donuts Glaseados,Donuts frescos con glaseado,4.50,75,2
```

### 2. Descargar Plantilla de Ejemplo
En la sección de productos, haz clic en "Importar desde Excel" y descarga la plantilla de ejemplo (plantilla_productos.csv). Puedes usar esta como referencia.

### 3. Completar el Archivo
Completa el archivo con tus productos respetando:
- El orden de las columnas
- Los tipos de datos (números para precio y stock)
- La existencia de la categoría (verifica el ID en la tabla de categorías)

### 4. Importar el Archivo
1. Ve a la sección de Productos
2. Haz clic en el botón "Importar desde Excel"
3. Selecciona tu archivo (.xlsx, .xls o .csv)
4. Haz clic en "Importar"

## Validaciones

El sistema validará cada fila antes de crear los productos:

- ✓ Nombre no puede estar vacío
- ✓ Descripción no puede estar vacía
- ✓ Precio debe ser un número válido (>= 0)
- ✓ Stock debe ser un número entero válido (>= 0)
- ✓ Categoría ID debe existir en la base de datos
- ✓ Máximo 5 MB por archivo

## Manejo de Errores

Si hay errores durante la importación:
- El sistema informará cuántos productos se importaron exitosamente
- Se mostrarán los errores encontrados para que puedas corregirlos
- Los productos con errores NO se crearán en la base de datos
- Los productos válidos SÍ se crearán

## Ejemplo de Errores Comunes

| Error | Solución |
|-------|----------|
| "Fila 5: El nombre es requerido" | La fila 5 no tiene nombre. Completa el campo. |
| "Fila 3: El precio debe ser un número válido" | Verifica que el precio sea un número (5.99, no "5,99") |
| "Fila 7: El ID de categoría 99 no existe" | Crea la categoría primero o usa un ID válido |
| "Archivo debe ser menor a 5 MB" | Reduce el tamaño del archivo |

## Consejos

1. **Validar antes de importar:** Revisa que todos los datos sean correctos antes de hacer clic en "Importar"
2. **IDs de Categoría:** Confirma los IDs de categoría en la tabla de categorías
3. **Formato de Números:** Usa punto (.) para decimales, no coma (,)
4. **Codificación:** Si tienes caracteres especiales (ñ, á, etc.), asegúrate de que el archivo esté en UTF-8
5. **Duplicados:** El sistema no previene duplicados, revisa tus datos primero

## Preguntas Frecuentes

**¿Puedo importar imágenes?**
No, la importación desde Excel no incluye imágenes. Deberás cargarlas manualmente después de la importación.

**¿Qué pasa con los productos duplicados?**
El sistema no verifica duplicados automáticamente. Asegúrate de no tener productos con el mismo nombre en tu archivo.

**¿Puedo actualizar productos existentes?**
No, esta función solo crea productos nuevos. Para actualizar, usa el formulario de edición.

**¿Hay un límite de productos?**
No hay límite en la cantidad de productos que puedes importar, pero considera el tamaño del archivo (máximo 5 MB).
