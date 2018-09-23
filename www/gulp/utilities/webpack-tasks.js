module.exports = (entries, presets, compact, isProduction, plugins, lazypipe) =>
  lazypipe()
    .pipe(plugins.webpackStream, {
      cache: true,
      entry: entries,
      output: {
        filename: '[name].js'
      },
      module: {
        loaders: [
          {
            test: /\.js$/,
            loader: 'babel-loader',
            exclude: /tests/,
            query: {
              presets: presets,
              cacheDirectory: true,
              compact: compact
            }
          }
        ]
      },
      devtool: isProduction ? false : 'eval-source-map',
      plugins: [
        new plugins.webpackStream.webpack.ProvidePlugin({
          $: 'jquery',
          jQuery: 'jquery'
        }),
        new plugins.webpack.optimize.UglifyJsPlugin({
          compressor: {warnings: false},
          output: {comments: false}
        })
      ]
    })();
