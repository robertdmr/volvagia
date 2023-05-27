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
                        <span class="h3">0</span>
                    </div>
                </div>
            </div>
            <div class="col-11 col-md-4">
                <div class="card bg-secondary shadow my-1">
                    <div class="card-body text-white">
                        <h5>PROYECTOS</h5>
                        <span class="h3">0</span>
                    </div>
                </div>
            </div>
            <div class="col-11 col-md-4">
                <div class="card bg-secondary shadow my-1">
                    <div class="card-body text-white">
                        <h5>PARA HOY</h5>
                        <span class="h3">0</span>
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
                    <h5 class="modal-title"><span id="action">Agregar</span> Lead</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmDatos" method="POST">
                        <div class="row my-2">
                            <div class="col-4">
                                <label for="c">C</label>
                                <input type="text" class="form-control" name="c">
                            </div>
                            <div class="col-4">
                                <label for="as">As</label>
                                <input type="text" class="form-control" name="as">
                            </div>
                            <div class="col-4">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" name="fecha">
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-6">
                                <label for="ajetreo">Ajetreo</label>
                                <input type="text" class="form-control" id="ajetreo" name="ajetreo">
                            </div>
                            <div class="col-6">
                                <label for="project_id">Proyecto</label>
                                <select name="project_id" id="project_id" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach ($projects as $project)
                                        <option value="{{ $project->id }}">{{ $project->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="nombre">Nombre</label>
                                <input type="text" class="form-control" id="nombre" name="nombre">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="telefono">Telefono</label>
                                <input type="text" name="telefono" class="form-control">
                            </div>
                            <div class="col-6">
                                @if(Auth::user()->role == 'admin')
                                <label for="usuario">Usuario</label>
                                <select name="user_id" id="user_id" class="form-control">
                                    <option value="">Seleccione</option>
                                    @foreach ($users as $user)
                                        <option value="{{ $user->id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                @endif
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="referente">Referente</label>
                                <input type="text" name="referente" id="referente" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="comentario">Comentario</label>
                                <textarea name="comentario" id="comentario" cols="30" rows="3"
                                    class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="x">X</label>
                                <input type="text" class="form-control" id="x" name="x">
                            </div>
                            <div class="col-3">
                                <label for="e">E</label>
                                <input type="text" class="form-control" id="E" name="E">
                            </div>
                            <div class="col-3">
                                <label for="blanco">Blanco</label>
                                <input type="text" class="form-control" id="blanco" name="blanco">
                            </div>
                            <div class="col-3">
                                <label for="mes">Mes</label>
                                <input type="text" class="form-control" id="mes" name="mes">
                            </div>
                        </div>
                        <hr>
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
        function openModalDatos() {
            $('form#frmDatos')[0].reset();
            $("form").attr("action", "{{ url('leads.update') }}");
            $('#datosModal').modal('show');
            $('#action').text("Agregar");
        }
    </script>
@endsection
