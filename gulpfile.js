'use strict';

var compassOptions = require('compass-options'),
  path = require('path');

var options = {},
  compass;

// #############################
// Edit these paths and options.
// #############################

// The subTheme that gulp compiles Sass from.
// Change this to your custom sub-subTheme.
var compiledTheme = '/app/profiles/agov/themes/agov/agov_whitlam/';

// The root paths are used to construct all the other paths in this
// configuration. The "project" root path is where this gulpfile.js is located.
// While Zen distributes this in the theme root folder, you can also put this
// (and the package.json) in your project's root folder and edit the paths
// accordingly.
options.rootPath = {
  project     : __dirname + '/',
  web         : __dirname + '/app/',
  baseTheme   : __dirname + '/app/profiles/agov/themes/agov/agov_base/',
  styleGuide  : __dirname + '/app/profiles/agov/styleguide/',
  subTheme    : __dirname + compiledTheme
};

// Define the paths in the Drupal subTheme by getting subTheme sub-directories from
// Compass' config.rb.
// @TODO Remove our dependency on Compass once libSass is more feature rich.
compass = compassOptions.dirs({'config': options.rootPath.subTheme + 'config.rb'});

options.baseTheme = {
  root  : options.rootPath.baseTheme,
  css   : options.rootPath.baseTheme + compass.css + '/',
  sass  : options.rootPath.baseTheme + compass.sass + '/',
  js    : options.rootPath.baseTheme + compass.js + '/'
};

options.subTheme = {
  root  : options.rootPath.subTheme,
  css   : options.rootPath.subTheme + compass.css + '/',
  sass  : options.rootPath.subTheme + compass.sass + '/',
  js    : options.rootPath.subTheme + compass.js + '/'
};

// Define the style guide paths and options.
options.styleGuide = {
  source: [
    options.baseTheme.sass,
    options.baseTheme.css + 'style-guide/',
    options.subTheme.sass
  ],
  destination: options.rootPath.styleGuide,

  // The css and js paths are URLs, like '/misc/jquery.js'.
  // The following paths are relative to the generated style guide.
  css: [
    path.relative(options.rootPath.styleGuide, options.baseTheme.css + 'styles.css'),
    path.relative(options.rootPath.styleGuide, options.subTheme.css + 'styles.css'),
    path.relative(options.rootPath.styleGuide, options.baseTheme.css + 'style-guide/chroma-kss-styles.css'),
    path.relative(options.rootPath.styleGuide, options.baseTheme.css + 'style-guide/kss-only.css')
  ],
  js: [
    '/core/assets/vendor/jquery/jquery.min.js',
    path.relative(options.rootPath.styleGuide, options.baseTheme.sass + 'components/primary-navigation/primary-navigation.js'),
    path.relative(options.rootPath.styleGuide, options.subTheme.js + 'script.js')
  ],

  homepage: 'homepage.md',
  title: 'aGov Style Guide'
};

// Define the path to the project's .scss-lint.yml.
options.scssLint = {
  yml: options.rootPath.project + '.scss-lint.yml'
};

// Define the paths to the JS files to lint.
options.eslint = {
  files  : [
    options.subTheme.js + '**/*.js',
    'app/sites/all/modules/custom/**/*.js',
    'app/sites/all/modules/features/**/*.js',
    '!' + options.subTheme.js + '**/*.min.js',
    '!app/sites/all/modules/custom/**/*.min.js',
    '!app/sites/all/modules/features/**/*.min.js'
  ]
};

// If your files are on a network share, you may want to turn on polling for
// Gulp and Compass watch commands. Since polling is less efficient, we disable
// polling by default.
var enablePolling = true;
if (!enablePolling) {
  options.compassPollFlag = '';
  options.gulpWatchOptions = {};
} else {
  options.compassPollFlag = ' --poll';
  options.gulpWatchOptions = {interval: 1000, mode: 'poll'};
}

// ################################
// Load Gulp and tools we will use.
// ################################
var gulp      = require('gulp'),
  $           = require('gulp-load-plugins')(),
  del         = require('del'),
  runSequence = require('run-sequence');

// The default task.
gulp.task('default', ['build']);

// #################
// Build everything.
// #################
gulp.task('build', ['styles:production', 'styleguide'], function (cb) {
  // Run linting last, otherwise its output gets lost.
  runSequence(['lint'], cb);
});

// ##########
// Build CSS.
// ##########
gulp.task('styles', ['clean:css'], $.shell.task(
  ['bundle exec compass compile --time --sourcemap --output-style expanded'],
  {cwd: options.subTheme.root}
));

gulp.task('styles:production', ['clean:css'], $.shell.task(
  ['bundle exec compass compile --time --no-sourcemap --output-style compressed'],
  {cwd: options.subTheme.root}
));

gulp.task('styles:base-theme', ['clean:base-theme-css'], $.shell.task(
  ['bundle exec compass compile --time --no-sourcemap --output-style compressed'],
  {cwd: options.baseTheme.root}
));

