@extends('layouts.app')

@section('content')
    @if (isset($historialPedidos) && count($historialPedidos) > 0)
        <div class="mt-5">
            <div class="d-flex justify-content-between align-items-center mb-3">
                <h4 class="fw-bold" style="color:rgba(18, 33, 61, 1); margin-bottom:0;">
                    Historial de Pedidos.
                </h4>
                <span class="badge"
                    style="background:rgba(217, 140, 82, 1); color:rgba(246, 253, 254, 1); font-size:1rem; min-width:90px; text-align:right;">
                    Total pedidos: {{ count($historialPedidos) }}
                </span>
            </div>
            <div class="table-responsive">
                <table id="historial-pedidos-table" class="table table-bordered"
                    style="background: #fff; border-radius: 16px; box-shadow: 0 4px 16px rgba(18, 33, 61, 0.10); overflow: hidden; font-size: 1rem;">
                    <thead>
                        <tr>
                            <th
                                style="background: rgba(18, 33, 61, 1); color: rgba(246, 253, 254, 1); text-align: center; font-weight: 700; border-bottom: 2px solid rgba(217, 140, 82, 1); vertical-align: middle;">
                                #</th>
                            <th
                                style="background: rgba(18, 33, 61, 1); color: rgba(246, 253, 254, 1); text-align: center; font-weight: 700; border-bottom: 2px solid rgba(217, 140, 82, 1); vertical-align: middle;">
                                Nombre</th>
                            <th
                                style="background: rgba(18, 33, 61, 1); color: rgba(246, 253, 254, 1); text-align: center; font-weight: 700; border-bottom: 2px solid rgba(217, 140, 82, 1); vertical-align: middle;">
                                Teléfono</th>
                            <th
                                style="background: rgba(18, 33, 61, 1); color: rgba(246, 253, 254, 1); text-align: center; font-weight: 700; border-bottom: 2px solid rgba(217, 140, 82, 1); vertical-align: middle;">
                                Método de pago</th>
                            <th
                                style="background: rgba(18, 33, 61, 1); color: rgba(246, 253, 254, 1); text-align: center; font-weight: 700; border-bottom: 2px solid rgba(217, 140, 82, 1); vertical-align: middle;">
                                Comentarios</th>
                            <th
                                style="background: rgba(18, 33, 61, 1); color: rgba(246, 253, 254, 1); text-align: center; font-weight: 700; border-bottom: 2px solid rgba(217, 140, 82, 1); vertical-align: middle;">
                                Productos</th>
                            <th
                                style="background: rgba(18, 33, 61, 1); color: rgba(246, 253, 254, 1); text-align: center; font-weight: 700; border-bottom: 2px solid rgba(217, 140, 82, 1); vertical-align: middle;">
                                Total</th>
                            <th
                                style="background: rgba(18, 33, 61, 1); color: rgba(246, 253, 254, 1); text-align: center; font-weight: 700; border-bottom: 2px solid rgba(217, 140, 82, 1); vertical-align: middle;">
                                Fecha</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php
                            $contadorPorDia = [];
                        @endphp
                        @foreach ($historialPedidos as $pedido)
                            @php
                                $total = 0;
                                $productos = json_decode($pedido->productos, true);
                                foreach ($productos as $producto) {
                                    $total += $producto['precio'] * $producto['cantidad'];
                                }
                                $fechaClave = $pedido->created_at->format('Ymd');
                                if (!isset($contadorPorDia[$fechaClave])) {
                                    $contadorPorDia[$fechaClave] = 1;
                                } else {
                                    $contadorPorDia[$fechaClave]++;
                                }
                                $numeroPedido =
                                    $pedido->created_at->format('ymd') .
                                    '-' .
                                    str_pad($contadorPorDia[$fechaClave], 3, '0', STR_PAD_LEFT);
                            @endphp
                            <tr style="vertical-align: middle; text-align: center; color: #222; background: #f9f9f9;">
                                <td class="fw-bold" style="color:rgba(18, 33, 61, 1);">{{ $numeroPedido }}</td>
                                <td>{{ $pedido->nombre }}</td>
                                <td>{{ $pedido->telefono }}</td>
                                <td>
                                    <span class="badge"
                                        style="background:rgba(18, 33, 61, 1); color:rgba(246, 253, 254, 1);">{{ $pedido->metodo_pago }}</span>
                                </td>
                                <td>{{ $pedido->comentarios }}</td>
                                <td>
                                    <ul class="mb-0 ps-3" style="font-size: 0.97rem;">
                                        @foreach ($productos as $producto)
                                            <li>
                                                <span class="fw-semibold"
                                                    style="color:rgba(18, 33, 61, 1);">{{ $producto['nombre'] }}</span>
                                                x{{ $producto['cantidad'] }}
                                                <span class="text-muted">(${{ number_format($producto['precio'], 2) }}
                                                    c/u)</span>
                                            </li>
                                        @endforeach
                                    </ul>
                                </td>
                                <td class="fw-bold text-success" style="font-size:1.15rem;">
                                    ${{ number_format($total, 2) }}
                                </td>
                                <td>{{ $pedido->created_at->format('d/m/Y H:i') }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endif
    <script>
        $(document).ready(function() {
            $('#historial-pedidos-table').DataTable({
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
        });
    </script>
    <style>
        #historial-pedidos-table th {
            background: rgba(18, 33, 61, 1);
            /* Cambiado a azul oscuro */
            color: rgba(246, 253, 254, 1);
            /* Texto blanco hueso */
            text-align: center;
            font-weight: 700;
            border-bottom: 2px solid rgba(217, 140, 82, 1);
            vertical-align: middle;
        }

        #historial-pedidos-table td {
            vertical-align: middle;
            text-align: center;
            color: rgba(18, 33, 61, 1);
            /* Texto azul oscuro */
            background: #ffffff;
            /* Fondo blanco */
        }

        #historial-pedidos-table tbody tr:hover {
            background: #fff3cd;
            /* Amarillo más claro al pasar el mouse */
            transition: background 0.2s;
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
    </style>
@endsection
