@extends('layouts.app')

@section('content')
<style>
    .productos-grid {
        display: flex;
        flex-wrap: wrap;
        gap: 28px;
        justify-content: center;
        margin-top: 28px;
    }
    .producto-card {
        background: #fff;
        border-radius: 16px;
        box-shadow: 0 4px 16px rgba(18, 33, 61, 0.10);
        border: 1px solid #e0e0e0;
        padding: 18px 14px 16px 14px;
        width: 220px;
        display: flex;
        flex-direction: column;
        align-items: center;
        transition: transform 0.2s, box-shadow 0.2s;
    }
    .producto-card:hover {
        transform: translateY(-6px) scale(1.03);
        box-shadow: 0 8px 32px rgba(18, 33, 61, 0.18);
        border-color: rgba(217, 140, 82, 1);
    }
    .producto-card img {
        width: 120px;
        height: 120px;
        object-fit: cover;
        border-radius: 12px;
        margin-bottom: 12px;
        border: 1.5px solid rgba(217, 140, 82, 1);
        background: #f6f6f6;
    }
    .producto-card h5 {
        font-size: 1.08rem;
        font-weight: 700;
        margin-bottom: 6px;
        color: rgba(18, 33, 61, 1);
        text-align: center;
    }
    .producto-card p {
        font-size: 1rem;
        color: #333;
        margin-bottom: 10px;
        text-align: center;
    }
    .producto-card .btn {
        background: rgba(18, 33, 61, 1);
        color: rgba(246, 253, 254, 1);
        border: none;
        border-radius: 8px;
        font-weight: 600;
        transition: background 0.2s;
        padding: 6px 18px;
        margin: 0 4px;
    }
    .producto-card .btn:hover {
        background: rgba(217, 140, 82, 1);
        color: rgba(18, 33, 61, 1);
    }
    .producto-card .btn-carrito {
        background: rgba(217, 140, 82, 1);
        color: rgba(18, 33, 61, 1);
        border: none;
        border-radius: 8px;
        padding: 6px 14px;
        font-size: 1.2rem;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        margin: 0 4px;
        transition: background 0.2s, color 0.2s;
    }
    .producto-card .btn-carrito:hover {
        background: rgba(18, 33, 61, 1);
        color: rgba(246, 253, 254, 1);
    }
    .producto-card .btns-group {
        display: flex;
        justify-content: center;
        gap: 6px;
        width: 100%;
        margin-top: 4px;
    }
    .search-header {
        background: #f1f4f8;
        padding: 30px 20px;
        border-radius: 15px;
        margin-bottom: 30px;
    }
</style>

<div class="container">
    <div class="search-header text-center">
        <h2 style="color:rgba(18, 33, 61, 1);">Resultados de búsqueda</h2>
        <p class="text-muted">Buscando: <strong>"{{ $query }}"</strong></p>
        
        <div class="row justify-content-center mt-3">
            <div class="col-md-6">
                <form action="{{ route('productos.buscar') }}" method="GET" class="d-flex shadow-sm" style="border-radius: 50px; overflow: hidden; border: 2px solid rgba(18, 33, 61, 0.1);">
                    <input type="text" name="query" class="form-control border-0 px-4" placeholder="Buscar otro producto..." value="{{ $query }}" required style="font-size: 1.1rem; border-radius: 0;">
                    <button type="submit" class="btn border-0 px-4" style="background: rgba(217, 140, 82, 1); color: white; border-radius: 0;">
                        <i class="fas fa-search"></i>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="d-flex justify-content-between align-items-center mb-4">
        <a href="{{ url('/') }}" class="btn btn-outline-dark"><i class="fas fa-arrow-left"></i> Volver al inicio</a>
        <span class="text-muted">{{ $productos->count() }} productos encontrados</span>
    </div>

    @if ($productos->isEmpty())
        <div class="text-center py-5">
            <i class="fas fa-box-open fa-4x mb-3" style="color: #ccc;"></i>
            <p style="text-align: center; font-size: 1.2rem;">No se encontraron productos coincidentes con tu búsqueda.</p>
            <a href="{{ url('/') }}" class="btn mt-3" style="background: rgba(18, 33, 61, 1); color: white;">Ver todo el catálogo</a>
        </div>
    @else
        <div class="productos-grid">
            @foreach ($productos as $producto)
            <div class="producto-card">
                @if($producto->imagen)
                    <img src="{{ asset('storage/' . $producto->imagen) }}" alt="{{ $producto->nombre }}">
                @else
                    <div style="width: 120px; height: 120px; background: #eee; border-radius: 12px; display: flex; align-items: center; justify-content: center; margin-bottom: 12px; border: 1.5px solid rgba(217, 140, 82, 0.5);">
                        <i class="fas fa-image text-muted fa-2x"></i>
                    </div>
                @endif
                <h5>{{ $producto->nombre }}</h5>
                <p>${{ number_format($producto->precio, 0, ',', '.') }}</p>
                <div class="btns-group">
                    <a href="#" class="btn btn-ver-producto" 
                       data-id="{{ $producto->id }}"
                       data-nombre="{{ $producto->nombre }}"
                       data-precio="{{ $producto->precio }}"
                       data-imagen="{{ $producto->imagen ? asset('storage/' . $producto->imagen) : '' }}"
                       data-descripcion="{{ $producto->descripcion ?? '' }}"
                       data-categoria="{{ $producto->categoria->nombre ?? 'Sin categoría' }}"
                       data-stock="{{ $producto->stock ?? '' }}"
                       >
                       Ver
                    </a>
                    <button type="button" class="btn-carrito" title="Agregar al carrito" onclick="agregarAlCarrito({{ $producto->id }}, '{{ $producto->nombre }}', {{ $producto->precio }}, '{{ $producto->imagen ?? '' }}')">
                        <i class="fas fa-shopping-cart"></i>
                    </button>
                </div>
            </div>
            @endforeach
        </div>
    @endif
    <br>
