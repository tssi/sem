require.config({
    baseUrl:'app',
	urlArgs :(function(){
        var metaVersion = document.querySelector('meta[name="version"]').getAttribute('content');
        var d =  new Date();
	    var c=metaVersion || 'v1.3.060i';
        
        if(window.location.hostname=="localhost")
            c+='.'+(new Date().valueOf().toString().substr(9));
        
        return c;

        }()),
	waitSeconds: 60,
    // Alias libraries paths
    paths: {     
        'settings': '../config/settings',
        'app': '../config/app',
        'demo': 'config/demo',
        'model': 'config/model',
        'angular': 'bower_components/angular/angular.min',
        'angularAMD': 'bower_components/angularAMD/angularAMD.min',
		'angular-route': 'bower_components/angular-route/angular-route.min',
        'angular-cookies': 'bower_components/angular-cookies/angular-cookies.min',
        'angular-local-storage': 'vendors/bower_components/angular-local-storage/dist/angular-local-storage.min',
		'ui-bootstrap' : 'bower_components/angular-bootstrap/ui-bootstrap-tpls.min',
        'ngload': 'bower_components/angularAMD/ngload.min', 
        'ui.tree': 'bower_components/angular-ui-tree/dist/angular-ui-tree', 
		'root': 'controllers/root_controller',
		'directives': 'directives/bootstrap_directive',
		'api': 'controllers/api_controller',
        'moment':'vendors/node_modules/moment/moment',
        'chart':'vendors/node_modules/chart.js/dist/Chart.min',
        'angular-chart':'vendors/node_modules/angular-chart.js/dist/angular-chart',
		'students':'../controllers/students',
		'assesments':'../controllers/assesments',
		'enrollment':'../controllers/enrollment',
        'custom-window':'vendors/custom_window',
        'md5':'../vendors/node_modules/js-md5/build/md5.min',
        'exceljs':'../vendors/node_modules/exceljs/dist/exceljs',
		'atomic':'vendors/atomic_design',
		'util':'../config/util',
        'main':'../controllers/main',
    },
    // Add angular modules that does not support AMD out of the box, put it in a shim
    shim: {
        'angular' : {exports : 'angular'},
        'angular-route': ['angular'],
        'angular-cookies': ['angular'],         
        'angular-local-storage': ['angular'],         
        'angularAMD': ['angular'],
        'ui-bootstrap': ['angular'],
        'ui.tree': ['angular'],
        'angular-chart': ['angular','chart'],
        'custom-window': ['angular'],
    },
    // kick start application
    deps: ['app']
});