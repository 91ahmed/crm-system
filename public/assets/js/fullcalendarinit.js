$(document).ready(function() {

  // page is now ready, initialize the calendar...
  var calendar_data = $('#calendar').attr('data-url');

    var calendarEl = document.getElementById('calendar');
	var calendar = new FullCalendar.Calendar(calendarEl, {
	  	initialView: 'dayGridMonth',
		headerToolbar: {
		  left: 'prev,next today',
		  center: 'title',
		  right: 'dayGridMonth,listMonth'
		},
		events: function( fetchInfo, successCallback, failureCallback ) { 
		  $.ajax({
		    url: calendar_data,
		    type: 'GET',
		    dataType: 'JSON',
		    success: function(data) {
		      var events = [];
		      if (data != null) {
		        $.each(data, function(i, item) {
		          events.push({
		          	url: 'http://localhost:8000/calendar/activity/'+item.activity_id,
		          	title: item.activity_subject,
		            start: item.activity_start_date,
		            end: item.activity_end_date
		          })
		        })
		      }
		      successCallback(events);
		    }
		  })
		}
	});
	calendar.render();

});