// Node modules
const argv = require('minimist')(process.argv.slice(2));
const browserSync = require('browser-sync').create();
const del = require('del');
const exec = require('child_process').exec;
const fs = require('fs');
const gulp = require('gulp');
const lazypipe = require('lazypipe');
const replace = require('replace');
const runSequence = require('run-sequence');

// Autoload gulp plugins from npm
const plugins = require('gulp-load-plugins')({
  overridePattern: false,
  camelize: true,
  pattern: ['webpack*', 'gulp-*', 'gulp.*']
});

// Configuration
const config = require('./gulp/config');
const isProduction = argv.production;

// Gulp utilities
const webpackTasks = require('./gulp/utilities/webpack-tasks');
const plRev = require('./gulp/utilities/patternlab-rev');

// Gulp tasks
require('./gulp/tasks/reload')(gulp, browserSync);
require('./gulp/tasks/clean')(gulp, config, del, runSequence);
require('./gulp/tasks/scripts')(gulp, config, browserSync, isProduction, plugins, webpackTasks, lazypipe, runSequence);
require('./gulp/tasks/styles')(gulp, config, browserSync, isProduction, plugins);
require('./gulp/tasks/fonts')(gulp, config, plugins, runSequence);
require('./gulp/tasks/images')(gulp, config, plugins, runSequence);
require('./gulp/tasks/patternlab')(gulp, config, exec, del, plRev, isProduction, plugins, fs, replace, runSequence);

// Serve the app and start watching
gulp.task('watch', () => {
  browserSync.init({
    proxy: config.server.proxy,
    snippetOptions: {
      whitelist: config.server.whitelist,
      blacklist: config.server.blacklist
    },
    open: false
  });
  plugins.watch(`${config.content.path}/**/*.php`, () => gulp.start('reload'));
  plugins.watch(config.scripts.adminWatch, () => gulp.start('admin-scripts-watch'));
  plugins.watch(config.scripts.watch, () => gulp.start('scripts-watch'));
  plugins.watch(config.styles.src, () => gulp.start('styles'));
  plugins.watch(config.fonts.src, () => gulp.start('fonts-watch'));
  plugins.watch(config.images.src, () => gulp.start('images-watch'));
  plugins.watch(config.patternlab.src, () => gulp.start('pl-watch'));
});

// The default gulp task which compiles everything
gulp.task('default', cb => {
  runSequence('clean', 'styles', ['scripts', 'fonts', 'images'], 'pl-full-build', cb);
});
