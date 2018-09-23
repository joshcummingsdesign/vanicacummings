module.exports = (gulp, config, browserSync, isProduction, plugins, webpackTasks, lazypipe, runSequence) => {

  gulp.task('scripts-lint', () => gulp
    .src(config.scripts.src + config.scripts.pattern)
    .pipe(plugins.eslint())
    .pipe(plugins.eslint.format())
    .pipe(plugins.eslint.failAfterError())
  );

  gulp.task('admin-scripts', () => gulp
    .src(config.scripts.src + config.scripts.pattern)
    .pipe(webpackTasks(
      config.scripts.admin,
      config.scripts.presets,
      isProduction,
      isProduction, plugins, lazypipe
    ))
    .pipe(gulp.dest(config.scripts.dest))
  );

  gulp.task('vendor-scripts', () => gulp
    .src(config.scripts.src + config.scripts.pattern)
    .pipe(webpackTasks(
      config.scripts.vendor,
      config.scripts.presets,
      false,
      isProduction, plugins, lazypipe
    ))
    .pipe(plugins.if(isProduction, plugins.rev()))
    .pipe(gulp.dest(config.scripts.dest))
    .pipe(plugins.rev.manifest(config.rev.manifest, {
      base: config.project.dest,
      merge: true
    }))
    .pipe(gulp.dest(config.project.dest))
  );

  gulp.task('main-scripts', () => gulp
    .src(config.scripts.src + config.scripts.pattern)
    .pipe(webpackTasks(
      config.scripts.entries,
      config.scripts.presets,
      isProduction,
      isProduction, plugins, lazypipe
    ))
    .pipe(plugins.if(isProduction, plugins.rev()))
    .pipe(gulp.dest(config.scripts.dest))
    .pipe(browserSync.stream())
    .pipe(plugins.rev.manifest(config.rev.manifest, {
      base: config.project.dest,
      merge: true
    }))
    .pipe(gulp.dest(config.project.dest))
  );

  gulp.task('scripts', (cb) => {
    runSequence(
      'scripts-lint', 'admin-scripts', 'vendor-scripts', 'main-scripts', cb
    );
  });

  gulp.task('admin-scripts-watch', (cb) => {
    runSequence('scripts-lint', 'admin-scripts', cb);
  });

  gulp.task('scripts-watch', (cb) => {
    runSequence('scripts-lint', 'main-scripts', cb);
  });
};
