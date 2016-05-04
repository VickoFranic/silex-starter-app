require.config({
	baseUrl: 'assets/admin/js',
	paths: {
		'notifications': 'bandmanager/dashboard/notifications'
	},
	'shim': {
		'notifications': 'bandmanager/dashboard/notifications'
	}
});

require(["notifications"]);