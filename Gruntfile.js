module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    shell: {
      runTest: {
        command: 'phpunit'
      },
      clear: {
        command: 'clear'
      }
    },

    watch: {
      phpunit: {
        files: 'app/**/*.php',
        tasks: ['shell:clear', 'shell:runTest']
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-shell');

  grunt.registerTask('phpunit', ['watch:phpunit']);
}

