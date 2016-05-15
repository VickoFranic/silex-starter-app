function generateNotification(n) {
	return "<div class='desc'><div class='thumb'>"+
				   "<span class='badge bg-theme'>"+
				   		"<i class='fa fa-clock-o'></i>"+
				   "</span></div>"+
				   "<div class='details'>"+
				   "<p>" + n.page + "</p>"+
		    	   "<p><muted>" + n.created_time + "</muted><br/>"+ n.title +"<br/></p>"+
	    			"</div>"+
	    		"</div>";
}

var token = $('#access_token').val();
var container = $('#notifications');
var notifications;

$.ajax({
	url: '/api/user/notifications',
	method: 'POST',
	data: { 'access_token': this.token },
	success: function(data) {
		showNotifications(data);
	}
});


function showNotifications(data) {
	
	notifications = $.parseJSON(data);

	_.each(notifications, function(n) {

		var notif = generateNotification(n);
		container.append(notif);
	});

	container.find('#loading').hide();
}
