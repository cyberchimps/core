module.exports = function(grunt) {

	require('load-grunt-tasks')(grunt);

	grunt.initConfig({
		makepot: {
			target: {
				options: {
					domainPath: 'lib/languages/',    // Where to save the POT file.
					mainFile: 'functions.php',      // Main project file.
					potFilename: 'cyberchimps_core.pot',   // Name of the POT file.
					type: 'wp-theme',  // Type of project (wp-plugin or wp-theme).
					exclude: [],       // List of files or directories to ignore.
					processPot: function( pot, options ) {
						pot.headers['report-msgid-bugs-to'] = 'http://cyberchimps.com/forum/';
						pot.headers['plural-forms'] = 'nplurals=2; plural=n != 1;';
						pot.headers['last-translator'] = 'Ulrich Pogson <ulrich@cyberchimps.com>\n';
						pot.headers['language-team'] = 'CyberChimps Translate <support@cyberchimps.com>\n';
						pot.headers['x-poedit-basepath'] = '.\n';
						pot.headers['x-poedit-language'] = 'English\n';
						pot.headers['x-poedit-country'] = 'UNITED STATES\n';
						pot.headers['x-poedit-sourcecharset'] = 'utf-8\n';
						pot.headers['x-poedit-keywordslist'] = '__;_e;__ngettext:1,2;_n:1,2;__ngettext_noop:1,2;_n_noop:1,2;_c,_nc:4c,1,2;_x:1,2c;_ex:1,2c;_nx:4c,1,2;_nx_noop:4c,1,2;\n';
						pot.headers['x-textdomain-support'] = 'yes\n';
						return pot;
					}
				}
			}
		},

		exec: {
			update_po_wti: { // Update WebTranslateIt translation - grunt exec:update_po_wti
				cmd: 'wti pull',
				cwd: 'lib/languages/',
			}
		},

		po2mo: {
			files: {
				src: 'lib/languages/*.po',
				expand: true,
			},
		},
	});

	// Default task(s).
	grunt.registerTask( 'default', [ 'makepot', 'exec', 'po2mo' ] );

};
