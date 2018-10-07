export default class MainMenu {
  constructor() {
    this.namespace = 'js-main-menu';
    this.classText = {
      menu: `#${this.namespace}`,
      toggle: `#${this.namespace}__toggle`,
      nav: `#${this.namespace}__nav`,
      isOpen: 'is-menu-open'
    };
  }

  cacheElements() {
    return new Promise((resolve, reject) => {
      const { classText } = this;

      this.$$ = { menu: $(classText.menu) };

      if (!this.$$.menu.length) {
        reject();
      } else {
        this.$$.window = $(window);
        this.$$.document = $(document);
        this.$$.html = $('html');
        this.$$.toggle = this.$$.menu.find(classText.toggle);
        this.$$.nav = this.$$.menu.find(classText.nav);
        resolve();
      }
    });
  }

  open() {
    const { $$, classText } = this;
    $$.html.addClass(classText.isOpen);
    $$.toggle.attr('aria-expanded', true);
  }

  close() {
    const { $$, classText } = this;
    $$.html.removeClass(classText.isOpen);
    $$.toggle.attr('aria-expanded', false);
  }

  isOpen() {
    const { $$, classText } = this;
    return $$.html.hasClass(classText.isOpen);
  }

  bindings() {
    const { $$, namespace } = this;

    $$.toggle.on(`click.${namespace}`, e => {
      e.preventDefault();
      if (this.isOpen()) {
        this.close();
      } else {
        this.open();
      }
    });

    // Esc key
    $$.document.on(`keyup.${namespace}`, e => {
      if (e.keyCode === 27) {
        this.close();
      }
    });

    $$.window.on(`resize.${namespace}`, () => {
      this.close();
    });
  }

  init() {
    this.cacheElements().then(() => this.bindings(), () => {});
  }
}
