@if (Session::has('message'))
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
      <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <p class="text-center">{{ Session::get('message') }}</p>
                  </div>
                  <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
            </div>
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endif

@if (Session::has('cartMessage'))
    <div class="modal fade" tabindex="-1" role="dialog" id="myModal">
      <div class="modal-dialog" role="document">
           <div class="modal-content">
               <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                  </div>
                  <div class="modal-body">
                    <p class="text-center">{{ Session::get('cartMessage') }}</p>
                  </div>
                  <div class="modal-footer">
                     <a href="/cart" class="btn btn-default">View Cart</a>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                  </div>
            </div>
      </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->
@endif
