module.exports = function(grunt) {

    grunt.initConfig({
        pkg: grunt.file.readJSON('package.json'),
        concat: {
            options: {
                separator: ';'
            },
            admin: {
                src: [
                    '../../public/js/packages/*.js'
                ],
                dest: '../../public/js/admin.js'
            }
        },
        uglify: {
            options: {
                banner: '/*! <%= pkg.name %> <%= grunt.template.today("dd-mm-yyyy") %> */\n'
            },
            admin: {
                files: {
                    '../../public/js/admin.min.js': ['<%= concat.admin.dest %>']
                }
            }
        },
        less: {
            admin: {
                options: {
                    paths: ["../../public/css/"]
                },
                files: {
                    "../../public/css/admin.css": "../../public/css/admin.less"
                }
            }
        },
        cssmin: {
            admin: {
                options:{
                    keepSpecialComments:0
                },
                files: {
                    "../../public/css/admin.min.css": ["../../public/css/admin.css"]
                }
            }
        },
        jshint: {
            files: [
                'gruntfile.js',
                '../../public/js/packages/*.js'
            ],
            options: {
                // options here to override JSHint defaults
                globals: {
                    jQuery: true,
                    console: true,
                    module: true,
                    document: true
                }
            }
        },
        watch: {
            /*test: {
             files: ['<%= jshint.files %>'],
             tasks: ['jshint', 'qunit']
             },*/
            js: {
                files: ['<%= concat.admin.src %>'],
                tasks: ['js']
            },
            css: {
                files: ['../../public/css/packages/*'],
                tasks: ['css']
            }
        },
        closureCompiler:  {

            options: {
                compilerFile: '../compiler.jar',
                checkModified: true,
                compilerOpts: {
                    compilation_level: 'SIMPLE_OPTIMIZATIONS',
                    externs: ['externs/*.js'],
                    //define: ["'goog.DEBUG=false'"],
                    warning_level: 'verbose',
                    jscomp_off: ['checkTypes', 'fileoverviewTags'],
                    summary_detail_level: 3,
                    output_wrapper: '"(function(){%output%}).call(this);"'
                },
                execOpts: {
                    maxBuffer: 999999 * 1024
                }
            },
            adminKacana: {
                src: '../../public/js/admin.js',
                dest: '../../public/js/admin.compile.js'
            }
        }
    });

    grunt.loadNpmTasks('grunt-contrib-uglify');
    grunt.loadNpmTasks('grunt-contrib-jshint');
    grunt.loadNpmTasks('grunt-contrib-watch');
    grunt.loadNpmTasks('grunt-contrib-concat');
    grunt.loadNpmTasks('grunt-contrib-less');
    grunt.loadNpmTasks('grunt-contrib-cssmin');
    grunt.loadNpmTasks('grunt-closure-tools');

    grunt.registerTask('test', ['jshint']);

    grunt.registerTask('default', ['concat', 'uglify', 'less', 'cssmin']);

    grunt.registerTask('js', ['concat:admin', 'uglify:admin']);
    grunt.registerTask('closure', ['closureCompiler:admin']);
    grunt.registerTask('css', ['less:admin','cssmin:admin']);

};