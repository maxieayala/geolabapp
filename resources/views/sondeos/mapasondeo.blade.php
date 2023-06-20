<div class="modal fade bd-example-modal-lg" id="vermapaModal" tabindex="-1" role="dialog"
    aria-labelledby="ModalLabelSondeo" aria-hidden="true">

    <input type="hidden" name="proyecto_id" id="proyecto_id" value="">

    <div class="modal-dialog modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalLabelSondeo">Ubicación de Sondeos</h5>
                <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">×</span>
                </button>
            </div>
            <div class="modal-body">
                <!-- DataTales Example -->
                <div class="card-body" style="height: 300px;">
                    <x-maps-leaflet :markers="[['lat' => 52.16444513293423, 'long' => 5.985622388024091]]" style="height: 100%;"></x-maps-leaflet>
                </div>
            </div>
        </div>
    </div>
