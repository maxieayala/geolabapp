<h2>Muestras</h2>

<!-- Campos de entrada para los datos del sondeo -->

<!-- Tabla para las muestras -->
<table class="table table-striped" id="table_samples">
    <thead>
        <tr>
            <th>
                <i class="fa fa-caret-square-o-up"></i>
                Desde
            </th>
            <th><i class="fa fa-caret-square-o-down"></i>
                Hasta</th>
            <th><i class="fa fa-file-text-o"></i>
                Descripción
            </th>
        </tr>
    </thead>
    <tbody>
        <!-- Aquí puedes cargar las filas existentes de la base de datos si las hay -->
    </tbody>
</table>

<button type="button" class="btn btn-primary" onclick="agregarFila()">Agregar Fila</button>

<script>
    function agregarFila() {
        var fila = '<tr>' +
            '<td><input type="number" class="form-control form-control-sm" name="desde" required></td>' +
            '<td><input type="number"class="form-control form-control-sm"  name="hasta" required></td>' +
            '<td><input type="text" class="form-control form-control-sm" name="descripcion" required></td>' +
            '</tr>';
        $('#table_samples tbody').append(fila);
    }
</script>
