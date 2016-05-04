require.config({
	baseUrl: 'assets/admin/js',
	paths: {
		'app': './bandmanager'
	},
	'shim': {
		'jquery.alpha': ['jquery']
	}
});

require(["app/main"]);
require(["app/dashboard/index"]);