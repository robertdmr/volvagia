@extends('layouts.app')

@section('content')
    <div class="container pt-3">
        <div class="row py-3 justify-content-center">
            <div class="col">
                <h2>Proyectos</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div class="card">
                    <div class="card-header">
                        Listado
                        <button class="btn btn-sm btn-success float-end" onclick="openModalDatos()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="listado" class="display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Acc</th>
                                    <th>Nombre</th>
                                    <th>Elim</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($projects as $project)
                                    <tr>
                                        <td>
                                            <button class="btn btn-sm btn-secondary"
                                                onclick="openDatos({{ $project }})"><i
                                                    class="fas fa-pencil"></i></button>
                                        </td>
                                        <td>{{ $project->nombre }}</td>
                                        <td><button class="btn text-danger fw-bold"
                                                onclick="fnEliminar({{ $project->id }})">X</button></td>
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
    <div class="modal fade" id="datosModal" data-bs-backdrop="static" data-bs-keyboard="false">
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
                language: {
                    'url': '//cdn.datatables.net/plug-ins/1.13.4/i18n/es-ES.json',
                },
                scrollX: true,
                select: true
            });
        });

        function openDatos(project) {
            $('form#frmPoyecto')[0].reset();
            $('#datosModal').modal('show');
            $("#action").text("Editar");
            $('#nombre').val(project.nombre);
            $('#descripcion').val(project.descripcion);
        }

        $('form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();
            var url = "{{ url('/api/projects') }}";
            var xmethod = "POST";
            if ($("#action").text() == "Editar") {
                xmethod = "PUT";
                url += "/" + $('#id').val();
            }
            console.log(xmethod)
            $.ajax({
                url: url,
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                type: xmethod,
                data: data,
                success: function(response) {
                    if (response.message == "ok") {
                        $('#datosModal').modal('hide');
                        location.reload();
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

        function openModalDatos() {
            $('form#frmPoyecto')[0].reset();
            $("form").attr("action", "{{ url('api/projects') }}");
            $('#datosModal').modal('show');
            $('#action').text("Agregar");
        }

        function fnEliminar(id) {
            if (confirm("Desea eliminar este registro?") == true) {
                $.ajax({
                    url: "{{ url('/api/projects') }}" + "/" + id,
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


    </script>
@endsection
