module.exports = function( grunt ) {
	// Project configuration.
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),

		// PHP Code Sniffer
		phpcs: {
		    application: {
		        dir: ['src/**/*.php']
		    },
		    options: {
		        bin: 'vendor/bin/phpcs',
		        standard: 'psr2'
		    }
		},

		// PHPLint
		phplint: {
			options: {
				phpArgs: {
					'-lf': null
				}
			},
			all: [ 'src/**/*.php' ]
		},
		
		// PHP Mess Detector
		phpmd: {
			application: {
				dir: '.'
			},
			options: {
				exclude: 'node_modules,vendor',
				reportFormat: 'xml',
				rulesets: 'phpmd.ruleset.xml'
			}
		},

		// PHPUnit
		phpunit: {
			classes: {},
			options: {

			}
		},
		
		// Shell
		shell: {
			securityChecker: {
			    command: 'php vendor/bin/security-checker security:check',
			    options: {
			        stdout: true
			    }
			}
		}
	} );

	grunt.loadNpmTasks( 'grunt-phpcs' );
	grunt.loadNpmTasks( 'grunt-phplint' );
	grunt.loadNpmTasks( 'grunt-phpmd' );
	grunt.loadNpmTasks( 'grunt-phpunit' );
	grunt.loadNpmTasks( 'grunt-shell' );

	// Default task(s).
	grunt.registerTask( 'default', [ 'phplint', 'phpcs', 'phpmd', 'phpunit', 'shell' ] );
};
