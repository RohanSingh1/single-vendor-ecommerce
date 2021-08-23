<div id="myModal"class="modal fade" role="dialog">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h4 class="modal-title"></h4>
        <button type="button" class="close" data-dismiss="modal">&times;</button>
      </div>
      <div class="modal-body">
                {{-- Form Delete Post --}}
          <div class="deleteContent">
              Are you sure want to delete <span class="title"></span>?
              <span class="hidden id"></span>
            </div>
          </div>
      <div class="modal-footer">
        <button type="button" class="btn actionBtn btn-danger delete" data-dismiss="modal">
          <span id="footer_action_button" class="glyphicon glyphicon-trash">DELETE</span>
        </button>
        <button type="button" class="btn btn-warning" data-dismiss="modal">
          <span class="glyphicon glyphicon"></span>Close
        </button>
      </div>
    </div>
  </div>
</div>