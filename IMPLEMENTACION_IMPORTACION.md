# 📊 Implementación de Importación de Productos desde Excel

## ✅ Lo que se ha implementado

### 1. **Backend - Controlador (ProductoController.php)**
Se agregaron los siguientes métodos:

#### `importarExcel(Request $request)`
- Valida que el archivo sea .xlsx, .xls o .csv
- Máximo 5 MB de tamaño
- Procesa el archivo y retorna los resultados

#### `procesarExcel($rutaArchivo, &$errores)`
- Maneja archivos Excel usando PhpSpreadsheet si está disponible
- Fallback automático a CSV si no está disponible
- Valida cada fila antes de crear el producto

#### `procesarCSV($rutaArchivo, &$errores)`
- Lee archivos CSV línea por línea
- Compatible con Excel exportado como CSV
- Procesa encabezados y datos

#### `crearProductoDesdeRow($row, $numeroFila, &$errores)`
- Valida cada campo del producto:
  - Nombre (requerido, max 255 caracteres)
  - Descripción (requerido)
  - Precio (número > 0)
  - Stock (entero > 0)
  - Categoría ID (debe existir)
- Retorna el producto creado o null si hay error

---

### 2. **Frontend - Vista (index.blade.php)**

#### Botón de Importación
```html
<a href="#" class="btn btn-outline-info" data-bs-toggle="modal" data-bs-target="#importarExcelModal">
    <i class="fa fa-file-excel"></i> Importar desde Excel
</a>
```

#### Modal de Importación
- Formulario con validación de archivo
- Instrucciones claras sobre el formato esperado
- Botón para descargar plantilla de ejemplo
- Alertas sobre validaciones y limitaciones

---

### 3. **Rutas (web.php)**
```php
Route::post('/productos/importar-excel', [ProductoController::class, 'importarExcel'])
    ->name('productos.importar-excel');
```

---

### 4. **Plantillas de Ejemplo**
- **plantilla_productos.csv**: Archivo de ejemplo descargable
- Incluye datos de ejemplo para referencia
- Fácil de abrir en Excel, Google Sheets o LibreOffice

---

## 📋 Estructura del Archivo Excel/CSV

El archivo debe tener las siguientes columnas **en este orden exacto**:

| Columna | Tipo | Descripción | Ejemplo |
|---------|------|-------------|---------|
| nombre | Texto | Nombre del producto | Chocolate Negro |
| descripcion | Texto | Descripción del producto | Chocolate premium de alta calidad |
| precio | Número | Precio del producto | 5.99 |
| stock | Entero | Cantidad en stock | 100 |
| categoria_id | Entero | ID de la categoría existente | 1 |

---

## 🔄 Flujo de Importación

```
Usuario selecciona archivo
         ↓
Validación de formato y tamaño
         ↓
¿Es Excel (.xlsx/.xls)?
    ├─ Sí → Procesar con PhpSpreadsheet (si disponible)
    └─ No → Procesar como CSV
         ↓
Leer cada fila (excepto encabezado)
         ↓
Validar datos de cada fila:
  ├─ Nombre no vacío
  ├─ Descripción no vacía
  ├─ Precio válido (número > 0)
  ├─ Stock válido (entero > 0)
  ├─ Categoría existe en BD
         ↓
¿Validación OK?
    ├─ Sí → Crear producto
    └─ No → Guardar error, pasar siguiente
         ↓
Retornar resumen:
  ├─ Productos importados exitosamente
  └─ Errores encontrados
         ↓
Mostrar notificación al usuario
```

---

## 🎯 Validaciones Implementadas

### Nivel de Archivo
- ✓ Archivo requerido
- ✓ Formato: .xlsx, .xls o .csv
- ✓ Tamaño máximo: 5 MB

### Nivel de Fila
- ✓ Nombre no puede estar vacío
- ✓ Descripción no puede estar vacía
- ✓ Precio debe ser número > 0
- ✓ Stock debe ser entero > 0
- ✓ Categoría ID debe existir en BD

### Manejo de Errores
- ✓ Errores no impiden importación de productos válidos
- ✓ Se reportan errores por número de fila
- ✓ Se muestra cantidad de productos importados
- ✓ Se muestra cantidad de errores encontrados

---

## 📱 Interfaz de Usuario

### Vista Principal (index.blade.php)
- Botón "Importar desde Excel" junto al botón de agregar
- Modal con instrucciones detalladas
- Ejemplo de formato correcto
- Descarga de plantilla

### Modal de Importación
- Sección de instrucciones con lista de requerimientos
- Enlace para descargar plantilla de ejemplo
- Input de archivo con validación
- Advertencia sobre importación
- Botones Cancelar e Importar

### Notificaciones
- Éxito: Cantidad de productos importados
- Error: Mensaje descriptivo del problema
- AlertaSweetAlert2 para mejor UX

---

## 🛠️ Archivos Creados/Modificados

### Creados:
- [GUIA_IMPORTAR_PRODUCTOS.md](GUIA_IMPORTAR_PRODUCTOS.md) - Documentación detallada
- [public/plantilla_productos.csv](public/plantilla_productos.csv) - Archivo de ejemplo

### Modificados:
- [app/Http/Controllers/ProductoController.php](app/Http/Controllers/ProductoController.php) - Agregados métodos de importación
- [routes/web.php](routes/web.php) - Agregada ruta de importación
- [resources/views/productos/index.blade.php](resources/views/productos/index.blade.php) - Agregado botón y modal

---

## 🚀 Cómo Usar

1. **Ir a Lista de Productos**
2. **Hacer clic en "Importar desde Excel"**
3. **Descargar la plantilla de ejemplo** (opcional)
4. **Preparar el archivo con los datos**
5. **Seleccionar el archivo en el formulario**
6. **Hacer clic en "Importar"**
7. **Ver resultados: productos creados y errores**

---

## ⚠️ Notas Importantes

- **No actualiza productos existentes**: Solo crea nuevos
- **No importa imágenes**: Solo datos, las imágenes se agregan manualmente
- **Respeta validaciones**: Los datos inválidos no se crean
- **Verifica categorías**: El ID de categoría debe existir
- **Previene duplicados parcialmente**: Revisa los datos antes de importar

---

## 🔧 Requisitos del Sistema

- PHP 8.0+
- Laravel 10+
- Base de datos con tabla de productos
- Tabla de categorías con IDs válidos
- PhpSpreadsheet (opcional, cae a CSV si no está disponible)

---

## 📞 Troubleshooting

| Problema | Solución |
|----------|----------|
| "Error 500" | Verifica los permisos de carpeta storage |
| "Archivo no válido" | Asegúrate de usar .xlsx, .xls o .csv |
| "Categoría no existe" | Crea la categoría primero o usa ID válido |
| "Precio inválido" | Usa punto (.) para decimales, no coma (,) |
| "Stock inválido" | Usa solo números enteros |
| "Nombre vacío" | Todas las filas deben tener nombre |

