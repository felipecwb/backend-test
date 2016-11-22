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
    temp: './public/js/tmp',
    vendor: './public/static/vendor',
    dist: './public/static/js/'
}

gulp.task('bower', function () {
    bower({cmd: 'install', directory: paths.vendor});
});

// WATCH
gulp.task('watch', function w() {
    return gulp.watch(paths.JS, ['scripts']);
});

gulp.task('jsx', function () {
    return gulp.src(paths.JS)
        .pipe(babel({presets: ['react', 'es2015']}))
        .pipe(gulp.dest(paths.temp));
});

gulp.task('scripts', ['jsx'], function () {
    return gulp.src(paths.temp + '/index.js')
        .pipe(browserify({
            shim: {
                react: {
                    path: paths.vendor + '/react/react.min.js',
                    exports: 'React'
                },
                reactDOM: {
                    path: paths.vendor + '/react/react-dom.min.js',
                    exports: 'ReactDOM'
                },
                jQuery: {
                    path: paths.vendor + '/jquery/dist/jquery.min.js',
                    exports: 'jQuery'
                }
            }
        }))
        .pipe(uglify())
        .pipe(gulp.dest(paths.dist))
        .on('end', function () {
            return gulp.src(paths.temp, {read: false})
                        .pipe(clean({force:true}));
        });
});

gulp.task('default', ['bower', 'scripts']);
