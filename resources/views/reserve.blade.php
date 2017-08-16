<div class="reserve">

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
			<h4>
				Click on a room to see more details.<br>
				Only logged in users can make a reservation.
			</h4>
			@foreach($rooms as $room)
				<button type="button" class="bedroom-{{ $room->id }} 
					@if(!count($rooms_available))
						bg-success
					@else
						@if($rooms_available[$room->id])
							bg-success
						@else
							bg-danger
						@endif
					@endif
					" value="{{ $room->id }}">
					<p>{{ $room->room_code }}</p>
				</button>
			@endforeach
		</div>

		<div class="room-reserve col-sm-4">

			@if(Auth::user() && Auth::user()->role_id == 2)
				@if(!count($user_application))
					<div id="reserve-apply">
						<h4 class="text-center">Reservation Form</h4>
						<form class="form-horizontal">

							<input type="hidden" id="room-id">
							<input type="hidden" id="rate-night">
							<input type="hidden" id="rate-week">
							<input type="hidden" id="rate-month">

							<div class="form-group">
								<label class="control-label col-sm-6">Bedroom:</label>
								<p class="room-code-form form-control-static col-sm-6"></p>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="persons">Persons:</label>
								<div class="col-sm-6">
									<input type="number" id="persons" class="form-control" min="1">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6">Exclusive:</label>
								<div class="col-sm-6">
									<label class="radio-inline"><input type="radio" class="exclusive-yes" value="1" checked>Yes</label>
									<label class="radio-inline"><input type="radio" class="exclusive-no" value="0">No</label>
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="date-start">Start Date:</label>
								<div class="col-sm-6">
									<input type="date" id="date-start" class="form-control" min="" max="">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6" for="date-end">End Date:</label>
								<div class="col-sm-6">
									<input type="date" id="date-end" class="form-control" min="" max="">
								</div>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6">Total Days:</label>
								<p class="total-days form-control-static col-sm-6"></p>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6">Total Fee:</label>
								<p class="total-fee form-control-static col-sm-6"></p>
							</div>

							<div class="btn-row">
								<button type="button" id="add-reserve" class="btn btn-primary">
									<i class="fa fa-key" aria-hidden="true"></i> 
									Reserve Room
								</button>
							</div>

						</form>
					</div>

				@else
					<div id="reserve-view">
						<h4 class="text-center">
							Reservation Application<br>
							@if($user_application->pivot->approved)
								(Approved)
							@else
								(Pending Approval)
							@endif
						</h4>
						<form class="form-horizontal">

							<div class="form-group">
								<label class="control-label col-sm-6">Bedroom:</label>
								<p class="room-code-res form-control-static col-sm-6">{{ $user_application->room_code }}</p>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6">Persons:</label>
								<p class="persons form-control-static col-sm-6">{{ $user_application->pivot->persons }}</p>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6">Exclusive:</label>
								<p class="exclusive form-control-static col-sm-6">
									@if($user_application->pivot->exclusive)
										Yes
									@else
										No
									@endif
								</p>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6">Start Date:</label>
								<p class="date-start form-control-static col-sm-6">{{ $user_application->pivot->date_start }}</p>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6">End Date:</label>
								<p class="date-end form-control-static col-sm-6">{{ $user_application->pivot->date_end }}</p>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6">Total Days:</label>
								<p class="total-days form-control-static col-sm-6">{{ $stay_details['total_days'] }}</p>
							</div>

							<div class="form-group">
								<label class="control-label col-sm-6">Total Fee:</label>
								<p class="total-fee form-control-static col-sm-6">{{ $stay_details['total_fee'] }}</p>
							</div>

						</form>
					</div>
				@endif
			@endif

			@if(Auth::user() && Auth::user()->role_id == 1)
				<div id="reserve-list">
					<h4 class="text-center">Pending Reservations</h4>
					@include('reserve_list')
				</div>
				@include('reserve_modal')
			@endif

		</div>
	</div>

	<div class="row">

		<div class="reserve-status col-sm-8">
			<div id="status-view">

				<div class="jumbotron text-center">
					<p class="room-code"></p>
					<p class="availability"></p>
					<p class="occupancy"></p>
				</div>

			</div>
		</div>

		<div class="reserve-controls col-sm-4">

			@if(Auth::user() && Auth::user()->role_id == 1)
				<h4 id="approved-list-text" class="text-center"></h4>
				<div id="approved-list"></div>
			@endif

		</div>
	</div>
</div>
