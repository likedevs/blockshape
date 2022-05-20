<div class="modal fade" id="modal">
    <form action="" method="post">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Decline?</h4>
            </div>
            <div class="modal-body">
                <label for="declineReason">Reason</label>
                <textarea name="declineReason" style="width: 100%; height: 80px;"></textarea>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Save changes</button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
    </form>
</div><!-- /.modal -->

@section('js')
    <script>
        $(function () {
            $('a[data-action="decline"]').click(function () {
                var modal = $('#modal'), form = modal.find('form');
                var id = $(this).data('record');

                form.attr('action', '/admin/history_records/decline/' + id);

                modal.modal('show');
                return false;
            })
        })
    </script>
@append