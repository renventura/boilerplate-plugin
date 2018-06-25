// Style related.
var styleSRC                = './assets/css/sass/*.scss'; // Path to .scss files.
var styleDestination        = './assets/css/'; // Path to place the compiled CSS file.

// JS Vendor related.
var jsVendorsSRC             = './assets/js/vendors/*.js'; // Path to JS vendor folder.
var jsVendorsDestination     = './assets/js/'; // Path to place the compiled JS vendors file.
var jsVendorsFile            = 'vendors'; // Compiled JS vendors file name.
// Default set to vendors i.e. vendors.js.

// JS Custom related.
var jsCustomSRC             = './assets/js/custom/*.js'; // Path to JS custom scripts folder.
var jsCustomDestination     = './assets/js/'; // Path to place the compiled JS custom scripts file.
var jsCustomFile            = 'custom'; // Compiled JS custom file name.
// Default set to custom i.e. custom.js.

// Translation related.
var text_domain             = '%TEXT_DOMAIN%'; // Your textdomain here.
var translationFile         = '%PLUGIN_KEY%.pot'; // Name of the transalation file.
var translationDestination  = './languages'; // Where to save the translation files.
var packageName             = '%PLUGIN_KEY%'; // Package name.
var bugReport               = '%AUTHOR_URI%'; // Where can users report bugs.
var lastTranslator          = '%PLUGIN_AUTHOR% <%AUTHOR_EMAIL%>'; // Last translator Email ID.
var team                    = '%PLUGIN_AUTHOR% <%AUTHOR_EMAIL%>'; // Team's Email ID.

// Files to watch
var stylesWatchFiles        = './assets/css/sass/partials/*.scss'; // Path to all Sass partials.
var vendorsJSWatchFiles     = './assets/js/vendor/*.js'; // Path to all vendor JS files.
var customJSWatchFiles      = './assets/js/custom/*.js'; // Path to all custom JS files.
var projectPHPWatchFiles    = './**/*.php'; // Path to all PHP files.

/**
 * Load Plugins.
 */
var gulp         = require('gulp'); // Gulp of-course

// CSS related plugins.
var sass         = require('gulp-sass'); // Gulp pluign for Sass compilation.
var minifycss    = require('gulp-uglifycss'); // Minifies CSS files.
var autoprefixer = require('gulp-autoprefixer'); // Autoprefixing magic.

// JS related plugins.
var concat       = require('gulp-concat'); // Concatenates JS files
var uglify       = require('gulp-uglify'); // Minifies JS files


// Utility related plugins.
var rename       = require('gulp-rename'); // Renames files E.g. style.css -> style.min.css
var lineec       = require('gulp-line-ending-corrector'); // Consistent Line Endings for non UNIX systems. Gulp Plugin for Line Ending Corrector (A utility that makes sure your files have consistent line endings)
var notify       = require('gulp-notify'); // Sends message notification to you
var wpPot        = require('gulp-wp-pot'); // For generating the .pot file.
var sort         = require('gulp-sort'); // Recommended to prevent unnecessary changes in pot-file.


// Browsers you care about for autoprefixing.
// Browserlist https        ://github.com/ai/browserslist
const AUTOPREFIXER_BROWSERS = [
    'last 2 version'
];


/**
 * Task: `styles`.
 *
 * Compiles Sass, Autoprefixes it and Minifies CSS.
 *
 * This task does the following:
 *    1. Gets the source scss file
 *    2. Compiles Sass to CSS
 *    3. Autoprefixes it and generates style.css
 *    4. Renames the CSS file with suffix .min.css
 *    5. Minifies the CSS file and generates .min.css
 */
gulp.task('styles', function() {
  gulp.src( styleSRC )
  .pipe( sass( {
    errLogToConsole: true,
    // outputStyle: 'compact',
    outputStyle: 'compressed',
    // outputStyle: 'nested',
    // outputStyle: 'expanded',
    precision: 10
  } ) )
  .on('error', console.error.bind(console))
  .pipe( autoprefixer( AUTOPREFIXER_BROWSERS ) )
  .pipe( rename( { suffix: '.min' } ) )
  .pipe( minifycss( {
    maxLineLen: 0
  }))
  .pipe( gulp.dest( styleDestination ) )
  .pipe( notify( { message: 'TASK: "styles" Completed! 💯', onLast: true } ) )
});


/**
 * Task: `vendorsJS`.
 *
 * Concatenate and uglify vendor JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS vendor files
 *     2. Concatenates all the files and generates vendors.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates vendors.min.js
 */
gulp.task( 'vendorsJS', function() {
 gulp.src( jsVendorsSRC )
   .pipe( concat( jsVendorsFile + '.js' ) )
   // .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
   // .pipe( gulp.dest( jsVendorsDestination ) )
   .pipe( rename( {
     basename: jsVendorsFile,
     suffix: '.min'
   }))
   .pipe( uglify() )
   .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
   .pipe( gulp.dest( jsVendorsDestination ) )
   .pipe( notify( { message: 'TASK: "vendorsJS" Completed! 💯', onLast: true } ) );
});


/**
 * Task: `customJS`.
 *
 * Concatenate and uglify custom JS scripts.
 *
 * This task does the following:
 *     1. Gets the source folder for JS custom files
 *     2. Concatenates all the files and generates custom.js
 *     3. Renames the JS file with suffix .min.js
 *     4. Uglifes/Minifies the JS file and generates custom.min.js
 */
gulp.task( 'customJS', function() {
   gulp.src( jsCustomSRC )
   .pipe( concat( jsCustomFile + '.js' ) )
   // .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
   // .pipe( gulp.dest( jsCustomDestination ) )
   .pipe( rename( {
     basename: jsCustomFile,
     suffix: '.min'
   }))
   .pipe( uglify() )
   .pipe( lineec() ) // Consistent Line Endings for non UNIX systems.
   .pipe( gulp.dest( jsCustomDestination ) )
   .pipe( notify( { message: 'TASK: "customJs" Completed! 💯', onLast: true } ) );
});


/**
 * WP POT Translation File Generator.
 *
 * * This task does the following:
 *     1. Gets the source of all the PHP files
 *     2. Sort files in stream by path or any custom sort comparator
 *     3. Applies wpPot with the variable set at the top of this file
 *     4. Generate a .pot file of i18n that can be used for l10n to build .mo file
 */
gulp.task( 'pot', function () {
    return gulp.src( projectPHPWatchFiles )
        .pipe(sort())
        .pipe(wpPot( {
            domain        : text_domain,
            package       : packageName,
            bugReport     : bugReport,
            lastTranslator: lastTranslator,
            team          : team
        } ))
       .pipe(gulp.dest(translationDestination + '/' + translationFile ))
       .pipe( notify( { message: 'TASK: "pot" Completed! 💯', onLast: true } ) )
});


/**
 * Watch Tasks.
 *
 * Watches for file changes and runs specific tasks.
 */
gulp.task( 'default', ['styles', 'customJS', 'vendorsJS'], function () {
  gulp.watch( stylesWatchFiles, [ 'styles' ] );
  gulp.watch( vendorsJSWatchFiles, [ 'vendorsJS' ] );
  gulp.watch( customJSWatchFiles, [ 'customJS' ] );
});