@extends('layouts.app')

@section('styles')
    <style>
        .dropdown-menu {
            z-index: 1000 !important;
        }
    </style>
@endsection

@section('content')
    <div class="container-fluid pt-3">
        <div class="row py-3 justify-content-center">
            <div class="col-11 col-md-4">
                <div class="card bg-secondary shadow my-1">
                    <div class="card-body text-white">
                        <h5>PENDIENTES</h5>
                        <span class="h3">30</span>
                    </div>
                </div>
            </div>
            <div class="col-11 col-md-4">
                <div class="card bg-secondary shadow my-1">
                    <div class="card-body text-white">
                        <h5>PROYECTOS</h5>
                        <span class="h3">45</span>
                    </div>
                </div>
            </div>
            <div class="col-11 col-md-4">
                <div class="card bg-secondary shadow my-1">
                    <div class="card-body text-white">
                        <h5>PARA HOY</h5>
                        <span class="h3">12</span>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        {{ __('Dashboard') }}
                        <button class="btn btn-sm btn-success float-end" onclick="openModalDatos()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="listado" class="display nowrap editable" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Acc</th>
                                    <th>C</th>
                                    <th>AJETREO</th>
                                    <th>AS</th>
                                    <th>FECHA</th>
                                    <th>REFERENTE</th>
                                    <th>PROYECTOS</th>
                                    <th>NOMBRE</th>
                                    <th>TELEFONO</th>
                                    <th>X</th>
                                    <th>COMENTARIO</th>
                                    <th>E</th>
                                    <th>F</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leads as $lead)
                                    <tr>
                                        <td>
                                            <button class="btn btn-sm btn-danger" onclick="openDatos('{{ $lead->id }}')"><i
                                                    class="fas fa-pencil"></i></button>
                                        </td>
                                        <td><span class="badge bg-warning">{{ $lead->c }}</span></td>
                                        <td>
                                            {{ $lead->ajetreo }}
                                        </td>
                                        <td>
                                            <span class="badge bg-success">{{ $lead->as }}</span>
                                        </td>
                                        <td>
                                            {{ $lead->fecha }}
                                        </td>
                                        <td>
                                            {{ $lead->referente }}
                                        </td>
                                        <td>
                                            <span class="fw-bold">{{ $lead->proyectos->nombre }}</span>
                                        </td>
                                        <td contenteditable='true'>
                                            {{ $lead->nombre }}
                                        </td>
                                        <td>
                                            <a href="#" class="link">{{ $lead->telefono }}</a>
                                        </td>
                                        <td>
                                            {{ $lead->X }}
                                        </td>
                                        <td contenteditable='true'>
                                            {{ $lead->comentario }}
                                        </td>
                                        <td>{{ $lead->e }}</td>
                                        <td>{{ $lead->f }}</td>
                                        <td class="d-none">{{ $lead->id }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>


    {{-- modal --}}
    <div class="modal fade" tabindex="-1" id="datosModal">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="action">Agregar</span>Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmDatos" method="POST">
                        <div class="my-2">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <input type="hidden" name="id" id="id">
                        </div>

                        <div class="my-2 text-end">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button type="submit" class="btn btn-primary">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            var tabla = $('#listado').DataTable({
                language: {
                    'url': '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                scrollX: true,
                select: true,
            });

        });

        function openDatos(id) {
            $('#datosModal').modal('show');
        }

        var celdas = document.querySelectorAll('td[contenteditable]');

        celdas.forEach(function(celda) {
            var fila = celda.closest('tr');
            var primeraColumna = fila.querySelector('td:last-child').textContent;

            celda.addEventListener('keydown', function(event) {
                var valorEditable = celda.textContent;
                if(event.keyCode===13){
                    console.log(primeraColumna, valorEditable);
                    $("input[type=search]").focus();
                    event.preventDefault();
                };
            })
        })
    </script>
@endsection
