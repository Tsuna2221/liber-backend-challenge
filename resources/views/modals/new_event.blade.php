@include("..forms.event")

 <div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="eventModalLabel">Adicionar Evento</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                @yield("eventContent")
            </div>
        </div>
    </div>
</div>