// ##################
// Build style guide.
// ##################
var flags = [], values;
// Construct our command-line flags from the options.styleGuide object.
for (var flag in options.styleGuide) {
  if (options.styleGuide.hasOwnProperty(flag)) {
    values = options.styleGuide[flag];
    if (!Array.isArray(values)) {
      values = [values];
    }
    for (var i = 0; i < values.length; i++) {
      flags.push('--' + flag + '=\'' + values[i] + '\'');
    }
  }
}
gulp.task('styleguide', ['clean:styleguide', 'styleguide:chroma-kss-markup'], $.shell.task(
  ['kss-node <%= flags %>'],
  {templateData: {flags: flags.join(' ')}}
));

gulp.task('styleguide:chroma-kss-markup', $.shell.task(
  [
    // @TODO: mkdir and head are UNIX utils. Replace this after Chroma is refactored.
    'mkdir -p ' + options.baseTheme.css + 'style-guide/',
    'bundle exec sass --no-cache --compass --scss --sourcemap=none --style expanded ' + options.baseTheme.sass + 'style-guide/chroma-kss-markup.scss ' + options.baseTheme.css + 'style-guide/chroma-kss-markup.hbs.tmp',
    'head -n 2  ' + options.baseTheme.css + 'style-guide/chroma-kss-markup.hbs.tmp | tail -n 1 > ' + options.baseTheme.css + 'style-guide/chroma-kss-markup.hbs',
    'rm ' + options.baseTheme.css + 'style-guide/chroma-kss-markup.hbs.tmp'
  ],
  {cwd: options.subTheme.root}
));

// Debug the generation of the style guide with the --verbose flag.
gulp.task('styleguide:debug', ['clean:styleguide', 'styleguide:chroma-kss-markup'], $.shell.task(
  ['kss-node <%= flags %>'],
  {templateData: {flags: flags.join(' ') + ' --verbose'}}
));

// #########################
// Lint Sass and JavaScript.
// #########################
gulp.task('lint', function (cb) {
  runSequence(['lint:js', 'lint:sass'], cb);
});

// Lint JavaScript.
gulp.task('lint:js', function () {
  return gulp.src(options.eslint.files)
    .pipe($.eslint())
    .pipe($.eslint.format());
});

// Lint JavaScript and throw an error for a CI to catch.
gulp.task('lint:js-with-fail', function () {
  return gulp.src(options.eslint.files)
    .pipe($.eslint())
    .pipe($.eslint.format())
    .pipe($.eslint.failOnError());
});

// Lint Sass.
gulp.task('lint:sass', function() {
  return gulp.src(options.subTheme.sass + '**/*.scss')
    .pipe($.scssLint({'bundleExec': true, 'config': options.scssLint.yml}));
});

// Lint Sass and throw an error for a CI to catch.
gulp.task('lint:sass-with-fail', function() {
  return gulp.src(options.subTheme.sass + '**/*.scss')
    .pipe($.scssLint({'bundleExec': true, 'config': options.scssLint.yml}))
    .pipe($.scssLint.failReporter());
});

// ##############################
// Watch for changes and rebuild.
// ##############################
gulp.task('watch', ['watch:lint-and-styleguide', 'watch:js'], function (cb) {
  // Since watch:css will never return, call it last (not as dependency.)
  runSequence(['watch:css'], cb);
});

gulp.task('watch:css', ['clean:css'], $.shell.task(
  // The "watch:css" task CANNOT be used in a dependency, because this task will
  // never end as "compass watch" never completes and returns.
  ['bundle exec compass watch --time --sourcemap --output-style expanded' + options.compassPollFlag],
  {cwd: options.subTheme.root}
));

gulp.task('watch:lint-and-styleguide', ['styleguide', 'lint:sass'], function() {
  return gulp.watch([
      options.subTheme.sass + '**/*.scss',
      options.subTheme.sass + '**/*.hbs'
    ], options.gulpWatchOptions, ['styleguide', 'lint:sass']);
});

gulp.task('watch:js', ['lint:js'], function() {
  return gulp.watch(options.eslint.files, options.gulpWatchOptions, ['lint:js']);
});

// ######################
// Clean all directories.
// ######################
gulp.task('clean', ['clean:css', 'clean:styleguide']);

// Clean style guide files.
gulp.task('clean:styleguide', function() {
  // You can use multiple globbing patterns as you would with `gulp.src`
  return del([
      options.styleGuide.destination + '*.html',
      options.styleGuide.destination + 'public',
      options.subTheme.css + '**/*.hbs'
    ], {force: true});
});

// Clean Base Theme CSS files.
gulp.task('clean:base-theme-css', function() {
  return del([
    options.baseTheme.root + '**/.sass-cache',
    options.baseTheme.css + '**/*.css',
    options.baseTheme.css + '**/*.map'
  ], {force: true});
});

// Clean CSS files.
gulp.task('clean:css', function() {
  return del([
      options.subTheme.root + '**/.sass-cache',
      options.subTheme.css + '**/*.css',
      options.subTheme.css + '**/*.map'
    ], {force: true});
});


// Resources used to create this gulpfile.js:
// - https://github.com/google/web-starter-kit/blob/master/gulpfile.js
// - https://github.com/north/generator-north/blob/master/app/templates/Gulpfile.js
