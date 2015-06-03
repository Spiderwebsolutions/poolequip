module.exports = function(grunt) {

  // Bootstrap grunt
  grunt.initConfig({

    // Read package file
    pkg: grunt.file.readJSON('package.json'),

    // Create sass task and define parameters. Converts sass to compressed standard CSS.
    sass: {
      dist: {
        options: {
          lineNumbers: true
        },
        files: {
        'wp-content/themes/spiderweb/style.css' : 'wp-content/themes/spiderweb/assets/sass/style.scss'
        }
      }
    },

    // Create uglify task and define parameters. Uglify consolidates and minifies JS.
    uglify: {
      build: {
        files: {
          'wp-content/themes/spiderweb/assets/js/functions.min.js':
          ['wp-content/themes/spiderweb/assets/js/*.js', '!wp-content/themes/spiderweb/assets/js/functions.min.js']
        }
      }
    },

    // Setup HTML Hint task to let us know if HTML will not validate
    htmlhint: {
      html1: {
        options: {
          'tag-pair': true,
          'doctype-first': true,
          'src-not-empty': true,
          'id-unique': true,
          'attr-lowercase': true,
          'tagname-lowercase': true
        },
        src: ['wp-content/themes/spiderweb/./*.html']
      }
    },

    // Ting PNG those bloaters
    tinypng: {
      options: {
        apiKey: "4I7zL9dm3vEx6hCBJUsJ2Slz7vO1ypSR",
        checkSigs: false,
        summarize: true,
        showProgress: true,
        stopOnImageError: true
      },
      uploads: {
        expand: true,
        cwd: 'wp-content/uploads/',
        src: ['**/*.{png,jpg}'],
        dest: 'wp-content/uploads/'
      },
      theme: {
        expand: true,
        cwd: 'wp-content/themes/spiderweb/assets/art/',
        src: ['**/*.{png,jpg}'],
        dest: 'wp-content/themes/spiderweb/assets/art/'
      }
    },


    // Setup watcher to do stuff all the time (this is just another task)
    // This will automatically execute the uglify and sass tasks when the specified files change
    watch: {
      css: {
        files: 'wp-content/themes/spiderweb/assets/sass/*.scss',
        tasks: ['sass']
      },
      js: {
        files: ['wp-content/themes/spiderweb/assets/js/*.js', '!wp-content/themes/spiderweb/assets/js/functions.min.js'],
        tasks: ['uglify']
      },
      php: {
        files: 'wp/wp-content/themes/spiderweb/*.php',
        tasks: [] //Do nothing, we just want to trigger livereload here
      },
      options: {
        livereload: true
      }
    },

    // Wordpress DB Deployment
    // grunt push_db --target=environment_name:
    // grunt pull_db --target=environment_name:

    wordpressdeploy: {
      options: {
        backup_dir: "backups/",
        rsync_args: ['--verbose', '--progress', '-rlpt', '--compress', '--omit-dir-times', '--delete'],
        exclusions: ['Gruntfile.js', '.git/', 'tmp/*', 'backups/', 'wp-config.php', 'wp-config-local.php', 'composer.json', 'composer.lock', 'README.md', '.gitignore', 'package.json', 'node_modules']
      },
      local: {
        "title": "local",
        "database": "{repo}",
        "user": "root",
        "pass": "root",
        "host": "localhost",
        "url": "http://localhost/{repo}",
        "path": "/"
      }
      //staging: {
      //  "title": "staging",
      //  "database": "bb_{repo}",
      //  "user": "bb",
      //  "pass": "birdbrain2505$",
      //  "host": "birdbrain.io",
      //  "url": "http://stage.birdbrain.io/{repo}",
      //  "path": "/public_html/stage/{repo}",
      //  "ssh_host": "bb@birdbrain.io"
      //}
    }

  });

  // Load task libs
  grunt.loadNpmTasks('grunt-contrib-sass');
  grunt.loadNpmTasks('grunt-contrib-uglify');
  grunt.loadNpmTasks('grunt-contrib-watch');
  grunt.loadNpmTasks('grunt-htmlhint');
  grunt.loadNpmTasks('grunt-tinypng');
  grunt.loadNpmTasks('grunt-wordpress-deploy');

  // Begin watcher when 'grunt' is executed in bash/cmd prompt
  // the 'watch' task will minify js, convert sass to css etc
  grunt.registerTask('default', ['watch']);

  // Setup another task to only run stuff once, without monitoring
  grunt.registerTask('pass', ['sass','uglify','htmlhint']);

  // Speed the heck up
  grunt.registerTask('build', ['tinypng']);

}
