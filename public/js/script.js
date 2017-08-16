$(document).ready(function() {

	//----- Nav Links -----//

	$('.nav-link').click(function() {
		$('.nav-link').not(this).removeClass('nav-click');
		$(this).addClass('nav-click');
	});

	$('#brand').click(function() {
		$.get('/home', function(data) { $('main').html(data); });
	});

	$('#nav-home').click(function() {
		$.get('/home', function(data) { $('main').html(data); });
	});

	$('#nav-about').click(function() {
		$.get('/about', function(data) { $('main').html(data); });
	});

	$('#nav-rooms').click(function() {
		$.get('/rooms',
			function(data) {
				$('main').html(data);
				$('.alert-success').css('display', 'none');
				$('.alert-danger').css('display', 'none');

				$('#details-view').css('display', 'none');
				$('#details-edit').css('display', 'none');
				$('#pictures-view').css('display', 'none');
			}
		);
	});

	$('#nav-reserve').click(function() {
		$.get('/reserve',
			function(data) {
				$('main').html(data);
				$('.alert-success').css('display', 'none');
				$('.alert-danger').css('display', 'none');
				$('#approved-list-text').html('');

				$('#reserve-apply').css('display', 'none');
				$('#status-view').css('display', 'none');
				$('#approved-list').css('display', 'none');
			}
		);
	});

	$('#nav-contact').click(function() {
		$.get('/contact',
			function(data) {
				$('main').html(data);
				$('.alert-success').css('display', 'none');
				$('.alert-danger').css('display', 'none');
			}
		);
	});

	$('#nav-login').click(function() {
		$.get('/login',
			function(data) {
				$('main').html(data);
				$('.alert-success').css('display', 'none');
				$('.alert-danger').css('display', 'none');
			}
		);
	});

	$('#nav-register').click(function() {
		$.get('/register',
			function(data) {
				$('main').html(data);
				$('.alert-success').css('display', 'none');
				$('.alert-danger').css('display', 'none');
			}
		);
	});


	//----- Form Submit -----//

	$(document).on('click', '#contact', function() {
		var data = {
			_token: $('#csrf').val(),
			first_name: $('#first-name').val(),
			last_name: $('#last-name').val(),
			phone: $('#phone').val(),
			email: $('#email').val(),
			message: $('#message').val()
		}

		$.ajax({
			url: '/contact',
			type:'POST',
			data: data,
			success: function(data) {
				displaySuccess('Message successfully sent!');
			},
			error: function(data) {
				displayErrors(data.responseJSON);
			}
		});
	});

	$(document).on('click', '#login', function() {
		var data = {
			_token: $('#csrf').val(),
			email: $('#email').val(),
			password: $('#password').val()
		}

		$.ajax({
			url: '/login',
			type:'POST',
			data: data,
			success: function(data) {
				window.location.href = '/';
			},
			error: function(data) {
				displayErrors(data.responseJSON);
			}
		});
	});

	$(document).on('click', '#register', function() {
		var data = {
			_token: $('#csrf').val(),
			first_name: $('#first-name').val(),
			last_name: $('#last-name').val(),
			phone: $('#phone').val(),
			email: $('#email').val(),
			password: $('#password').val(),
			password_confirmation: $('#password-confirm').val()
		}

		$.ajax({
			url: '/register',
			type:'POST',
			data: data,
			success: function(data) {
				window.location.href = '/';
			},
			error: function(data) {
				displayErrors(data.responseJSON);
			}
		});
	});

	function displaySuccess(success) {
		$('.alert-danger').css('display', 'none');
		$('.alert-success').css('display', 'block');
		$('.alert-success > p').html(success);
	}

	function displayErrors(errors) {
		$('.alert-success').css('display', 'none');
		$('.alert-danger').css('display', 'block');
		$('.alert-danger > ul').html('');

		$.each(errors, function(key, error) {
			$('.alert-danger > ul').append('<li>' + error + '</li>');
		});
	}

	$(document).on('click', '.close', function() {
		$('.alert-success').css('display', 'none');
		$('.alert-danger').css('display', 'none');
	});


	//----- Room Display -----//

	$(document).on('click', '.rooms [class*="bedroom-"]', function() {
		$.get('/rooms/' + $(this).val(),
			function(data) {
				var room = data.room;
				var pictures = data.pictures;

				$('#details-edit').css('display', 'none');
				$('#controls-confirm').css('display', 'none');
				$('#pictures-view').html('');

				$('#details-view').css('display', 'block');
				$('#pictures-view').css('display', 'block');
				$('#edit-details').css('display', 'inline-block');

				$('#room-id').val(room.id);
				$('.room-code').html(room.room_code);
				$('.capacity').html(room.capacity);
				$("#capacity").prop('max', room.capacity);
				$('.rate-night').html( room.rate_night.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") );
				$('.rate-week').html( room.rate_week.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") );
				$('.rate-month').html( room.rate_month.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",") );
				$('.amenities').html(room.amenities);

				$.each(pictures, function(key, picture) {
					$('#pictures-view').append(
						'<figure>' +
							'<a class="gallery" href="../' + picture.file_path + '">' +
								'<img class="room-picture img-responsive" rel="room" src="../' + picture.file_path + '" alt="' + room.room_code + '">' +
							'</a>' +
						'</figure>');
				});

				$('.gallery').featherlightGallery();
			}
		);
	});

	$(document).on('click', '#edit-details', function() {
		$('#details-view').css('display', 'none');
		$('#edit-details').css('display', 'none');

		$('#details-edit').css('display', 'block');
		$('#controls-confirm').css('display', 'block');

		$('#capacity').val( $('.capacity').html() );
		$('#rate-night').val( $('.rate-night').html().replace(/\,/g,'') );
		$('#rate-week').val( $('.rate-week').html().replace(/\,/g,'') );
		$('#rate-month').val( $('.rate-month').html().replace(/\,/g,'') );
		$('#amenities').val( $('.amenities').html() );
	});

	$(document).on('click', '#edit-details-yes', function() {
		var data = {
			_token: $('#csrf').val(),
			capacity: $('#capacity').val(),
			rate_night: $('#rate-night').val(),
			rate_week: $('#rate-week').val(),
			rate_month: $('#rate-month').val(),
			amenities: $('#amenities').val()
		}

		$.ajax({
			url: '/edit/details/' + $('#room-id').val(),
			type:'POST',
			data: data,
			success: function(data) {
				$('#details-edit').css('display', 'none');
				$('#controls-confirm').css('display', 'none');

				$('#details-view').css('display', 'block');
				$('#edit-details').css('display', 'inline-block');

				$('.capacity').html(data.capacity);
				$("#capacity").prop('max', data.capacity);
				$('.rate-night').html(data.rate_night);
				$('.rate-week').html(data.rate_week);
				$('.rate-month').html(data.rate_month);
				$('.amenities').html(data.amenities);

				displaySuccess('Room details successfully updated!');
			},
			error: function(data) {
				displayErrors(data.responseJSON);
			}
		});
	});

	$(document).on('click', '#controls-confirm .undo', function() {
		$('#capacity').val( $('.capacity').html() );
		$('#rate-night').val( $('.rate-night').html().replace(/\,/g,'') );
		$('#rate-week').val( $('.rate-week').html().replace(/\,/g,'') );
		$('#rate-month').val( $('.rate-month').html().replace(/\,/g,'') );
		$('#amenities').val( $('.amenities').html() );
	});

	$(document).on('click', '#controls-confirm .cancel', function() {
		$('#details-edit').css('display', 'none');
		$('#controls-confirm').css('display', 'none');

		$('#details-view').css('display', 'block');
		$('#edit-details').css('display', 'inline-block');
	});

	$(document).on('click', '.reserve [class*="bedroom-"]', function() {
		$.get('/reserve/' + $(this).val(),
			function(data) {
				$('#approved-list').html('');

				$('#reserve-apply').css('display', 'block');
				$('#status-view').css('display', 'block');
				$('#approved-list').css('display', 'block');

				$('#room-id').val(data.id);
				$('#rate-night').val(data.rate_night);
				$('#rate-week').val(data.rate_week);
				$('#rate-month').val(data.rate_month);

				$('.room-code-form').html(data.room_code);
				$('#persons').val(1);
				$("#persons").prop('max', data.capacity);
				$('#date-start').val( dateAsInput(new Date()) );
				$('#date-end').val( dateAsInput(new Date()) );

				$('.room-code').html('Bedroom ' + data.room_code);

				if(data.available) {
					$('.availability').html('Available');
					$('.occupancy').html((data.capacity - data.occupants) + '/' + data.capacity + ' Beds Available');

					$('.availability').removeClass('text-danger');
					$('.availability').addClass('text-success');
				}
				else {
					$('.availability').html('Reserved until ' + data.date_end['date_end']);

					if(data.exclusive) {
						$('.occupancy').html('Exclusive Reservation');
					}
					else {
						$('.occupancy').html('0/' + data.capacity + ' Beds Available');
					}

					$('.availability').removeClass('text-success');
					$('.availability').addClass('text-danger');
				}

				$('#approved-list-text').html('Approved Reservations' +
						'<br>(' + $('.room-code').html() + ')'
					);

				if(data.approved_room) {
					$('#approved-list').append('<div class="list-group">');

					$.each(data.approved_room, function(key, approved) {
						$('#approved-list').append(
							'<button type="button" class="reserve-item list-group-item list-group-item-info" ' +
								'value="' + approved.reservation_id + '" data-toggle="modal" data-target="#reserve-modal">' +
								'<h4 class="list-group-item-heading">Bedroom: ' + approved.room_code + '</h4>' +
								'<p class="list-group-item-text">Dates: ' + approved.date_start + ' ~ ' + approved.date_end + '</p>' +

								'<input type="hidden" class="room-code-item" value="' + approved.room_code + '">' +
								'<input type="hidden" class="rate-night" value="' + approved.rate_night + '">' +
								'<input type="hidden" class="rate-week" value="' + approved.rate_week + '">' +
								'<input type="hidden" class="rate-month" value="' + approved.rate_month + '">' +

								'<input type="hidden" class="first-name" value="' + approved.first_name + '">' +
								'<input type="hidden" class="last-name" value="' + approved.last_name + '">' +
								'<input type="hidden" class="phone" value="' + approved.phone + '">' +
								'<input type="hidden" class="email" value="' + approved.email + '">' +

								'<input type="hidden" class="persons" value="' + approved.persons + '">' +
								'<input type="hidden" class="date-start" value="' + approved.date_start + '">' +
								'<input type="hidden" class="date-end" value="' + approved.date_end + '">' +
								'<input type="hidden" class="exclusive" value="' + approved.exclusive + '">' +
							'</button>'
						);
					});

					$('#approved-list').append('</div>');
				}
			}
		);
	});

	$(document).on('click', '#add-reserve', function() {
		var data = {
			_token: $('#csrf').val(),
			persons: $('#persons').val(),
			date_start: $('#date-start').val(),
			date_end: $('#date-end').val(),
			exclusive: $('[class*="exclusive-"]:checked').val()
		}

		$.ajax({
			url: '/add/reserve/' + $('#room-id').val(),
			type:'POST',
			data: data,
			success: function(data) {
				$('#nav-reserve').trigger('click');
			},
			error: function(data) {
				displayErrors(data.responseJSON);
			}
		});
	});

	$(document).on('click', '.exclusive-yes', function() {
		$('.exclusive-yes').prop('checked', true);
		$('.exclusive-no').prop('checked', false);
	});

	$(document).on('click', '.exclusive-no', function() {
		$('.exclusive-yes').prop('checked', false);
		$('.exclusive-no').prop('checked', true);
	});

	$(document).on('change', '#date-start', function() {
		setStayDetails(
			$('#date-start').val(),
			$('#date-end').val(),
			$('#rate-night').val(),
			$('#rate-week').val(),
			$('#rate-month').val(),
			true
		);
	});

	$(document).on('change', '#date-end', function() {
		setStayDetails(
			$('#date-start').val(),
			$('#date-end').val(),
			$('#rate-night').val(),
			$('#rate-week').val(),
			$('#rate-month').val(),
			true
		);
	});

	function dateAsInput(jsDate) {
		var day = ('0' + jsDate.getDate()).slice(-2);
		var month = ('0' + (jsDate.getMonth() + 1)).slice(-2);
		var date = jsDate.getFullYear() + '-' + month + '-' + day;

		return date;
	}

	$(document).on('click', '#reserve-list .reserve-item', function() {
		$('#delete-reserve').css('display', 'none');

		$('#approve-pending').css('display', 'inline-block');
		$('#reject-pending').css('display', 'inline-block');

		setReserveModal(this);
	});

	$(document).on('click', '#approved-list .reserve-item', function() {
		$('#approve-pending').css('display', 'none');
		$('#reject-pending').css('display', 'none');

		$('#delete-reserve').css('display', 'inline-block');

		setReserveModal(this);
	});

	function setReserveModal(info) {
		$('#reservation-id').val( $(info).val() );
		$('#room-code-item').html( $(info).find('.room-code-item').val() );

		$('#first-name').html( $(info).find('.first-name').val() );
		$('#last-name').html( $(info).find('.last-name').val() );
		$('#phone').html( $(info).find('.phone').val() );
		$('#email').html( $(info).find('.email').val() );

		$('#persons').html( $(info).find('.persons').val() );
		$('#date-start').html( $(info).find('.date-start').val() );
		$('#date-end').html( $(info).find('.date-end').val() );

		if(parseInt( $(info).find('.exclusive').val() )) {
			$('#exclusive').html('Yes');
		}
		else {
			$('#exclusive').html('No');
		}

		setStayDetails(
			$(info).find('.date-start').val(),
			$(info).find('.date-end').val(),
			$(info).find('.rate-night').val(),
			$(info).find('.rate-week').val(),
			$(info).find('.rate-month').val(),
			false
		);
	}

	$(document).on('click', '#approve-pending', function() {
		var data = {
			_token: $('#csrf').val(),
			room_id: $('#room-id').val()
		}

		$.ajax({
			url: '/approve/pending/' + $('#reservation-id').val(),
			type:'POST',
			data: data,
			success: function(data) {
				$('#nav-reserve').trigger('click');
			},
			error: function(data) {
				displayErrors(data.responseJSON);
			}
		});
	});

	$(document).on('click', '#reject-pending', function() {
		$.post('/reject/pending/' + $('#reservation-id').val(),
			{ _token: $('#csrf').val() },
			function(data) {
				$('#nav-reserve').trigger('click');
			}
		);
	});

	$(document).on('click', '#delete-reserve', function() {
		$.post('/delete/reserve/' + $('#reservation-id').val(),
			{ _token: $('#csrf').val() },
			function(data) {
				$('#nav-reserve').trigger('click');
			}
		);
	});

	function setStayDetails(date_start, date_end, _rate_night, _rate_week, _rate_month, in_form) {
		var start = date_start;
		var end = date_end;
		var diff = new Date(Date.parse(end) - Date.parse(start));
		var days = diff / 1000 / 60 / 60 / 24;

		if(in_form) {
			$('.total-days').html(days);
		}
		else {
			$('#total-days').html(days);
		}

		var rate_night = _rate_night;
		var rate_week = _rate_week;
		var rate_month = _rate_month;

		var fee = 0;
        var months = parseInt(days / 28);
        fee += months * rate_month;

        days = days % 28;
        var weeks = parseInt(days / 7);
        fee += weeks * rate_week;

        days = days % 7;
        fee += days * rate_night;
        total_fee = fee.toFixed(2);
        total_fee = "&#8369; " + total_fee.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ",");

        if(in_form) {
			$('.total-fee').html(total_fee);
		}
		else {
			$('#total-fee').html(total_fee);
		}
	}

});
