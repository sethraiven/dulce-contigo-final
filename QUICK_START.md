# ⚡ Quick Start - Importar Productos en 5 Minutos

## Paso 1: Descarga la Plantilla
1. Ve a tu aplicación → Lista de Productos
2. Haz clic en **"Importar desde Excel"**
3. Haz clic en **"Descargar plantilla de ejemplo"**
4. Se descargará `plantilla_productos.csv`

## Paso 2: Abre en Excel
1. Abre el archivo descargado con Excel, Google Sheets o LibreOffice
2. Verás estas columnas:
   ```
   nombre | descripcion | precio | stock | categoria_id
   ```

## Paso 3: Completa tus Productos
Ejemplo:
```
nombre                  | descripcion                        | precio | stock | categoria_id
Chocolate Negro         | Chocolate premium 70% cacao        | 5.99   | 100   | 1
Galletas de Vainilla    | Galletas crujientes                | 2.50   | 150   | 2
Torta de Fresa         | Torta con relleno de fresa fresca  | 8.99   | 50    | 3
```

**Importante:**
- ✓ Deja el encabezado como está
- ✓ Usa punto (.) en los precios: `5.99` no `5,99`
- ✓ Stock deben ser números enteros: `100` no `100.5`
- ✓ El categoria_id debe existir en tu base de datos

## Paso 4: Guarda el Archivo
1. Guarda en uno de estos formatos:
   - Excel: `.xlsx` o `.xls`
   - CSV: `.csv` (más simple)

## Paso 5: Importa en la Aplicación
1. Ve de nuevo a **"Importar desde Excel"**
2. Haz clic en el campo de archivo
3. Selecciona tu archivo completado
4. Haz clic en **"Importar"**

## Listo! ✅
- Si todo está correcto: Verás "Se importaron X productos exitosamente"
- Si hay errores: Te mostrarán qué filas tienen problemas

---

## 🔍 Validación Rápida

Antes de importar, asegúrate de:

| ✓ | Verificar |
|---|----------|
| ✓ | Todos los productos tienen nombre |
| ✓ | Todos tienen descripción |
| ✓ | Los precios son números (5.99, no "5,99") |
| ✓ | El stock son números enteros (100, no 100.5) |
| ✓ | El categoria_id corresponde a una categoría existente |

---

## ⚠️ Errores Comunes

| Error | Solución |
|-------|----------|
| "El precio debe ser un número válido" | Usa punto (.) en lugar de coma (,) |
| "El stock debe ser un número entero" | No uses decimales en stock |
| "La categoría con ID X no existe" | Crea la categoría primero |
| "El nombre es requerido" | Completa el nombre en todas las filas |
| "Archivo mayor a 5 MB" | Reduce el tamaño o divide en varios archivos |

---

## 💡 Tips Útiles

1. **Si usas Google Sheets:**
   - Crea la hoja
   - Completa los datos
   - Descarga como CSV (Archivo → Descargar → CSV)
   - Importa en la app

2. **Si usas Excel:**
   - Abre la plantilla descargada
   - Completa datos
   - Guarda como .xlsx
   - Importa directamente

3. **Para actualizar precios:**
   - Importa productos nuevos
   - Edita los existentes manualmente en la lista

4. **Para grandes volúmenes:**
   - Divide en archivos de máximo 5 MB
   - Importa de uno en uno

---

## ✨ Estructura del Archivo en Detalle

### Primera fila (ENCABEZADOS):
```
nombre,descripcion,precio,stock,categoria_id
```
**¡NO cambies esto!**

### Filas de datos:
```
Chocolate Negro,Delicioso chocolate premium,5.99,100,1
```

**Separación:** Comas sin espacios (excepto dentro del texto)
**Orden:** Siempre en el mismo orden que los encabezados

---

## 🎯 Ejemplo Completo

### Archivo CSV válido:
```csv
nombre,descripcion,precio,stock,categoria_id
Chocolate Negro,Chocolate 70% cacao,5.99,100,1
Galletas de Vainilla,Galletas crujientes,2.50,150,2
Brownies,Brownies con nueces,4.99,80,1
Helado de Fresa,Helado artesanal,5.50,60,3
Caramelos,Caramelos de frutas,3.00,200,1
```

### Resultado de la importación:
```
✅ Se importaron 5 productos exitosamente.
```

---

## 📞 ¿Algo No Funciona?

1. **Revisa la estructura del archivo**
   - Ver: `EJEMPLOS_IMPORTACION.md`

2. **Verifica los datos**
   - Ver: `GUIA_IMPORTAR_PRODUCTOS.md`

3. **Consulta la documentación técnica**
   - Ver: `IMPLEMENTACION_IMPORTACION.md`

---

## 🚀 ¡Ya Estás Listo!

Ahora puedes importar fácilmente cientos de productos en minutos.

**¡Éxito con tu importación!** 🎉
