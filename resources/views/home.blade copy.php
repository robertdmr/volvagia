@extends('layouts.app')

@section('styles')
    <style>
        #backdrop {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 9999;
            display: none;
        }

        #spinner {
            position: fixed;
            top: 50%;
            left: 50%;
            transform: translate(-50%, -50%);
            z-index: 10000;
            display: none;
        }

        #listado_filter {
            margin-bottom: 15px !important;
        }

        /* RESIZE */
        .table th {
    position: relative;
}
.resizer {
    /* Displayed at the right side of column */
    position: absolute;
    top: 0;
    right: 0;
    width: 5px;
    cursor: col-resize;
    user-select: none;
}
.resizer:hover,
.resizing {
    border-right: 2px solid blue;
}
    </style>
@endsection

@section('content')
    <div id="backdrop"></div>
    <div id="spinner">
        <div class="spinner-grow text-dark" role="status">
            <span class="visually-hidden">Loading...</span>
        </div>
    </div>

    <div class="container-fluid pt-3">
        <div class="row">
            <div class="col">
                <h2>Inicio</h2>
                <hr>
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
                        <table id="listado" class="display table" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Acc</th>
                                    <th>C</th>
                                    <th>AJETREO</th>
                                    <th>AS</th>
                                    <th>FECHA</th>
                                    <th>REFERENTE</th>
                                    <th>PROYECTO</th>
                                    <th>NOMBRE</th>
                                    <th>TELEFONO</th>
                                    <th>X</th>
                                    <th>COMENTARIO</th>
                                    <th>E</th>
                                    <th>F</th>
                                    @if ($user = Auth::user()->role == 'admin')
                                        <th>Elim</th>
                                    @endif
                                    <th class="d-none"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($leads as $lead)
                                    <tr>
                                        <td>
                                            <button class="btn btn-sm btn-danger"
                                                onclick="openDatos('{{ $lead->id }}')"><i
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
                                            <span class="fw-bold">{{ $lead->project->nombre ?? '' }}</span>
                                        </td>
                                        <td contenteditable='true'>
                                            {{ $lead->nombre }}
                                        </td>
                                        <td>
                                            <a href="#" class="link">{{ $lead->telefono }}</a>
                                        </td>
                                        <td contenteditable='true'>
                                            {{ $lead->X }}
                                        </td>
                                        <td contenteditable='true'>
                                            {{ $lead->comentario }}
                                        </td>
                                        <td>{{ $lead->e }}</td>
                                        <td>{{ $lead->f }}</td>
                                        @if ($user = Auth::user()->role == 'admin')
                                            <td><i class="fas fa-close text-danger" role="button"
                                                    onclick="fnEliminar({{ $lead->id }})"></i></td>
                                        @endif
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
                        @csrf
                        <div class="row my-2">
                            <div class="col-4">
                                <label for="c">C (Situación)</label>
                                <select name="c" id="c" class="form-select">
                                    <option value="">Seleccionar</option>
                                    @foreach ($situaciones as $situacion)
                                        <option value="{{ $situacion->nombre }}">{{ $situacion->nombre }}</option>
                                    @endforeach
                                </select>
                                <input type="hidden" name="id" id="id">
                            </div>
                            <div class="col-4">
                                <label for="as">As (Asesor)</label>
                                <select name="as" id="as" class="form-select">
                                    <option value="">Seleccionar</option>
                                    @foreach ($asesores as $asesor)
                                        <option value="{{ $asesor->nombre }}">{{ $asesor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-4">
                                <label for="fecha">Fecha</label>
                                <input type="date" class="form-control" name="fecha" id="fecha"
                                    value="{{ date('Y-m-d') }}">
                            </div>
                        </div>

                        <div class="row my-2">
                            <div class="col-6">
                                <label for="ajetreo">Ajetreo (Categoría)</label>
                                <select name="ajetreo" id="ajetreo" class="form-select">
                                    <option value="">Seleccionar</option>
                                    @foreach ($ajetreos as $ajetreo)
                                        <option value="{{ $ajetreo->nombre }}">{{ $ajetreo->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-6">
                                <label for="project_id">Proyecto
                                    <i class="fa-solid fa-circle-plus text-warning" role="button"
                                        onclick="openModalProyectos();return false;"></i>
                                </label>
                                <select name="project_id" id="project_id" class="form-select">
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
                                <input type="text" name="telefono" class="form-control" id="telefono">
                            </div>
                            <div class="col-6">
                                @if (Auth::user()->role == 'admin')
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
                                <textarea name="comentario" id="comentario" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-6">
                                <label for="x">X (Importancia)</label>
                                <input type="text" class="form-control" id="X" name="X">
                            </div>
                            <div class="col-6">
                                <label for="e">E (Pendiente/Ok)</label>
                                <input type="text" class="form-control" id="e" name="e">
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

    <div class="modal fade" id="datosProyectos" data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><span id="action">Agregar</span> Proyecto</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" data-bs-target="#datosProyectos"
                        aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ url('/project') }}" id="frmPoyecto" method="POST">
                        @CSRF
                        <div class="row">
                            <div class="col">
                                <label for="nombre">Nombre</label>
                                <input type="text" name="nombre" id="nombre" class="form-control">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col">
                                <label for="descripcion">Descripcion</label>
                                <textarea name="descripcion" id="descripcion" cols="30" rows="3" class="form-control"></textarea>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col text-end">
                                <button class="btn btn-primary">Guardar</button>
                            </div>
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
                dom: 'Bfrtip',
                buttons: [
                    'copy', 'excel', 'pdf'
                ],

                language: {
                    'url': '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                scrollX: true,
                select: true,
            });
  |
        });

        function openDatos(id) {
            $('form#frmDatos')[0].reset();
            $('#action').text("Editar");
            $('#datosModal').modal('show');
            $("form").attr("action", "{{ url('leads.update') }}");
            cargarLead(id)
        }

        var celdas = document.querySelectorAll('td[contenteditable]');

        celdas.forEach(function(celda) {
            var fila = celda.closest('tr');
            var primeraColumna = fila.querySelector('td:last-child').textContent;
            var indiceCelda = Array.from(fila.children).indexOf(celda);
            var Columna = "";
            if (indiceCelda == 7) {
                Columna = "nombre";
            } else if (indiceCelda == 9) {
                Columna = "X";
            } else if (indiceCelda) {
                Columna = "comentario";
            }

            celda.addEventListener('keydown', function(event) {
                var valorEditable = celda.textContent;
                if (event.keyCode === 13) {
                    console.log(primeraColumna, valorEditable, indiceCelda);
                    actualizarValor(primeraColumna, valorEditable, Columna);

                    $("input[type=search]").focus();
                    event.preventDefault();

                };
            })
        })

        function openModalDatos() {
            $('form#frmDatos')[0].reset();
            $("form").attr("action", "{{ url('/leads') }}");
            $('#datosModal').modal('show');
            $('#action').text("Agregar");
        }

        function openModalProyectos() {
            $('#datosProyectos').modal('show');
        }

        $('form#frmDatos').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();
            var url = "{{ url('/api/leads') }}";
            var xmethod = "POST";
            if ($("#action").text() == "Editar") {
                xmethod = "PUT";
                url += "/" + $('#id').val();
            }
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: xmethod,
                data: data,
                beforeSend: function() {
                    mostrarLoader();
                },
                success: function(response) {
                    if (response.message == "ok") {
                        location.reload();
                    }
                    console.log(response)
                    ocultarLoader();
                },
                error: function(error) {
                    const errors = error.responseJSON.errors;
                    var msg = "";
                    if (errors) {
                        $.each(errors, function(key, value) {
                            msg += value + "\n";
                        });
                        alert(msg)
                    }
                    ocultarLoader();
                }
            });
        });

        $('form#frmPoyecto').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();
            var url = "{{ url('/api/projects') }}";
            var xmethod = "POST";
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: xmethod,
                data: data,
                success: function(response) {
                    if (response.message == "ok") {
                        listarProyectos();
                        $('#datosProyectos').modal('hide');
                    }
                    console.log(response)
                },
                error: function(error) {
                    const errors = error.responseJSON.errors;
                    var msg = "";
                    if (errors) {
                        $.each(errors, function(key, value) {
                            msg += value + "\n";
                        });
                        alert(msg)
                    }
                }
            });
        });

        function listarProyectos() {
            var proyectos = $("#project_id")
            $.ajax({
                url: "{{ url('/api/projects') }}",
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                method: "GET",
                success: function(data) {
                    if (data.message == "ok") {
                        proyectos.empty();
                        proyectos.append('<option value="">Seleccione</option>');
                        $.each(data.projects, function(index, opcion) {
                            var nuevoOption = $('<option value="' + opcion.id + '">' + opcion.nombre +
                                '</option>');
                            proyectos.append(nuevoOption);
                        });
                    }
                    console.log(data)
                },
                error: function(error) {
                    const errors = error.responseJSON.errors;
                    var msg = "";
                    if (errors) {
                        $.each(errors, function(key, value) {
                            msg += value + "\n";
                        });
                        alert(msg)
                    }
                }
            });
        }

        function cargarLead(id) {
            $.ajax({
                url: "{{ url('/api/leads') }}/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                dataType: "json",
                method: "GET",
                success: function(data) {
                    if (data.message == "ok") {
                        $("form#frmDatos select#project_id").val(data.lead.project_id);
                        $("form#frmDatos #id").val(data.lead.id);
                        $("form#frmDatos #nombre").val(data.lead.nombre);
                        $("#ajetreo").val(data.lead.ajetreo);
                        $("#as").val(data.lead.as);
                        $("#fecha").val(data.lead.fecha);
                        $("#referente").val(data.lead.referente);
                        $("#telefono").val(data.lead.telefono);
                        $("form#frmDatos #X").val(data.lead.X);
                        $("#comentario").val(data.lead.comentario);
                        $("#e").val(data.lead.e);
                        $("#c").val(data.lead.c);
                        $("#f").val(data.lead.f);
                        $("#mes").val(data.lead.mes);
                        $("#blanco").val(data.lead.blanco);
                        $("#user_id").val(data.lead.user_id);
                    }
                    console.log(data)
                },
                error: function(error) {
                    const errors = error.responseJSON.errors;
                    var msg = "";
                    if (errors) {
                        $.each(errors, function(key, value) {
                            msg += value + "\n";
                        });
                        alert(msg)
                    }
                }
            });
        }


        function fnEliminar(id) {
            if (confirm("Desea eliminar este registro?") == true) {
                $.ajax({
                    url: "{{ url('/api/leads') }}" + "/" + id,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    method: "DELETE",
                    success: function(response) {
                        if (response.message = "ok") {
                            location.reload();
                        }
                    },
                    error: function(error) {
                        const errors = error.responseJSON.errors;
                        var msg = "";
                        if (errors) {
                            $.each(errors, function(key, value) {
                                msg += value + "\n";
                            });
                            alert(msg)
                        }
                    }
                });
            }
        }

        function actualizarValor(id, valor, columna) {
            datos = {
                id: id,
                valor: valor,
                columna: columna
            }
            $.ajax({
                url: "{{ url('/api/lead') }}" + "/" + id,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                method: "POST",
                data: datos,
                beforeSend: function() {
                    mostrarLoader();
                },
                success: function(response) {
                    if (response.message = "ok") {
                        console.log(response)
                        ocultarLoader();
                    }
                },
                error: function(error) {
                    ocultarLoader();
                    const errors = error.responseJSON.errors;
                    var msg = "";
                    if (errors) {
                        $.each(errors, function(key, value) {
                            msg += value + "\n";
                        });
                        alert(msg)
                    }
                }
            });
        }

        // Mostrar el backdrop y el spinner
        function mostrarLoader() {
            $("#backdrop").show();
            $("#spinner").show();
        }

        // Ocultar el backdrop y el spinner
        function ocultarLoader() {
            $("#backdrop").hide();
            $("#spinner").hide();
        }
    </script>
@endsection
