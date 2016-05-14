var token = $('#access_token').val();

var pages;

$.ajax({
	url: '/api/user/pages',
	method: 'POST',
	data: { 'access_token': this.token },
	success: function(pages) {
		showPages(pages);
	}
});


function showPages(pages) {

	console.log(pages);
}