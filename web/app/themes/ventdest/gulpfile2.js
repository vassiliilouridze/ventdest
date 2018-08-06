// Requires
var gulp = require('gulp');

// Include plugins
var plumber = require('gulp-plumber');
var sass = require('gulp-sass');
// var sassGlob = require('gulp-sass-glob');
var concat = require('gulp-concat');
var uglify = require('gulp-uglify');
var minify = require('gulp-minify-css');
var uncss = require('gulp-uncss');
var autoprefixer = require('gulp-autoprefixer');
var critical = require('critical').stream;
var rename = require('gulp-rename');
var imagemin = require('gulp-imagemin');
var gulpsync = require('gulp-sync')(gulp);
var livereload = require('gulp-livereload');

// Paths
var source = ['http:\/\/localhost/exit', 'http:\/\/localhost/exit/contact', 'http:\/\/localhost/exit/realisations'];

// Tâche "sass" = SASS
gulp.task('sass', function() {
  return gulp.src('assets/sass/style.scss')
    // .pipe(sassGlob())
    .pipe(sass().on('error', sass.logError))
    .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
    // .pipe(minify())
    // .pipe(rename({ suffix: '.min' }))
    .pipe(gulp.dest('./'))
    .pipe(livereload());
});

// Tâche "styles" = autoprefixer + unCSS + minify + rename
// gulp.task('styles', ['compass'], function(){
//   return gulp.src('assets/style.css')
//   .pipe(autoprefixer('last 2 version', 'safari 5', 'ie 7', 'ie 8', 'ie 9', 'opera 12.1', 'ios 6', 'android 4'))
//   .pipe(minify())
//   .pipe(rename({ suffix: '.min' }))
//   .pipe(gulp.dest('./'));
//   });

// Tâche "critical" = critical inline CSS
gulp.task('critical', function() {
  return  gulp.src(source)
    .pipe(critical({
      base: prod,
      inline: true,
      width: 320,
      height: 480,
      minify: true
    }))
    .pipe(gulp.dest(prod));
});

gulp.task('js', function() {
  return gulp.src('./assets/js/*.js')
    .pipe(uglify())
    .pipe(concat('site.js'))
    .pipe(gulp.dest('./js'))
    .pipe(livereload());
});

// Tâche "fonts" = déplacer les fichiers
gulp.task('fonts', function() {
  return gulp.src('assets/fonts/*')
    .pipe(gulp.dest('fonts/'));
});

// Tâche "img" = Images optimisées
gulp.task('img', function () {
  return gulp.src('assets/img/*.{png,jpg,jpeg,gif,svg}')
    .pipe(imagemin())
    .pipe(gulp.dest('./img'));
});

// Tâche "prod" = toutes les tâches ensemble
gulp.task('prod', gulpsync.sync(['styles', 'fonts','img']));

// Tâche "watch" = je surveille SASS et js
gulp.task('watch', function () {
  livereload.listen();
  gulp.watch('assets/sass/**/*.scss', ['sass']);
  // gulp.watch('assets/js/**/*.js', ['js']);
});

// Default task
gulp.task('default', ['sass']);
