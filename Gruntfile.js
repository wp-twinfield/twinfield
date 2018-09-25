module.exports = function( grunt ) {
	require( 'load-grunt-tasks' )( grunt );

	// Project configuration.
	grunt.initConfig( {
		pkg: grunt.file.readJSON( 'package.json' ),

		// PHP Code Sniffer
		phpcs: {
		    application: {
		        src: [
		        	'src/**/*.php',
		        	'tests/**/*.php'
		        ]
		    },
		    options: {
		    	bin: 'vendor/bin/phpcs',
		    	standard: 'phpcs.xml.dist',
		        showSniffCodes: true
		    }
		},

		// PHPLint
		phplint: {
			all: [
				'src/**/*.php'
			]
		},
		
		// PHP Mess Detector
		phpmd: {
			application: {
				dir: '.'
			},
			options: {
				bin: 'vendor/bin/phpmd',
				exclude: 'node_modules,vendor',
				reportFormat: 'xml',
				rulesets: 'phpmd.ruleset.xml'
			}
		},

		// PHPUnit
		phpunit: {
			classes: {},
			options: {
				bin: 'vendor/bin/phpunit'
			}
		},
		
		// Shell
		shell: {
			options: {
				stdout: true,
				stderr: true
			},
			securityChecker: {
			    command: 'php vendor/bin/security-checker security:check'
			},
			apigen: {
				command: 'apigen generate'
			}
		}
	} );

	// Default task(s).
	grunt.registerTask( 'default', [ 'phplint', 'phpcs', 'phpmd', 'phpunit', 'shell:securityChecker' ] );
};