</div>

<!-- Modal Producto -->
<div class="modal fade" id="modalProducto" tabindex="-1" aria-labelledby="modalProductoLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content" style="border-radius: 16px;">
      <div class="modal-header" style="background:rgba(18, 33, 61, 1);">
        <h5 class="modal-title" id="modalProductoLabel" style="color:rgba(246, 253, 254, 1);"></h5>
        <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Cerrar"></button>
      </div>
      <div class="modal-body d-flex flex-column align-items-center">
        <img id="modalProductoImagen" src="" alt="Imagen producto" style="width:140px; height:140px; border-radius:12px; border:2px solid rgba(217, 140, 82, 1); margin-bottom:14px;">
        <p id="modalProductoCategoria" style="color:rgba(217, 140, 82, 1); font-weight:600; margin-bottom:6px;"></p>
        <p id="modalProductoDescripcion" style="color:#222; text-align:center;"></p>
        <p class="fw-bold" style="color:rgba(18, 33, 61, 1); font-size:1.2rem;">Precio: $<span id="modalProductoPrecio"></span></p>
        <p id="modalProductoStock" style="color:#888; font-size:0.95rem;"></p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-carrito-modal" style="background:rgba(217, 140, 82, 1); color:rgba(18, 33, 61, 1); border-radius:8px;">
            <i class="fas fa-shopping-cart"></i> Agregar al carrito
        </button>
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
      </div>
    </div>
  </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    let carrito = JSON.parse(localStorage.getItem('carrito')) || [];

    function agregarAlCarrito(id, nombre, precio, imagen) {
        const existente = carrito.find(p => p.id === id);
        if (existente) {
            existente.cantidad += 1;
        } else {
            carrito.push({id, nombre, precio, imagen, cantidad: 1});
        }
        localStorage.setItem('carrito', JSON.stringify(carrito));
        if (window.actualizarContadorCarrito) {
            window.actualizarContadorCarrito();
        }
        Swal.fire({
            icon: 'success',
            title: '¡Agregado!',
            text: 'El producto se agregó al carrito.',
            timer: 1000,
            showConfirmButton: false
        });
    }

    document.addEventListener('DOMContentLoaded', function() {
        document.querySelectorAll('.btn-ver-producto').forEach(function(btn) {
            btn.addEventListener('click', function(e) {
                e.preventDefault();
                const id = btn.getAttribute('data-id');
                const nombre = btn.getAttribute('data-nombre');
                const precio = btn.getAttribute('data-precio');
                const imagen = btn.getAttribute('data-imagen');
                const descripcion = btn.getAttribute('data-descripcion') || 'Sin descripción disponible.';
                const categoria = btn.getAttribute('data-categoria') || '';
                const stock = btn.getAttribute('data-stock') || '';

                document.getElementById('modalProductoLabel').textContent = nombre;
                document.getElementById('modalProductoImagen').src = imagen ? imagen : 'https://via.placeholder.com/140';
                document.getElementById('modalProductoPrecio').textContent = new Intl.NumberFormat().format(precio);
                document.getElementById('modalProductoDescripcion').textContent = descripcion;
                document.getElementById('modalProductoCategoria').textContent = categoria ? "Categoría: " + categoria : "";
                document.getElementById('modalProductoStock').textContent = stock ? "Stock disponible: " + stock : "";

                document.querySelector('.btn-carrito-modal').onclick = function() {
                    agregarAlCarrito(Number(id), nombre, Number(precio), imagen);
                };

                var modal = new bootstrap.Modal(document.getElementById('modalProducto'));
                modal.show();
            });
        });
    });
</script>
@endsection
