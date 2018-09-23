module.exports = (gulp, config, exec, del, plRev, isProduction, plugins, fs, replace, runSequence) => {

  gulp.task('pl-rev', () => {
    if (isProduction) {
      fs.readFile(config.rev.manifest, 'utf8', (err, data) => {
        if (err) {
          throw err;
        }
        const manifest = JSON.parse(data);
        plRev(manifest, config.patternlab.head, config.patternlab.foot, replace);
      });
    } else {
      const manifest = false;
      plRev(manifest, config.patternlab.head, config.patternlab.foot, replace);
    }
  });

  gulp.task('pl-clean', () => del.sync(config.patternlab.dest));

  gulp.task('pl-copy', () => gulp.src(config.patternlab.public)
    .pipe(gulp.dest(config.patternlab.dest)));

  gulp.task('pl-gen', (cb) => {
    exec('cd patternlab-core && php core/console --generate', (err, stdout, stderr) => {
      console.log(stdout);
      console.log(stderr);
      cb(err);
    });
  });

  gulp.task('pl-copy-layouts', () => gulp.src(config.patternlab.layouts.src)
    .pipe(gulp.dest(config.patternlab.layouts.dest)));

  gulp.task('pl-copy-atoms', () => gulp.src(config.patternlab.atoms.src)
    .pipe(gulp.dest(config.patternlab.atoms.dest)));

  gulp.task('pl-copy-molecules', () => gulp.src(config.patternlab.molecules.src)
    .pipe(gulp.dest(config.patternlab.molecules.dest)));

  gulp.task('pl-copy-organisms', () => gulp.src(config.patternlab.organisms.src)
    .pipe(gulp.dest(config.patternlab.organisms.dest)));

  gulp.task('pl-copy-templates', () => gulp.src(config.patternlab.templates.src)
    .pipe(gulp.dest(config.patternlab.templates.dest)));

  gulp.task('pl-build', (cb) => runSequence([
    'pl-gen',
    'pl-copy-layouts',
    'pl-copy-atoms',
    'pl-copy-molecules',
    'pl-copy-organisms',
    'pl-copy-templates'
  ], cb));

  gulp.task('pl-full-build', (cb) => runSequence(
    'pl-clean', 'pl-copy', 'pl-rev', 'pl-build', cb
  ));

  gulp.task('pl-watch', (cb) => runSequence('pl-build', 'reload', cb));
};
