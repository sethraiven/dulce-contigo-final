@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-sm border-0">
                <div class="card-header bg-white py-3">
                    <h4 class="mb-0 fw-bold" style="color:rgba(18, 33, 61, 1);">
                                <i class="fas fa-user-edit me-2" style="color:rgba(217, 140, 82, 1);"></i> Editar Usuario
                    </h4>
                </div>

                <div class="card-body p-4">
                    <form action="{{ route('usuarios.update', $usuario->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label fw-semibold" style="color:rgba(18, 33, 61, 1);">Nombre Completos</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-user text-muted"></i></span>
                                <input type="text" class="form-control border-start-0 @error('name') is-invalid @enderror" id="name" name="name" value="{{ old('name', $usuario->name) }}" required>
                            </div>
                            @error('name')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="email" class="form-label fw-semibold" style="color:rgba(18, 33, 61, 1);">Correo Electrónico</label>
                            <div class="input-group">
                                <span class="input-group-text bg-light border-end-0"><i class="fas fa-envelope text-muted"></i></span>
                                <input type="email" class="form-control border-start-0 @error('email') is-invalid @enderror" id="email" name="email" value="{{ old('email', $usuario->email) }}" required>
                            </div>
                            @error('email')
                                <div class="text-danger small mt-1">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-between align-items-center">
                            <a href="{{ route('usuarios.index') }}" class="btn px-4" style="background:rgba(246, 253, 254, 1); color:rgba(18, 33, 61, 1); border:1px solid rgba(18, 33, 61, 0.2);">
                                <i class="fas fa-arrow-left me-1"></i> Volver
                            </a>
                            <button type="submit" class="btn px-4" style="background:rgba(18, 33, 61, 1); color:rgba(246, 253, 254, 1); font-weight:600;">
                                <i class="fas fa-save me-1"></i> Guardar Cambios
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
