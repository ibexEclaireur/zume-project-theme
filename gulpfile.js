require('dotenv').config();

// Grab our gulp packages
var gulp  = require('gulp'),
    gutil = require('gulp-util'),
    sass = require('gulp-sass'),
    cssnano = require('gulp-cssnano'),
    autoprefixer = require('gulp-autoprefixer'),
    sourcemaps = require('gulp-sourcemaps'),
    jshint = require('gulp-jshint'),
    stylish = require('jshint-stylish'),
    uglify = require('gulp-uglify'),
    concat = require('gulp-concat'),
    rename = require('gulp-rename'),
    plumber = require('gulp-plumber'),
    bower = require('gulp-bower'),
    babel = require('gulp-babel'),
    browserSync = require('browser-sync').create();

// Compile Sass, Autoprefix and minify
gulp.task('styles', function() {
    return gulp.src('./assets/scss/**/*.scss')
        .pipe(plumber(function(error) {
            gutil.log(gutil.colors.red(error.message));
            this.emit('end');
        }))
        .pipe(sourcemaps.init()) // Start Sourcemaps
        .pipe(sass())
        .pipe(autoprefixer({
            browsers: ['last 2 versions'],
            cascade: false
        }))
        .pipe(rename({suffix: '.min'}))
        .pipe(cssnano())
        .pipe(sourcemaps.write('.')) // Creates sourcemaps for minified styles
        .pipe(gulp.dest('./assets/css/'))
});

// JSHint, concat, and minify JavaScript
gulp.task('site-js', function() {
  return gulp.src([

           // Grab your custom scripts
  		  './assets/js/scripts/*.js'

  ])
    .pipe(plumber())
    .pipe(sourcemaps.init())
    .pipe(jshint())
    .pipe(jshint.reporter('jshint-stylish'))
    .pipe(concat('scripts.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(sourcemaps.write('.')) // Creates sourcemap for minified JS
    .pipe(gulp.dest('./assets/js'))
});

// JSHint, concat, and minify Foundation JavaScript
gulp.task('foundation-js', function() {
  return gulp.src([

  		  // Foundation core - needed if you want to use any of the components below
          './dependencies/foundation-sites/dist/js/plugins/foundation.core.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.util.*.js',

          /* We do not want to load foundation.util.timerAndImageLoader.js .
           * This is because it appends a question mark and a timestamp to
           * image URLs, which causes images hosted on Gravatar to fail. In a
           * comment, it says that it is trying to follow this technique:
           *
           * https://css-tricks.com/snippets/jquery/fixing-load-in-ie-for-cached-images/
           *
           * Newer versions of foundation-sites don't have this file any more,
           * and I presume they don't have this bug any more, we should
           * probably update foundation-sites at some point.
           *
           * https://github.com/zurb/foundation-sites
           *
           * Note the exclamation point, which indicates negation.
           */
          // '!./dependencies/foundation-sites/js/foundation.util.timerAndImageLoader.js',

          // Pick the components you need in your project
          './dependencies/foundation-sites/dist/js/plugins/foundation.abide.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.accordion.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.accordionMenu.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.drilldown.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.dropdown.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.dropdownMenu.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.equalizer.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.interchange.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.magellan.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.offcanvas.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.orbit.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.responsiveMenu.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.responsiveToggle.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.reveal.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.slider.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.sticky.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.tabs.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.toggler.js',
          './dependencies/foundation-sites/dist/js/plugins/foundation.tooltip.js',
  ])
  .pipe(sourcemaps.init())
	.pipe(babel({
		presets: ['es2015'],
	    compact: true
	}))
    .pipe(concat('foundation.js'))
    .pipe(rename({suffix: '.min'}))
    .pipe(uglify())
    .pipe(sourcemaps.write('.')) // Creates sourcemap for minified Foundation JS
    .pipe(gulp.dest('./assets/js'))
});

// Update Foundation with Bower and save to /dependencies
gulp.task('bower', function() {
  return bower({ cmd: 'update'})
    .pipe(gulp.dest('dependencies/'))
});

// Browser-Sync watch files and inject changes
gulp.task('browsersync', ['styles', 'site-js', 'foundation-js'], function() {
    // Watch files
    var files = [
    	'./assets/css/*.css',
    	'./assets/js/*.js',
      './assets/js/scripts/*.js',
    	'./assets/scss/*.scss',
    	'**/*.php',
    	'assets/images/**/*.{png,jpg,gif,svg,webp}',
    ];

    browserSync.init(files, {
	    // Replace with URL of your local site
	    proxy: process.env.BROWSERSYNC_PROXIED_SITE || "http://zume:8888/",
    });

    gulp.watch('./assets/scss/**/*.scss', ['styles']);
    gulp.watch('./assets/js/scripts/*.js', ['site-js']).on('change', browserSync.reload);

});

// Watch files for changes (without Browser-Sync)
gulp.task('watch', function() {

  // Watch .scss files
  gulp.watch('./assets/scss/**/*.scss', ['styles']);

  // Watch site-js files
  gulp.watch('./assets/js/scripts/*.js', ['site-js']);

  // Watch foundation-js files
  gulp.watch('./dependencies/foundation-sites/js/*.js', ['foundation-js']);

});

// Run styles, site-js and foundation-js
gulp.task('default', function() {
  gulp.start('styles', 'site-js', 'foundation-js');
});
