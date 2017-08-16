<div class="list-group">
	@foreach($reserve_items as $reserve_item)
		<button type="button" class="reserve-item list-group-item 
			@if($list_pending)
				list-group-item-warning
			@else
				list-group-item-info
			@endif
			" value="{{ $reserve_item->reservation_id }}" data-toggle="modal" data-target="#reserve-modal">
			<h4 class="list-group-item-heading">Bedroom: {{ $reserve_item->room_code }}</h4>
			<p class="list-group-item-text">Dates: {{ $reserve_item->date_start }} ~ {{ $reserve_item->date_end }}</p>

			<input type="hidden" class="room-code-item" value="{{ $reserve_item->room_code }}">
			<input type="hidden" class="rate-night" value="{{ $reserve_item->rate_night }}">
			<input type="hidden" class="rate-week" value="{{ $reserve_item->rate_week }}">
			<input type="hidden" class="rate-month" value="{{ $reserve_item->rate_month }}">

			<input type="hidden" class="first-name" value="{{ $reserve_item->first_name }}">
			<input type="hidden" class="last-name" value="{{ $reserve_item->last_name }}">
			<input type="hidden" class="phone" value="{{ $reserve_item->phone }}">
			<input type="hidden" class="email" value="{{ $reserve_item->email }}">

			<input type="hidden" class="persons" value="{{ $reserve_item->persons }}">
			<input type="hidden" class="date-start" value="{{ $reserve_item->date_start }}">
			<input type="hidden" class="date-end" value="{{ $reserve_item->date_end }}">
			<input type="hidden" class="exclusive" value="{{ $reserve_item->exclusive }}">
		</button>
	@endforeach
</div>
