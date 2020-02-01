@include("..forms.copy")

 <div class="modal fade" id="copyEventModal" tabindex="-1" role="dialog" aria-labelledby="copyEventModal" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="copyEventLabel">Copiar Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @yield("copyContent")
            </div>
        </div>
    </div>
</div>