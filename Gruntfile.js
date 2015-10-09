module.exports = function( grunt ) {

	require('load-grunt-tasks')(grunt);

	var pkg = grunt.file.readJSON( 'package.json' );

	var bannerTemplate = '/**\n' +
		' * <%= pkg.title %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %>\n' +
		' * <%= pkg.author.url %>\n' +
		' *\n' +
		' * Copyright (c) <%= grunt.template.today("yyyy") %>;\n' +
		' * Licensed GPLv2+\n' +
		' */\n';

	var compactBannerTemplate = '/** ' +
		'<%= pkg.title %> - v<%= pkg.version %> - <%= grunt.template.today("yyyy-mm-dd") %> | <%= pkg.author.url %> | Copyright (c) <%= grunt.template.today("yyyy") %>; | Licensed GPLv2+' +
		' **/\n';

	// Project configuration
	grunt.initConfig( {

		pkg: pkg,

		uglify: {
	    scripts: {
	      files: [{
	          expand: true,
	          cwd: 'assets/scripts',
	          src: '**/*.js',
	          dest: 'assets/scripts/min'
	      }]
	    }
	},


		watch:  {
			styles: {
				files: ['dist/styles/**/*.css','assets/styles/**/*.scss'],
				tasks: ['styles'],
				options: {
					spawn: false,
					livereload: true,
					debounceDelay: 500
				}
			},
			scripts: {
				files: ['dist/scripts/**/*.js', 'assets/scripts/**/*.js'],
				tasks: ['scripts'],
				options: {
					spawn: false,
					livereload: true,
					debounceDelay: 500
				}
			}
		},

		addtextdomain: {
			dist: {
				options: {
					textdomain: pkg.name
				},
				target: {
					files: {
						src: ['**/*.php']
					}
				}
			}
		}

	} );

	grunt.loadNpmTasks('grunt-contrib-uglify');

	// Default task.
	grunt.registerTask( 'scripts', ['uglify:scripts'] );
	grunt.registerTask( 'styles', [] );
	grunt.registerTask( 'php', [ 'addtextdomain', 'makepot' ] );
	grunt.registerTask( 'default', ['styles', 'scripts', 'php'] );

	grunt.util.linefeed = '\n';
};
