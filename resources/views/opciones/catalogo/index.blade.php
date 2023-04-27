@extends('layouts.app')

@section('title', 'Catalogos')

@section('content')
<div class="container-fluid">
    <div class="modal" tabindex="-1" role="dialog" id="editcatalogoModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar Catalogo</h5>

                    <button type="button" class="close" data-dismiss="modal" aria-label="Cerrar">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <form action="" method="POST">
                    @csrf
                    @method('PUT')

                    <div class="modal-body">
                        <div class="form-group">
                            <input type="text" name="nombre" class="form-control" value=""
                                placeholder="Nombre del catalogo" required>
                        </div>
                    </div>

                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary"
                            data-dismiss="modal">Cerrar</button>
                        <button type="submit" class="btn btn-primary">Actualizar</button>
                    </div>
            </div>
            </form>
        </div>
    </div>
    <!-- Page Heading -->
    <div class="d-sm-flex align-catalogos-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Catalogos</h1>       
    </div>

    {{-- Alert Messages --}}
    @include('common.alert')

    <!-- DataTales Example -->
    <div class="card shadow mb-4">

        <div class="card-body">
            <div id="treeview">
           


                    <div class="row">
                        <div class="col-md-8"> <!-- aca inicia el frame izquierdo Mostrar -->

                        <h6 class="m-0 font-weight-bold text-primary">Catalogos</h6> <!-- aca inicia tabla hover over -->

                            <table class="table table-hover"> <!--los headers-->
                                <thead>
                                    <tr>
                                    <th scope="col">ID</th>
                                    <th scope="col">ID_Padre</th>
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripcion</th>
                                    <!--<th scope="col">Fecha fin</th>-->
                                    </tr>
                                </thead>
                                
                                <tbody>
                                @foreach ($Catalogos as $catalogo) <!-- aca imprime la data -->
                                    <tr>
                                        <td>{{$catalogo['id']}}</td>
                                        <td>{{$catalogo['id_padre']}}</td>
                                        <td>{{$catalogo['nombre']}}</td>
                                        <td>{{$catalogo['descripcion']}}</td>
                                @endforeach
                                </tbody>
                            </table> <!-- aca termina HO -->

                            <!-- <div class="card">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Catalogo</h6>
                                </div>
                                <div class="card-body">
                                    <ul class="list-group">
                                        @foreach ($Catalogos as $catalogo)
                                        <li class="list-group-item">
                                            <div class="d-flex justify-content-between">
                                                {{ $catalogo->nombre }}

                                                <div class="button-group d-flex">
                                                    <button type="button"
                                                        class="btn btn-sm btn-primary mr-1 edit-catalogo"
                                                        data-toggle="modal" data-target="#editcatalogoModal"
                                                        data-id="{{ $catalogo->id }}"
                                                        data-name="{{ $catalogo->nombre }}">Edit</button>

                                                    <form action="{{ route('catalogo.destroy', $catalogo->id) }}"
                                                        method="POST">
                                                        @csrf
                                                        @method('DELETE')

                                                        <button type="submit"
                                                            class="btn btn-sm btn-danger">Borrar</button>
                                                    </form>
                                                </div>
                                            </div>

                                            @if ($catalogo->children)
                                            <ul class="list-group mt-2">
                                                @foreach ($catalogo->children as $child)
                                                <li class="list-group-item">
                                                    <div class="d-flex justify-content-between">
                                                        {{ $child->nombre }}

                                                        <div class="button-group d-flex">
                                                            <button type="button"
                                                                class="btn btn-sm btn-primary mr-1 edit-catalogo"
                                                                data-toggle="modal" data-target="#editcatalogoModal"
                                                                data-id="{{ $child->id }}"
                                                                data-name="{{ $child->nombre }}">Edit</button>

                                                            <form action="{{ route('catalogo.destroy', $child->id) }}"
                                                                method="POST">
                                                                @csrf
                                                                @method('DELETE')

                                                                <button type="submit"
                                                                    class="btn btn-sm btn-danger">Borrar</button>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </li>
                                                @endforeach
                                            </ul>
                                            @endif
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div> --> <!-- aca termina tabla izq (eliminada) -->
                        </div>

                        <div class="col-md-4"> <!-- aca el frame derecho Crear -->
                            <div class="card">
                                <div class="card-header">
                                    <h6 class="m-0 font-weight-bold text-primary">Crear Catalogo</h6>
                                </div>

                                <div class="card-body">
                                    <form action="{{ route('catalogo.store') }}" method="POST">
                                        @csrf

                                        <div class="form-group">
                                            <select class="form-control" name="id_padre">
                                                <option value="">Seleccionar tipo de catalogo</option>

                                                @foreach ($Catalogos as $catalogo)
                                                <option value="{{ $catalogo->id }}">{{ $catalogo->nombre }}</option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="form-group">
                                            <input type="text" name="nombre" class="form-control"
                                                value="{{ old('nombre') }}" placeholder="Nombre Catalogo" required>
                                        </div>

                                        <div class="form-group">
                                            <button type="submit" class="btn btn-primary">Crear</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>


                    </div>
                
            </div>

        </div>


        @endsection
        @section('scripts')



        <script>
            // Agregamos un evento "click" a los botones de editar
     $('.btn-edit').click(function() {
        
        // Obtenemos el ID del elemento a editar
        var catalogoId = $(this).data('id');

        // Mostramos el formulario de edición correspondiente
        $('.form-edit[data-id=' + catalogoId + ']').show();
    });
    $(document).ready(function () {
        $('#treeview').on('click', 'li:has(ul)', function (e) {
            var id_padre = $(this).data('id');
            if ($(this).hasClass('expanded')) {
                $(this).removeClass('expanded');
                $(this).children('ul').remove();
            } else {
                $(this).addClass('expanded');
                $.ajax({
                    url: '/getChildren',
                    type: 'GET',
                    data: {id_padre: id_padre},
                    dataType: 'json',
                    success: function (data) {
                        if (data.success) {
                            var children = data.data;
                            if (children.length > 0) {
                                var ul = $('<ul>').appendTo($(this));
                                $.each(children, function (index, child) {
                                    var li = $('<li>').attr('data-id', child.id).text(child.nombre);
                                    if (child.children.length > 0) {
                                        li.addClass('collapsed');
                                    }
                                    li.appendTo(ul);
                                });
                            }
                        }
                    }
                });
            }
            e.stopPropagation();
        });

        $('#treeview').on('click', 'li.collapsed', function (e) {
            $(this).click();
        });
    });
        </script>

        @endsection