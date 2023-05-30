@extends('layouts.app')

@section('content')
    <div class="container pt-3">
        <div class="row py-3 justify-content-center">
            <div class="col">
                <h2>Utilitarios</h2>
            </div>
        </div>
        <div class="row">
            <div class="col-11 col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        Situación
                        <button class="btn btn-sm btn-success float-end" onclick="addSituacion()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="listadoSituacion" class="table display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Acc</th>
                                    <th>Nombre</th>
                                    <th>Elim</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-11 col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        Ajetreo (Categoría)
                        <button class="btn btn-sm btn-success float-end" onclick="addAjetreo()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="listadoAjetreos" class="table display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Acc</th>
                                    <th>Nombre</th>
                                    <th>Elim</th>
                                </tr>
                            </thead>
                            <tbody>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-11 col-md-6 mt-3">
                <div class="card">
                    <div class="card-header">
                        Asesores
                        <button class="btn btn-sm btn-success float-end" onclick="addAsesores()">
                            <i class="fas fa-plus"></i>
                        </button>
                    </div>

                    <div class="card-body table-responsive">
                        <table id="listadoAsesores" class="table display nowrap" style="width:100%">
                            <thead>
                                <tr>
                                    <th>Acc</th>
                                    <th>Nombre</th>
                                    <th>Elim</th>
                                </tr>
                            </thead>
                            <tbody>

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
                    <h5 class="modal-title"><span id="action">Agregar</span> <span id="titulo"></span></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmDatos" method="POST">
                        <div id="formBody"></div>
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
        $(document).ready(function(){
            listarSituacion();
            listadoAsesores();
            listadoAjetreos();
        })
    </script>
    <script>
        function addSituacion(){
            $("#action").html("Agregar");
            $("#titulo").html("Situación");
            $("#frmDatos").attr("action", "{{ url('api/situacion') }}");
            $("#frmDatos").attr("method", "POST");
            $("#datosModal div#formBody").html("");
            $("#frmDatos div#formBody").append("<div class='mb-3'><label for='nombre' class='form-label'>Nombre</label><input type='text' class='form-control' name='nombre' id='nombre'></div>");
            $("#datosModal").modal("show");
        }
        function addAjetreo(){
            $("#action").html("Agregar");
            $("#titulo").html("Ajetreo");
            $("#frmDatos").attr("action", "{{ url('api/ajetreo') }}");
            $("#frmDatos").attr("method", "POST");
            $("#datosModal div#formBody").html("");
            $("#frmDatos div#formBody").append("<div class='mb-3'><label for='nombre' class='form-label'>Nombre</label><input type='text' class='form-control' name='nombre' id='nombre'></div>");
            $("#datosModal").modal("show");
        }

        function addAsesores(){
            $("#action").html("Agregar");
            $("#titulo").html("Asesores");
            $("#frmDatos").attr("action", "{{ url('api/asesores') }}");
            $("#frmDatos").attr("method", "POST");
            $("#datosModal div#formBody").html("");
            $("#frmDatos div#formBody").append("<div class='mb-3'><label for='nombre' class='form-label'>Nombre</label><input type='text' class='form-control' name='nombre' id='nombre'></div>");
            $("#datosModal").modal("show");
        }

        function listarSituacion(){
            var table = $("#listadoSituacion tbody");
            var datos = $.ajax({
                url: "{{ url('/api/situacion') }}",
                method: "GET",
                dataType: "json",
                async: false,
                success: function(data){
                    table.html("");
                    data.forEach(element => {
                        table.append("<tr><td><button class='btn btn-sm btn-warning' onclick='editSituacion("+element.id+")'><i class='fas fa-edit'></i></button></td><td>"+element.nombre+"</td><td><button class='btn btn-sm btn-danger' onclick='deleteSituacion("+element.id+")'><i class='fas fa-trash'></i></button></td></tr>");
                    });
                }
            })
        }
        function listadoAsesores(){
            var table = $("#listadoAsesores tbody");
            var datos = $.ajax({
                url: "{{ url('/api/asesores') }}",
                method: "GET",
                dataType: "json",
                async: false,
                success: function(data){
                    table.html("");
                    data.forEach(element => {
                        table.append("<tr><td><button class='btn btn-sm btn-warning' onclick='editAsesor("+element.id+")'><i class='fas fa-edit'></i></button></td><td>"+element.nombre+"</td><td><button class='btn btn-sm btn-danger' onclick='deleteAsesor("+element.id+")'><i class='fas fa-trash'></i></button></td></tr>");
                    });
                }
            })
        }

        function listadoAjetreos(){
            var table = $("#listadoAjetreos tbody");
            var datos = $.ajax({
                url: "{{ url('/api/ajetreo') }}",
                method: "GET",
                dataType: "json",
                async: false,
                success: function(data){
                    table.html("");
                    data.forEach(element => {
                        table.append("<tr><td><button class='btn btn-sm btn-warning' onclick='editAjetreo("+element.id+")'><i class='fas fa-edit'></i></button></td><td>"+element.nombre+"</td><td><button class='btn btn-sm btn-danger' onclick='deleteAjetreo("+element.id+")'><i class='fas fa-trash'></i></button></td></tr>");
                    });
                }
            })
        }

        function editSituacion(id){
            $("#action").html("Editar");
            $("#titulo").html("Situación");
            $("#frmDatos").attr("action", "{{ url('api/situacion') }}/"+id);
            $("#frmDatos").attr("method", "PUT");
            var datos = $.ajax({
                url: "{{ url('/api/situacion') }}/"+id,
                method: "GET",
                dataType: "json",
                async: false,
                success: function(data){
                    $("#datosModal div#formBody").html("");
                    $("#frmDatos div#formBody").append("<input type='hidden' name='_method' value='PUT'>");
                    $("#frmDatos div#formBody").append("<input type='hidden' name='id' value='"+data.id+"'>");
                    $("#frmDatos div#formBody").append("<div class='mb-3'><label for='nombre' class='form-label'>Nombre</label><input type='text' class='form-control' name='nombre' id='nombre' value='"+data.nombre+"'></div>");
                    $("#datosModal").modal("show");
                }
            })
        }
        function editAjetreo(id){
            $("#action").html("Editar");
            $("#titulo").html("Ajetreo");
            $("#frmDatos").attr("action", "{{ url('api/ajetreo') }}/"+id);
            $("#frmDatos").attr("method", "PUT");
            var datos = $.ajax({
                url: "{{ url('/api/ajetreo') }}/"+id,
                method: "GET",
                dataType: "json",
                async: false,
                success: function(data){
                    $("#datosModal div#formBody").html("");
                    $("#frmDatos div#formBody").append("<input type='hidden' name='_method' value='PUT'>");
                    $("#frmDatos div#formBody").append("<input type='hidden' name='id' value='"+data.id+"'>");
                    $("#frmDatos div#formBody").append("<div class='mb-3'><label for='nombre' class='form-label'>Nombre</label><input type='text' class='form-control' name='nombre' id='nombre' value='"+data.nombre+"'></div>");
                    $("#datosModal").modal("show");
                }
            })
        }
        function editAsesor(id){
            $("#action").html("Editar");
            $("#titulo").html("Asesor");
            $("#frmDatos").attr("action", "{{ url('api/asesores') }}/"+id);
            $("#frmDatos").attr("method", "PUT");
            var datos = $.ajax({
                url: "{{ url('/api/asesores') }}/"+id,
                method: "GET",
                dataType: "json",
                async: false,
                success: function(data){
                    $("#datosModal div#formBody").html("");
                    $("#frmDatos div#formBody").append("<input type='hidden' name='_method' value='PUT'>");
                    $("#frmDatos div#formBody").append("<input type='hidden' name='id' value='"+data.id+"'>");
                    $("#frmDatos div#formBody").append("<div class='mb-3'><label for='nombre' class='form-label'>Nombre</label><input type='text' class='form-control' name='nombre' id='nombre' value='"+data.nombre+"'></div>");
                    $("#datosModal").modal("show");
                }
            })
        }

        function deleteSituacion(id){
            if(confirm("¿Está seguro de eliminar el registro?")){
                var datos = $.ajax({
                    url: "{{ url('/api/situacion') }}/"+id,
                    method: "DELETE",
                    dataType: "json",
                    async: false,
                    success: function(data){
                        listarSituacion();
                    }
                })
            }
        }

        function deleteAjetreo(id){
            if(confirm("¿Está seguro de eliminar el registro?")){
                var datos = $.ajax({
                    url: "{{ url('/api/ajetreo') }}/"+id,
                    method: "DELETE",
                    dataType: "json",
                    async: false,
                    success: function(data){
                        listadoAjetreos();
                    }
                })
            }
        }

        function deleteAsesor(id){
            if(confirm("¿Está seguro de eliminar el registro?")){
                var datos = $.ajax({
                    url: "{{ url('/api/asesores') }}/"+id,
                    method: "DELETE",
                    dataType: "json",
                    async: false,
                    success: function(data){
                        listadoAsesores();
                    }
                })
            }
        }

        $("form#frmDatos").on('submit', function(e){
            e.preventDefault();
            var url = $(this).attr("action");
            var action = $("#titulo").html().toLowerCase();
            var datos = $(this).serialize();
            var method = $(this).attr("method");
            $.ajax({
                url: url,
                method: method,
                data: datos,
                dataType: "json",
                success: function(data){
                    $("#datosModal").modal("hide");
                    if(action=="situación"){
                        listarSituacion();
                    }else if(action=="asesores"){
                        listadoAsesores();
                    }else if(action=="ajetreo"){
                        listadoAjetreos();
                    }
                }
            });

        });


    </script>
@endsection
