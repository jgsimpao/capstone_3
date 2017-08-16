<div class="rooms">

	<div class="alert alert-success alert-dismissable">
		<span class="close">&times;</span>
		<p></p>
	</div>
	<div class="alert alert-danger alert-dismissable">
		<span class="close">&times;</span>
		<ul></ul>
	</div>

	<div class="row">

		<div class="floor-plan col-sm-8">
			<h4>Click on a room to see more details.</h4>
			@foreach($rooms as $room)
				<button type="button" class="bedroom-{{ $room->id }} bg-info" value="{{ $room->id }}">
					<p>{{ $room->room_code }}</p>
				</button>
			@endforeach
		</div>

		<div class="room-details col-sm-4">

			<div id="details-view">
				<form class="form-horizontal">

					<input type="hidden" id="room-id">

					<div class="form-group">
						<label class="control-label col-sm-6">Bedroom:</label>
						<p class="room-code form-control-static col-sm-6"></p>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-6">Dimensions:</label>
						<p class="form-control-static col-sm-6">12' x 16'2"</p>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-6">Capacity:</label>
						<p class="capacity form-control-static col-sm-6"></p>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-6">Nightly Rate:</label>
						<p class="form-control-static col-sm-6">
							<span>&#8369;</span>
							<span class="rate-night"></span>
						</p>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-6">Weekly Rate:</label>
						<p class="form-control-static col-sm-6">
							<span>&#8369;</span>
							<span class="rate-week"></span>
						</p>
					</div>
					<div class="form-group">
						<label class="control-label col-sm-6">Monthly Rate:</label>
						<p class="form-control-static col-sm-6">
							<span>&#8369;</span>
							<span class="rate-month"></span>
						</p>
					</div>
					<div class="form-group">
                        <label class="control-label col-sm-6">Amenities:</label>
                        <p class="amenities form-control-static col-sm-6"></p>
                    </div>

                    @if(Auth::user() && Auth::user()->role_id == 1)
	                    <div class="btn-row">
	                		<button type="button" id="edit-details" class="btn btn-primary">
								<i class="fa fa-pencil" aria-hidden="true"></i> 
								Edit Details
							</button>
	                	</div>
                	@endif

				</form>
			</div>

			@if(Auth::user() && Auth::user()->role_id == 1)
				<div id="details-edit">
					<form class="form-horizontal">

						<div class="form-group">
							<label class="control-label col-sm-6">Bedroom:</label>
							<p class="room-code form-control-static col-sm-6"></p>
						</div>
						<div class="form-group">
							<label class="control-label col-sm-6">Dimensions:</label>
							<p class="form-control-static col-sm-6">12' x 16'2"</p>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-6" for="capacity">Capacity:</label>
							<div class="col-sm-6">
								<input type="number" id="capacity" class="form-control" min="1">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-6" for="rate-night">Nightly Rate:</label>
							<div class="col-sm-6">
								<input type="number" id="rate-night" class="form-control" min="0.01" step="0.01">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-6" for="rate-week">Weekly Rate:</label>
							<div class="col-sm-6">
								<input type="number" id="rate-week" class="form-control" min="0.01" step="0.01">
							</div>
						</div>

						<div class="form-group">
							<label class="control-label col-sm-6" for="rate-month">Monthly Rate:</label>
							<div class="col-sm-6">
								<input type="number" id="rate-month" class="form-control" min="0.01" step="0.01">
							</div>
						</div>

						<div class="form-group">
                            <label class="control-label col-sm-6" for="amenities">Amenities:</label>
                            <div class="col-sm-6">
                            	<textarea id="amenities" class="form-control" rows="5"></textarea>
                            </div>
                        </div>

						<div id="controls-confirm">

							<div class="btn-row">
								<button type="button" id="edit-details-yes" class="btn btn-primary">
									<i class="fa fa-check" aria-hidden="true"></i> 
									Confirm Edit
								</button>
							</div>

							<div class="btn-row">
								<button type="button" class="undo btn btn-primary">
									<i class="fa fa-undo" aria-hidden="true"></i> 
									Undo
								</button>
								<button type="button" class="cancel btn btn-primary">
									<i class="fa fa-times" aria-hidden="true"></i> 
									Cancel
								</button>
							</div>

						</div>
					</form>
				</div>
			@endif

		</div>
	</div>

	<div class="row">

		<div class="room-pictures col-sm-8">
			<div id="pictures-view"></div>
		</div>

		<div class="room-controls col-sm-4"></div>
	</div>
</div>
