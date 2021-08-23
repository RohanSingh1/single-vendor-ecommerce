
<div class="modal fade bs-modal-md" id="viewPermission" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-md">
		<div class="modal-content">
			<span id="loading"></span>
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title"><i class="fa fa-info-circle" id="icon-terminate" ></i> Permissions
				</h4>
			</div>
			<div class="modal-body" style="padding-left: 20px;padding-right: 20px;">
				<ul class="list-group" id="list">
				
				</ul>
			</div>
			<input type="hidden" id="hidden_id">
			<div class="modal-footer">
				<button type="button" class="btn btn-defult" data-dismiss="modal"><i class="icon-close" id="icon-terminate"></i>
					close
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
</div>


<div class="modal fade bs-modal-sm" id="confirmDelete" tabindex="-1" role="dialog" aria-hidden="true">
	<div class="modal-dialog modal-sm">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true"></button>
				<h4 class="modal-title"><i class="fa fa-info-circle" id="icon-terminate" ></i> Delete Permanently
				</h4>
			</div>
			<div class="modal-body"> Do you want to delete <span class='hidden_title'>" "</span>?</div>
			<input type="hidden" id="hidden_id">
			<div class="modal-footer">
				<button type="button" class="btn btn-danger green confirm_yes" id="confirm_yes"><i class="icon-check"></i> Yes
				</button>
				<button type="button" class="btn btn-defult" data-dismiss="modal"><i class="icon-close" id="icon-terminate"></i>
					No
				</button>
			</div>
		</div>
		<!-- /.modal-content -->
	</div>
</div>