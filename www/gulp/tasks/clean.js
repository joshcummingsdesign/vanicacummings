module.exports = (gulp, config, del, runSequence) => {

  gulp.task('clean-dest', () => del.sync(config.project.dest));

  gulp.task('clean-views', () => del.sync(config.project.views));

  gulp.task('clean', (cb) => runSequence(['clean-dest', 'clean-views'], cb));
};
