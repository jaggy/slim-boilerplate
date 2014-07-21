module.exports = function(grunt) {

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    shell: {
      phpunit: {
        command: 'phpunit --testsuite="Application Suite"'
      },
      clear: {
        command: 'clear'
      },
      phpcs: {
        command: 'phpcs --standard=PSR2 --ignore=./app/config/bootstrap.php  ./app'
      }
    },

    stylus: {
      options: {
        compress: false,
        use: [
          function() {
            return require('autoprefixer-stylus')('last 10 versions', 'ie 8', 'ie 9');
          }
        ]
      },

      compile: {
        expand: true,
        cwd  : 'assets/stylus/',
        src  : '*.styl',
        dest : 'public/css/',
        ext  : '.css'
      }
    },

    watch: {

      stylus: {
        files: 'assets/stylus/**/*.styl',
        tasks: ['stylus:compile']
      },

      phpunit: {
        files: ['app/**/*.php', 'app/**/*.xml','test/**/*.php'],
        tasks: ['shell:clear', 'shell:phpunit', 'shell:phpcs']
      },

      livereload: {
        files: ['app/**/*.php', 'app/views/**/*.twig', 'public/**/*.*', 'public/*.*'],
        options: { livereload: true }
      }
    }

  });

  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-contrib-stylus');
  grunt.loadNpmTasks('grunt-shell');

  grunt.registerTask('phpunit', ['watch:phpunit']);
  grunt.registerTask('default', ['watch']);
}

