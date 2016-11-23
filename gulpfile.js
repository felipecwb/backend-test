var gulp       = require('gulp'),
    bower      = require('gulp-bower'),
    babel      = require('gulp-babel'),
    concat     = require('gulp-concat'),
    clean      = require('gulp-clean'),
    browserify = require('gulp-browserify'),
    uglify     = require('gulp-uglify');

var paths = {
    main: './public/js/index.js',
    JS: './public/js/**/*.js',
    temp: './tmp',
    vendor: './public/static/vendor',
    dist: './public/static/js/'
}

// Apply prod
gulp.task('set-prod', function() {
    return process.env.NODE_ENV = 'production';
});

// Dependencies
gulp.task('bower', function () {
    bower({cmd: 'install', directory: paths.vendor});
});

// WATCH
gulp.task('watch', function w() {
    try{
        return gulp.watch(paths.JS, ['scripts']);
    } catch (e){ // recursive way :P
        return w();
    }
});

// transpiler Scripts
gulp.task('scripts', function () {
    return gulp.src(paths.JS)
        .pipe(babel({presets: ['react', 'es2015']}))
        .pipe(gulp.dest(paths.temp))
        .on('end', function () {
            console.log("[xx:xx:xx] Start browserify");
            return gulp.src(paths.temp + '/index.js')
                .pipe(browserify({
                    shim: {
                        'react': {
                            path: paths.vendor + '/react/react.min.js',
                            exports: 'React'
                        },
                        'jquery': {
                            path: paths.vendor + '/jquery/dist/jquery.min.js',
                            exports: 'jQuery'
                        },
                        'semantic-ui':{
                            path: paths.vendor + '/semantic/dist/semantic.min.js',
                            exports: ''
                        },
                        'axios': {
                            path: paths.vendor + '/axios/dist/axios.min.js',
                            exports: 'axios'
                        }
                    }
                }))
                .pipe(uglify())
                .pipe(gulp.dest(paths.dist))
                .on('end', function () {
                    console.log("[xx:xx:xx] Finish browserify");
                    console.log("[xx:xx:xx] Cleaning the mess. Done!");
                    return gulp.src(paths.temp, {read: false})
                        .pipe(clean({force:true}));
                });
        });
});

gulp.task('default', ['set-prod', 'bower', 'scripts']);
