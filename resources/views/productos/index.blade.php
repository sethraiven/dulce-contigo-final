@extends('layouts.app')

@section('content')
    <style>
        .banner-productos {
            background: linear-gradient(135deg, rgba(18, 33, 61, 1) 0%, rgba(38, 53, 81, 1) 100%);
            color: rgba(246, 253, 254, 1);
            padding: 10px 15px;
            text-align: center;
            margin-bottom: 15px;
            border-radius: 0;
            box-shadow: 0 4px 12px rgba(18, 33, 61, 0.2);
        }

        .banner-productos h1 {
            font-size: 1.4rem;
            font-weight: 700;
            margin: 0;
            letter-spacing: 0.05em;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.3);
        }

        .banner-productos p {
            font-size: 0.75rem;
            margin: 3px 0 0 0;
            opacity: 0.95;
            font-weight: 300;
        }
    </style>

    <div class="banner-productos">
        <h1><i class="fa fa-cubes"></i>Catálogo de Productos como administrador</h1>
        <p>Gestiona y organiza tu inventario</p>
    </div>

    <div class="container">
        @auth
            <div class="mb-3">
                <a href="#" class="btn btn-outline-dark" style="font-weight:600; border-radius: 1.5rem; margin-right: 10px;"
                    data-bs-toggle="modal" data-bs-target="#crearProductoModal">
                    <i class="fa fa-plus"></i> Agregar Nuevo Producto
                </a>
                <a href="#" class="btn btn-outline-info" style="font-weight:600; border-radius: 1.5rem;"
                    data-bs-toggle="modal" data-bs-target="#importarExcelModal">
                    <i class="fa fa-file-excel"></i> Importar desde Excel
                </a>
            </div>
        @endauth

        @if (session('success') || session('error'))
            <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            <script>
                document.addEventListener('DOMContentLoaded', function() {
                    @if (session('success'))
                        Swal.fire({
                            icon: 'success',
                            title: '¡Éxito!',
                            text: '{{ session('success') }}',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    @endif
                    @if (session('error'))
                        Swal.fire({
                            icon: 'error',
                            title: '¡Error!',
                            text: '{{ session('error') }}',
                            timer: 2000,
                            showConfirmButton: false,
                        });
                    @endif
                });
            </script>
        @endif

        @if ($productos->isEmpty())
            <p>No hay productos registrados.</p>
        @else
            <style>
                #productos-table {
                    background: #fff;
                    border-radius: 16px;
                    box-shadow: 0 4px 16px rgba(18, 33, 61, 0.10);
                    overflow: hidden;
                    font-size: 1rem;
                }

                #productos-table th {
                    background: rgba(18, 33, 61, 1);
                    color: rgba(246, 253, 254, 1);
                    text-align: center;
                    font-weight: 700;
                    border-bottom: 2px solid rgba(217, 140, 82, 1);
                    vertical-align: middle;
                }

                #productos-table td {
                    vertical-align: middle;
                    text-align: center;
                    color: #222;
                    background: #f9f9f9;
                }

                #productos-table tbody tr:hover {
                    background: #eefaf3;
                    transition: background 0.2s;
                }

                #productos-table img {
                    border-radius: 8px;
                    border: 2px solid rgba(217, 140, 82, 1);
                    background: #f6f6f6;
                    max-width: 80px;
                    max-height: 80px;
                    object-fit: cover;
                    margin: 0 auto;
                    display: block;
                }

                .btn-warning.btn-sm {
                    background: rgba(217, 140, 82, 1);
                    color: rgba(18, 33, 61, 1);
                    border: none;
                    border-radius: 6px;
                    font-weight: 600;
                    padding: 4px 10px;
                    font-size: 1rem;
                }

                .btn-warning.btn-sm:hover {
                    background: rgba(18, 33, 61, 1);
                    color: rgba(246, 253, 254, 1);
                }

                .btn-danger.btn-sm {
                    background: rgba(18, 33, 61, 1);
                    color: rgba(246, 253, 254, 1);
                    border: none;
                    border-radius: 6px;
                    font-weight: 600;
                    padding: 4px 10px;
                    font-size: 1rem;
                }

                .btn-danger.btn-sm:hover {
                    background: rgba(217, 140, 82, 1);
                    color: rgba(18, 33, 61, 1);
                }

                /* Estilos para la modal de edición */
                #editarProductoModal .modal-content {
                    border-radius: 16px;
                    box-shadow: 0 2px 16px rgba(18, 33, 61, 0.12);
                    border: 1px solid #e0e0e0;
                }

                #editarProductoModal .modal-header {
                    background: rgba(18, 33, 61, 1);
                    color: rgba(246, 253, 254, 1);
                    border-radius: 16px 16px 0 0;
                    font-weight: bold;
                    text-align: center;
                }

                #editarProductoModal .modal-title {
                    font-size: 1.3rem;
                    font-weight: 700;
                    letter-spacing: 1px;
                }

                #editarProductoModal .btn-primary {
                    background: rgba(18, 33, 61, 1);
                    border: none;
                    font-weight: 600;
                    border-radius: 8px;
                }

                #editarProductoModal .btn-primary:hover {
                    background: rgba(217, 140, 82, 1);
                    color: rgba(246, 253, 254, 1);
                }

                #editarProductoModal .btn-secondary {
                    border-radius: 8px;
                }

                #editarProductoModal .form-label {
                    color: rgba(18, 33, 61, 1);
                    font-weight: 600;
                }

                #editarProductoModal .form-control:focus {
                    border-color: rgba(18, 33, 61, 1);
                    box-shadow: none;
                }

                #editarProductoModal .form-control {
                    border-radius: 10px;
                    border: 1px solid #ced4da;
                    box-shadow: none;
                }

                /* Estilos para la modal de creación */
                #crearProductoModal .modal-content {
                    border-radius: 16px;
                    box-shadow: 0 2px 16px rgba(18, 33, 61, 0.12);
                    border: 1px solid #e0e0e0;
                }

                #crearProductoModal .modal-header {
                    background: rgba(18, 33, 61, 1);
                    color: rgba(246, 253, 254, 1);
                    border-radius: 16px 16px 0 0;
                    font-weight: bold;
                    text-align: center;
                }

                #crearProductoModal .modal-title {
                    font-size: 1.3rem;
                    font-weight: 700;
                    letter-spacing: 1px;
                }

                #crearProductoModal .btn-primary {
                    background: rgba(18, 33, 61, 1);
                    border: none;
                    font-weight: 600;
                    border-radius: 8px;
                }

                #crearProductoModal .btn-primary:hover {
                    background: rgba(217, 140, 82, 1);
                    color: rgba(246, 253, 254, 1);
                }

                #crearProductoModal .btn-secondary {
                    border-radius: 8px;
                }

                #crearProductoModal .form-label {
                    color: rgba(18, 33, 61, 1);
                    font-weight: 600;
                }

                #crearProductoModal .form-control:focus {
                    border-color: rgba(18, 33, 61, 1);
                    box-shadow: none;
                }

                #crearProductoModal .form-control {
                    border-radius: 10px;
                    border: 1px solid #ced4da;
                    box-shadow: none;
                }

                .btn-excel {
                    background: #28a745 !important;
                    color: #fff !important;
                    border: none !important;
                    border-radius: 6px !important;
                    font-weight: 600 !important;
                    margin-right: 8px !important;
                    padding: 6px 16px !important;
                    font-size: 1rem !important;
                    box-shadow: 0 2px 8px rgba(40, 167, 69, 0.08);
                    transition: background 0.2s;
                }

                .btn-excel:hover {
                    background: #218838 !important;
                    color: #fff !important;
                }

                .btn-pdf {
                    background: #dc3545 !important;
                    color: #fff !important;
                    border: none !important;
                    border-radius: 6px !important;
                    font-weight: 600 !important;
                    padding: 6px 16px !important;
                    font-size: 1rem !important;
                    box-shadow: 0 2px 8px rgba(220, 53, 69, 0.08);
                    transition: background 0.2s;
                }

                .btn-pdf:hover {
                    background: #b52a37 !important;
                    color: #fff !important;
                }

                @media (max-width: 768px) {

                    #productos-table th,
                    #productos-table td {
                        font-size: 0.95rem;
                        padding: 6px 4px;
                    }
                }
            </style>

            <table id="productos-table" class="table table-bordered">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Categoría</th>
                        <th>Imagen</th>
                        <th>Fecha de creación</th>
                        @auth
                            <th>Acciones</th>
                        @endauth
                    </tr>
                </thead>
                <tbody>
                    @foreach ($productos as $producto)
                        <tr>
                            <td>{{ $producto->nombre }}</td>
                            <td>{{ $producto->descripcion }}</td>
                            <td>${{ $producto->precio }}</td>
                            <td>{{ $producto->stock }}</td>
                            <td>{{ $producto->categoria->nombre ?? 'sin categoria' }}</td>
                            <td>
                                @if ($producto->imagen)
                                    <img src="{{ asset('storage/' . $producto->imagen) }}" width="80"
                                        alt="imagen del producto">
                                @else
                                    Sin imagen
                                @endif
                            </td>
                            <td>{{ $producto->created_at->format('d/m/Y H:i') }}</td>
                            @auth
                                <td>
                                    <!-- Botón para abrir el modal de edición -->
                                    <button class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                        data-bs-target="#editarProductoModal" data-id="{{ $producto->id }}"
                                        data-nombre="{{ $producto->nombre }}" data-descripcion="{{ $producto->descripcion }}"
                                        data-precio="{{ $producto->precio }}" data-stock="{{ $producto->stock }}"
                                        data-categoria="{{ $producto->categoria_id }}"
                                        data-imagen="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : '' }}"
                                        title="Editar">
                                        <i class='bx bxs-edit-alt'></i>
                                    </button>
                                    <form action="{{ route('productos.destroy', $producto->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger btn-sm"
                                            onclick="return confirm('¿Estás seguro de que quieres eliminar este producto?')"><i
                                                class='bx bxs-trash'></i></button>
                                    </form>
                                </td>
                            @endauth
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <!-- Modal de edición de producto -->
        <div class="modal fade" id="editarProductoModal" tabindex="-1" aria-labelledby="editarProductoLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form id="formEditarProducto" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="editarProductoLabel">Editar Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="modal-nombre" class="form-label">Nombre:</label>
                                <input type="text" name="nombre" id="modal-nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="modal-descripcion" class="form-label">Descripción:</label>
                                <textarea name="descripcion" id="modal-descripcion" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="modal-precio" class="form-label">Precio:</label>
                                <input type="number" name="precio" id="modal-precio" class="form-control" min="0"
                                    step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="modal-stock" class="form-label">Stock:</label>
                                <input type="number" name="stock" id="modal-stock" class="form-control" min="0"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="modal-categoria" class="form-label">Categoría:</label>
                                <select name="categoria_id" id="modal-categoria" class="form-control" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Imagen actual:</label>
                                <div id="modal-imagen-preview" class="mb-2"></div>
                                <label for="modal-imagen" class="form-label">Cambiar imagen:</label>
                                <input type="file" name="imagen" id="modal-imagen" class="form-control"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <!-- Modal de creación de producto -->
        <div class="modal fade" id="crearProductoModal" tabindex="-1" aria-labelledby="crearProductoLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <form action="{{ route('productos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="crearProductoLabel">Agregar Nuevo Producto</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                aria-label="Cerrar"></button>
                        </div>
                        <div class="modal-body">
                            <div class="mb-3">
                                <label for="crear-nombre" class="form-label">Nombre:</label>
                                <input type="text" name="nombre" id="crear-nombre" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label for="crear-descripcion" class="form-label">Descripción:</label>
                                <textarea name="descripcion" id="crear-descripcion" class="form-control" rows="2"></textarea>
                            </div>
                            <div class="mb-3">
                                <label for="crear-precio" class="form-label">Precio:</label>
                                <input type="number" name="precio" id="crear-precio" class="form-control"
                                    min="0" step="0.01" required>
                            </div>
                            <div class="mb-3">
                                <label for="crear-stock" class="form-label">Stock:</label>
                                <input type="number" name="stock" id="crear-stock" class="form-control"
                                    min="0" required>
                            </div>
                            <div class="mb-3">
                                <label for="crear-categoria" class="form-label">Categoría:</label>
                                <select name="categoria_id" id="crear-categoria" class="form-control" required>
                                    <option value="">Seleccione una categoría</option>
                                    @foreach ($categorias as $cat)
                                        <option value="{{ $cat->id }}">{{ $cat->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="crear-imagen" class="form-label">Imagen:</label>
                                <input type="file" name="imagen" id="crear-imagen" class="form-control"
                                    accept="image/*">
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-primary">Crear</button>
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>

        <script>
            $(document).ready(function() {
                $('#productos-table').DataTable({
                    responsive: true,
                    dom: 'Bfrtip',
                    buttons: [{
                            extend: 'excelHtml5',
                            text: '<i class="fas fa-file-excel"></i>',
                            titleAttr: 'Exportar a Excel',
                            className: 'btn-excel'
                        },
                        {
                            extend: 'pdfHtml5',
                            text: '<i class="fas fa-file-pdf"></i>',
                            titleAttr: 'Exportar a PDF',
                            className: 'btn-pdf',
                            orientation: 'landscape',
                            pageSize: 'A4'
                        }
                    ],
                    language: {
                        search: "Buscar:",
                        lengthMenu: "Mostrar _MENU_ registros por página",
                        info: "Mostrando _START_ a _END_ de _TOTAL_ registros",
                        infoEmpty: "No hay registros disponibles",
                        infoFiltered: "(filtrado de _MAX_ registros totales)",
                        paginate: {
                            first: "Primero",
                            last: "Último",
                            next: "Siguiente",
                            previous: "Anterior"
                        },
                        zeroRecords: "No se encontraron registros coincidentes",
                        emptyTable: "No hay datos disponibles en la tabla"
                    }
                });

                // Modal edición producto
                var editarModal = document.getElementById('editarProductoModal');
                editarModal.addEventListener('show.bs.modal', function(event) {
                    var button = event.relatedTarget;
                    var id = button.getAttribute('data-id');
                    var nombre = button.getAttribute('data-nombre');
                    var descripcion = button.getAttribute('data-descripcion');
                    var precio = button.getAttribute('data-precio');
                    var stock = button.getAttribute('data-stock');
                    var categoria = button.getAttribute('data-categoria');
                    var imagen = button.getAttribute('data-imagen');
                    var preview = document.getElementById('modal-imagen-preview');

                    document.getElementById('modal-nombre').value = nombre;
                    document.getElementById('modal-descripcion').value = descripcion;
                    document.getElementById('modal-precio').value = precio;
                    document.getElementById('modal-stock').value = stock;
                    document.getElementById('modal-categoria').value = categoria;

                    if (imagen) {
                        preview.innerHTML = '<img src="' + imagen +
                            '" alt="Imagen actual" style="max-width:100px;max-height:100px;border-radius:8px;border:1px solid #ccc;">';
                    } else {
                        preview.innerHTML = '<span class="text-muted">Sin imagen</span>';
                    }

                    var form = document.getElementById('formEditarProducto');
                    form.action = '/productos/' + id;
                });
            });
        </script>

        <!-- Modal Importar Excel -->
        <div class="modal fade" id="importarExcelModal" tabindex="-1" aria-labelledby="importarExcelModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header" style="background: rgba(18, 33, 61, 1); color: rgba(246, 253, 254, 1);">
                        <h5 class="modal-title" id="importarExcelModalLabel">
                            <i class="fa fa-file-excel"></i> Importar Productos desde Excel
                        </h5>
                        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{ route('productos.importar-excel') }}" method="POST" enctype="multipart/form-data" id="formImportarExcel">
                        @csrf
                        <div class="modal-body">
                            <div class="alert alert-info" role="alert">
                                <strong>Instrucciones:</strong><br>
                                <ul style="margin-bottom: 0; margin-top: 10px;">
                                    <li>El archivo debe ser en formato <strong>.xlsx</strong>, <strong>.xls</strong> o <strong>.csv</strong></li>
                                    <li>La primera fila debe contener los encabezados</li>
                                    <li>Columnas requeridas (en este orden):
                                        <ol style="margin-bottom: 0; margin-top: 5px;">
                                            <li><strong>nombre</strong> - Nombre del producto</li>
                                            <li><strong>descripcion</strong> - Descripción del producto</li>
                                            <li><strong>precio</strong> - Precio del producto (número)</li>
                                            <li><strong>stock</strong> - Cantidad en stock (número entero)</li>
                                            <li><strong>categoria_id</strong> - ID de la categoría</li>
                                        </ol>
                                    </li>
                                    <li>Ejemplo de fila: Chocolate | Delicioso chocolate negro | 5.99 | 100 | 1</li>
                                </ul>
                            </div>

                            <div class="mb-3">
                                <a href="{{ asset('plantilla_productos.csv') }}" class="btn btn-sm btn-secondary mb-3" download>
                                    <i class="fa fa-download"></i> Descargar plantilla de ejemplo
                                </a>
                            </div>

                            <div class="mb-3">
                                <label for="archivoImportar" class="form-label">Seleccionar archivo</label>
                                <input type="file" class="form-control" id="archivoImportar" name="archivo" accept=".xlsx,.xls,.csv" required>
                                <small class="text-muted">Tamaño máximo: 5 MB</small>
                            </div>

                            <div class="alert alert-warning" role="alert">
                                <strong>⚠️ Importante:</strong> Verifica que los datos sean correctos antes de importar. Los productos con errores en validación no serán creados.
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                            <button type="submit" class="btn" style="background:rgba(217, 140, 82, 1); color:rgba(18, 33, 61, 1); font-weight:600;">
                                <i class="fa fa-upload"></i> Importar
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>    </div>
@endsection