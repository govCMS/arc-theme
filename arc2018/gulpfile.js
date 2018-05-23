'use strict';

// *************************
//
// Run 'gulp' to watch directory for changes for images, fonts icons, Sass, etc.
// Or for full site testing run 'gulp test'
//
// *************************


// Include gulp.
const gulp = require('gulp');

// Include plug-ins.
const atImport = require('postcss-import');
const autoprefixer = require('autoprefixer');
const beeper = require('beeper');
const compass = require('gulp-sass');
const cssNano = require('cssnano');
const imagemin = require('gulp-imagemin');
const modernizr = require('gulp-modernizr');
const uglify = require('gulp-uglify');
const postcss = require('gulp-postcss');
// For error handling.
const plumber = require('gulp-plumber');


// ********************************************************************************************************************************************


// Error Handling to stop file watching from dying on an error (ie: Sass compiling).
var onError = function(err) {
  beeper(3);
  console.log(err);
};

// Optimise images.
gulp.task('images', function() {
  return gulp.src('./src/img/**/*')
    .pipe(plumber({
      errorHandler: onError
    }))
    .pipe(imagemin({
      optimizationLevel: 3,
      progressive: true,
      interlaced: true,
    }))
    .pipe(gulp.dest('./img'))
});

// JS minify.
gulp.task('scripts', function() {
  return gulp.src('./src/js/*.js')
    .pipe(plumber({
      errorHandler: onError
    }))
    .pipe(uglify())
    .pipe(gulp.dest('./js/'));
});

// Modernizr
gulp.task('modernizr', function() {
  gulp.src('./src/js/*.js')
    .pipe(modernizr())
    .pipe(gulp.dest('./js/'))
});

// Compile the Sass.
gulp.task('styles', function() {
  // Register the PostCSS plugins.
  var postcssPlugins = [
    atImport,
    autoprefixer,
    cssNano,
  ];
  // The actual task.
  gulp.src('./src/sass/*.scss')
    // Error handling
    .pipe(plumber({
      errorHandler: onError
    }))
    // Compile the Sass code.
    .pipe(compass({
      sass: './src/sass'
    }))
    // If there's more than one css file outputted, merge them into one.
    // .pipe(concat('./styles.css'))
    // Optimise the CSS.
    .pipe(postcss(postcssPlugins))
    // Output to the css folder.
    .pipe(gulp.dest('./css/'))
});


// ********************************************************************************************************************************************


// Default gulp task.
gulp.task('default', ['images', 'scripts', 'modernizr', 'styles']);
