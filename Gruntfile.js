/**
 * Gruntfile.js
 */
'use strict';
var LIVERELOAD_PORT = 35729;
var lrSnippet = require('connect-livereload')({port: LIVERELOAD_PORT});
var mountFolder = function (connect, dir) {
    return connect.static(require('path').resolve(dir));
};

var exec = require('child_process').exec;
process.on('SIGINT', function () {
    exec('/Applications/MAMP/bin/stop.sh', function () {
        process.exit();
    });
});

module.exports = function(grunt) {
     // show elapsed time at the end
    require('time-grunt')(grunt);
    // load all grunt tasks
    require('load-grunt-tasks')(grunt);

  grunt.initConfig({
    pkg: grunt.file.readJSON('package.json'),

    php: {
        dist: {
            options: {
                port: 8888,
                open: true,
                livereload: true
            }
        },

    },
    /*connect: {
        server: {
            options: {
                port: 8080,
                open: true,
                livereload: true
            }
        }
    },*/
     watch: {
            compass: {
            files: ['app/assets/scss/{,*/}*.{scss,sass}'],
            tasks: ['compass:server']
            },
            livereload: {
                options: {
                    livereload: LIVERELOAD_PORT
                },
                files: [
                '**.php',
                'app/assets/*.html',
                'app/assets/css/{,*/}*.css',
                'app/assets/scss/{,*/}*.scss',
                'app/assets/js/{,*/}*.js',
                'app/assets/images/{,*/}*.{png,jpg,jpeg,gif,webp,svg}'
                ]
            }
        },

    exec: {
      serverup: {
        command: '/Applications/MAMP/bin/start.sh'
      }/*,
      serverdown: {
        command: '/Applications/MAMP/bin/stop.sh'
      }*/
    },

    phpcs: {
        application: {
            dir: 'src'
        },
        options: {
            bin: 'phpcs',
            standard: 'PSR-MOD'
        }
    },
    phplint: {
        options: {
            swapPath: '/tmp'
        },
        all: ['src/*.php', 'src/base/*.php', 'src/config/*.php', 'src/controller/*.php', 'src/model/*.php']
    },
    phpunit: {
        unit: {
            dir: 'tests/unit'
        },
        options: {
            bin: 'phpunit',
            bootstrap: 'tests/Bootstrap.php',
            colors: true,
            testdox: true
        }
    },
    php_analyzer: {
        application: {
            dir: 'src'
        }
    }
  });


  grunt.registerTask('precommit', ['phplint:all', 'phpunit:unit']);
  grunt.registerTask('default', ['phplint:all', 'phpcs', 'phpunit:unit', 'php_analyzer:application']);
  grunt.registerTask('server', ['exec:serverup', 'php','watch']);
};