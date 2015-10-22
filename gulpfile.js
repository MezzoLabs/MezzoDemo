var gulp = require('gulp');
var elixir = require('laravel-elixir');
var ngRegister = require('gulp-ng-register');
var ngTemplates = require('gulp-angular-templatecache');

gulp.task('register', function(){
    return gulp.src('resources/assets/js/**/*.{controller,directive,service}.js')
        .pipe(ngRegister())
        .pipe(gulp.dest('resources/assets/js'));
});

gulp.task('templates', function(){
    return gulp.src('resources/assets/js/**/*.html')
        .pipe(ngTemplates({standalone: true}))
        .pipe(gulp.dest('public/mezzolabs/mezzo/cockpit/js'));
});

/*
 |--------------------------------------------------------------------------
 | Elixir Asset Management
 |--------------------------------------------------------------------------
 |
 | Elixir provides a clean, fluent API for defining some basic Gulp tasks
 | for your Laravel application. By default, we are compiling the Sass
 | file for our application, as well as publishing vendor resources.
 |
 */

elixir(function(mix) {
    mix
        .task('register', 'resources/assets/js**/*.{controller,directive,service}.js')
        .task('templates', 'resources/assets/js/**/*.html')
        .sass('app.scss', 'public/mezzolabs/mezzo/cockpit/css')
        .browserify('app.js', 'public/mezzolabs/mezzo/cockpit/js')
        .browserSync({
            proxy: 'mezzo.dev',
            files: 'public/**/*',
            open: false
        });
});
