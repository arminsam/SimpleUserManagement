var gulp = require('gulp');
var gutil = require('gulp-util');
var sass = require('gulp-ruby-sass');
var autoprefixer = require('gulp-autoprefixer');
var notify = require('gulp-notify');

var sassDir = 'app/assets/sass';
var cssDir = 'public/css';

// sass task
gulp.task('sass', function()
{
    return sass(sassDir + '/main.scss', {style: 'compressed'}).on('error', gutil.log)
        .pipe(autoprefixer('last 5 version'))
        .pipe(gulp.dest(cssDir))
        .pipe(notify('You just got super Sassy!'));
});

// watch task
gulp.task('watch', function()
{
    gulp.watch(sassDir + '/**/*.scss', ['sass'])
})

// default task
gulp.task('default', ['sass', 'watch']);