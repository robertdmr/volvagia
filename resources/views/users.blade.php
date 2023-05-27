@extends('layouts.app')

@section('content')
    <div class="container pt-3">
        <div class="row py-3 justify-content-center">
            <div class="col">
                <h2>Usuarios</h2>
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
                                    <th>Cod</th>
                                    <th>Nombre</th>
                                    <th>Perfil</th>
                                    <th>Elim</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>
                                            <button class="btn btn-sm btn-secondary"
                                                onclick="openDatos({{ $user }})"><i
                                                    class="fas fa-pencil"></i></button>
                                        </td>
                                        <td>{{ $user->id }}</td>
                                        <td>{{ $user->name }}</td>
                                        <td><span
                                                class="badge {{ $user->role == 'user' ? 'bg-success' : 'bg-primary' }}">{{ $user->role }}</span>
                                        </td>
                                        <td><button class="btn text-danger fw-bold"
                                                onclick="fnEliminar({{ $user->id }})">X</button></td>
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
                    <h5 class="modal-title"><span id="action">Agregar</span> Usuario</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="frmDatos" method="POST">
                        <div class="my-2">
                            <label for="name" class="form-label">Nombre</label>
                            <input type="text" name="name" id="name" class="form-control">
                            <input type="hidden" name="id" id="id">
                        </div>
                        <div class="my-2">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" name="email" id="email" class="form-control">
                        </div>
                        <div class="my-2">
                            <label for="role" class="form-label">Perfil</label>
                            <select name="role" id="role" class="form-select">
                                <option value="admin">Administrador</option>
                                <option value="user" selected>Usuario</option>
                            </select>
                        </div>
                        <h2>Seguridad</h2>
                        <div class="my-2">
                            <label for="password" class="form-label">Contraseña</label>
                            <input type="password" name="password" id="password" class="form-control">
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
                select: true
            });
        });

        function openDatos(user) {
            $('form#frmDatos')[0].reset();
            $('#datosModal').modal('show');
            $("#action").text("Editar");
            $('#id').val(user.id);
            $('#name').val(user.name);
            $('#email').val(user.email);
            $('#role').val(user.role);
        }

        $('form').on('submit', function(e) {
            e.preventDefault();
            var form = $(this);
            var data = form.serialize();
            var url = "{{ url('/api/users') }}";
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
                    if (response = "ok") {
                        $('#datosModal').modal('hide');
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
        });

        function openModalDatos() {
            $('form#frmDatos')[0].reset();
            $("form").attr("action", "{{ url('users.update') }}");
            $('#datosModal').modal('show');
            $('#action').text("Agregar");
        }

        function fnEliminar(id) {
            if (confirm("Desea eliminar este registro?") == true) {
                $.ajax({
                    url: "{{ url('/api/users') }}" + "/" + id,
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
