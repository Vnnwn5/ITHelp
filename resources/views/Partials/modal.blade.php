<!-- Modal -->
<div class="modal fade" id="deleteModal" data-backdrop="static" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="deleteModalLabel">Eliminando registro</h5>
            </div>
            <div class="modal-body">
              <p>Estas seguro de eliminar este registro?</p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal" :disabled="showSpinner">No</button>
                <button type="button" class="btn btn-danger" @click="deleteIt" :disabled="showSpinner">
                <span v-if="showSpinner" class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Si, estoy seguro</button>
            </div>
        </div>
    </div>
</div>
