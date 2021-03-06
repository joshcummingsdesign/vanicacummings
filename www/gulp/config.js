module.exports = (() => {
  // NAMES
  const names = {
    theme: 'vanicacummings',
    plugin: 'vanicacummings'
  };

  // DIR
  const dir = {
    path: './html'
  };

  // CONTENT
  const content = {
    path: `${dir.path}/wp-content`
  };

  // PROJECT
  const project = {
    src: './src',
    dest: `${content.path}/themes/${names.theme}/dist`,
    theme: `${content.path}/themes/${names.theme}`,
    views: `${content.path}/themes/${names.theme}/views`,
    plugin: `${content.path}/plugins/${names.plugin}`
  };

  // PATTERN LAB
  const patternlab = {
    src: `${project.src}/patternlab`,
    dest: `${dir.path}/patternlab`,
    public: './patternlab-core/public/**/*',
    head: [`${project.src}/patternlab/_layouts/includes/l-head.twig`, `${project.src}/patternlab/_meta/_01-foot.twig`],
    foot: [
      `${project.src}/patternlab/_layouts/includes/l-scripts.twig`,
      `${project.src}/patternlab/_meta/_01-foot.twig`
    ],
    layouts: {
      src: `${project.src}/patternlab/_layouts/**/*.twig`,
      dest: `${project.views}/layouts`
    },
    atoms: {
      src: `${project.src}/patternlab/_patterns/00-atoms/**/*.twig`,
      dest: `${project.views}/atoms`
    },
    molecules: {
      src: `${project.src}/patternlab/_patterns/01-molecules/**/*.twig`,
      dest: `${project.views}/molecules`
    },
    organisms: {
      src: `${project.src}/patternlab/_patterns/02-organisms/**/*.twig`,
      dest: `${project.views}/organisms`
    },
    templates: {
      src: `${project.src}/patternlab/_patterns/03-templates/**/*.twig`,
      dest: `${project.views}/templates`
    }
  };

  // REV
  const rev = {
    manifest: `${project.dest}/rev-manifest.json`
  };

  // SCRIPTS
  const scripts = {
    src: `${project.src}/scripts`,
    dest: `${project.dest}/scripts`,
    adminWatch: `${project.src}/scripts/admin`,
    watch: [`${project.src}/scripts`, `!${project.src}/scripts/admin`],
    pattern: '/**/*.js',
    presets: [
      [
        'env',
        {
          targets: {
            browsers: ['last 2 versions']
          }
        }
      ]
    ],
    vendor: {
      vendor: ['babel-polyfill']
    },
    admin: {
      admin: `${project.src}/scripts/admin/admin.js`
    },
    entries: {
      app: `${project.src}/scripts/app.js`
    }
  };

  // STYLES
  const styles = {
    src: `${project.src}/styles`,
    dest: `${project.dest}/styles`,
    pattern: '/**/*.{sass,scss}'
  };

  // FONTS
  const fonts = {
    src: `${project.src}/fonts`,
    dest: `${project.dest}/fonts`,
    pattern: '/**/*.{eot,svg,ttf,woff,woff2,otf}'
  };

  // IMAGES
  const images = {
    src: `${project.src}/images`,
    dest: `${project.dest}/images`,
    pattern: '/**/*.{gif,ico,jpeg,jpg,png,svg,webp}'
  };

  // SERVER
  const server = {
    proxy: 'https://localhost',
    whitelist: ['/wp-admin/admin-ajax.php'],
    blacklist: ['/wp-admin/**']
  };

  return {
    names: names,
    dir: dir,
    content: content,
    project: project,
    patternlab: patternlab,
    rev: rev,
    scripts: scripts,
    styles: styles,
    fonts: fonts,
    images: images,
    server: server
  };
})();
