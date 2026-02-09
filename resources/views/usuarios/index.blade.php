@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3 d-flex justify-content-between align-items-center">
                    <h4 class="mb-0 fw-bold" style="color:rgba(18, 33, 61, 1);">
                        <i class="fas fa-users me-2" style="color:rgba(217, 140, 82, 1);"></i> Gestión de Usuarios
                    </h4>
                    <a href="{{ route('register') }}" class="btn" style="background:rgba(18, 33, 61, 1); color:rgba(246, 253, 254, 1); font-weight:600;">
                        <i class="fas fa-user-plus me-1"></i> Registrar Nuevo
                    </a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            <i class="fas fa-check-circle me-1"></i> {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    @if(session('error'))
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <i class="fas fa-exclamation-circle me-1"></i> {{ session('error') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <div class="table-responsive">
                        <table class="table table-hover align-middle" id="usuariosTable">
                            <thead style="background:rgba(18, 33, 61, 1); color:rgba(246, 253, 254, 1);">
                                <tr>
                                    <th style="color:rgba(246, 253, 254, 1);">ID</th>
                                    <th style="color:rgba(246, 253, 254, 1);">Nombre</th>
                                    <th style="color:rgba(246, 253, 254, 1);">Correo Electrónico</th>
                                    <th style="color:rgba(246, 253, 254, 1);">Fecha de Registro</th>
                                    <th class="text-center" style="color:rgba(246, 253, 254, 1);">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($usuarios as $usuario)
                                <tr>
                                    <td><span class="badge" style="background:rgba(246, 253, 254, 1); color:rgba(18, 33, 61, 1); border:1px solid rgba(18, 33, 61, 0.1);">#{{ $usuario->id }}</span></td>
                                    <td><span class="fw-semibold" style="color:rgba(18, 33, 61, 1);">{{ $usuario->name }}</span></td>
                                    <td>{{ $usuario->email }}</td>
                                    <td>{{ $usuario->created_at ? $usuario->created_at->format('d/m/Y') : 'N/A' }}</td>
                                    <td class="text-center">
                                        <div class="d-flex justify-content-center gap-2">
                                            <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn btn-sm" style="background:rgba(217, 140, 82, 1); color:rgba(18, 33, 61, 1);" title="Editar">
                                                <i class="fas fa-edit"></i>
                                            </a>
                                            <form action="{{ route('usuarios.destroy', $usuario->id) }}" method="POST" onsubmit="return confirm('¿Estás seguro de que deseas eliminar este usuario?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-sm" style="background:rgba(18, 33, 61, 1); color:rgba(246, 253, 254, 1);" title="Eliminar" {{ auth()->id() == $usuario->id ? 'disabled' : '' }}>
                                                    <i class="fas fa-trash"></i>
                                                </button>
                                            </form>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(document).ready(function() {
        $('#usuariosTable').DataTable({
            responsive: true,
            language: {
                url: '//cdn.datatables.net/plug-ins/1.13.6/i18n/es-ES.json'
            }
        });
    });
</script>
@endsection
