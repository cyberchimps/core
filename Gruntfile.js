module.exports = function(grunt) {

grunt.initConfig({
    makepot: {
        target: {
            options: {
                domainPath: '/lib/languages/',    // Where to save the POT file.
                mainFile: 'functions.php',      // Main project file.
                potFilename: 'cyberchimps_core.pot',   // Name of the POT file.
                type: 'wp-theme'  // Type of project (wp-plugin or wp-theme).
            }
        }
    }
});

// Load the plugin that provides the "makepot" task.
grunt.loadNpmTasks( 'grunt-wp-i18n' );

// Default task(s).
grunt.registerTask('default', ['makepot']);

};
