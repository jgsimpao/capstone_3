<!-- Modal -->
<div id="reserve-modal" class="modal fade" role="dialog">
	<div class="modal-dialog modal-lg">

		<!-- Modal content-->
		<div class="modal-content">

			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">
					<span>Bedroom: </span>
					<span id="room-code-item"></span>
				</h4>
			</div>

			<div class="modal-body">
				<form class="form-horizontal">

					<input type="hidden" id="reservation-id">

					<div class="form-group col-sm-6">
						<label class="control-label col-sm-4">First Name:</label>
						<p id="first-name" class="form-control-static col-sm-8"></p>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label col-sm-4">Last Name:</label>
						<p id="last-name" class="form-control-static col-sm-8"></p>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label col-sm-4">Phone:</label>
						<p id="phone" class="form-control-static col-sm-8"></p>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label col-sm-4">Email:</label>
						<p id="email" class="form-control-static col-sm-8"></p>
					</div>

					<div class="form-group col-sm-6">
						<label class="control-label col-sm-4">Persons:</label>
						<p id="persons" class="form-control-static col-sm-8"></p>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label col-sm-4">Exclusive:</label>
						<p id="exclusive" class="form-control-static col-sm-8"></p>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label col-sm-4">Start Date:</label>
						<p id="date-start" class="form-control-static col-sm-8"></p>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label col-sm-4">End Date:</label>
						<p id="date-end" class="form-control-static col-sm-8"></p>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label col-sm-4">Total Days:</label>
						<p id="total-days" class="form-control-static col-sm-8"></p>
					</div>
					<div class="form-group col-sm-6">
						<label class="control-label col-sm-4">Total Fee:</label>
						<p id="total-fee" class="form-control-static col-sm-8"></p>
					</div>

				</form>
			</div>

			<div class="modal-footer">

				<div class="btn-row">
					<button type="button" id="approve-pending" class="btn btn-primary" data-dismiss="modal">
						<i class="fa fa-check" aria-hidden="true"></i> 
						Approve Application
					</button>
					<button type="button" id="reject-pending" class="btn btn-primary" data-dismiss="modal">
						<i class="fa fa-times" aria-hidden="true"></i> 
						Reject Application
					</button>
					<button type="button" id="delete-reserve" class="btn btn-primary" data-dismiss="modal">
						<i class="fa fa-trash" aria-hidden="true"></i> 
						Delete Reservation
					</button>
				</div>

				<button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

			</div>
		</div>

	</div>
</div>
