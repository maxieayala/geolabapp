@extends('layouts.app')

@section('title', 'Catalogos')

@section('content')
<div class="container-fluid">
    <div class="modal" tabindex="-1" role="dialog" id="editcatalogoModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Editar catalogo</h5>

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

    <!-- Encabezado -->
    <div class="d-sm-flex align-catalogos-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Catalogos</h1>
        <div class="row">
			<div class="col-md-6">
				<a href="{{ route('catalogosAgregar') }}" class="btn btn-sm btn-primary">
					<i class="fas fa-plus"></i> Agregar
				</a>
			</div>
			<div class="col-md-6">
				<a href="{{ route('catalogosExportar') }}" class="btn btn-sm btn-success">
					<i class="fas fa-check"></i> Exportar
				</a>
			</div>
		</div> 
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
                                    <!-- <th scope="col">ID_Padre</th> -->
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Descripcion</th>
                                    <th scope="col">Fecha creacion</th>
                                    <th scope="col">Fecha actualizacion</th>
                                    </tr>
                                </thead>
                                
                                <tbody>
                                @foreach ($Catalogos as $catalogo) <!-- aca imprime la data -->
                                    <tr>
                                        <td>{{$catalogo['id']}}</td>
                                        <!-- <td>{{$catalogo['id_padre']}}</td> -->
                                        <td>{{$catalogo['nombre']}}</td>
                                        <td>{{$catalogo['descripcion']}}</td>
                                        <td>{{$catalogo['created_at']->format('d/m/Y')}}</td>
                                        <td>{{$catalogo['updated_at']->format('d/m/Y')}}</td>

                                        <td style="display: flex"> <!-- aca agrego los botones de editar/borrar -->

                                    <a href="{{ route('catalogos_edit', $catalogo->id) }}"
                                        class="btn btn-primary m-2">
                                        <i class="fa fa-pen"></i>
                                    </a>
                                    
                                    <a href="{{ route('catalogos.destroy', $catalogo->id) }}"
                                        class="btn btn-danger m-2"
                                        onclick=
                                        "
                                        event.preventDefault();
                                        if (confirm('¿Estás seguro de eliminar el catalogo?')) {
                                            document.getElementById('delete-form-{{ $catalogo->id }}').submit();
                                        }
                                        "
                                    >
                                    <i class="fas fa-trash"></i>
                                    </a>
                                    <form id="delete-form-{{ $catalogo->id }}" action="{{ route('catalogos.destroy', $catalogo->id) }}"
                                        method="POST" style="display: none;">
                                    @csrf
                                    @method('DELETE')
                                </form>

                                @endforeach
                                </tbody>

                            </table> <!-- aca termina HO -->
                            
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