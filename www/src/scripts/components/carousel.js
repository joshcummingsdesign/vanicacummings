import 'owl.carousel';

export default class Carousel {
  constructor($carousel, config) {
    this.$$ = {
      carousel: $carousel
    };
    this.classText = {
      dots: 'owl-dots',
      dot: 'owl-dot',
      cloned: 'cloned',
      active: 'active'
    };
    this.config = config;
    this.init();
  }

  a11y() {
    const { $$, classText } = this;
    const $dots = $$.carousel.find(`.${classText.dots}`);
    const $cloned = $$.carousel.find(`.${classText.cloned}`);
    const $dot = $dots.find(`.${classText.dot}`);

    // Give owl-dots list role
    $dots.attr('role', 'list');

    // Add aria roles to owl-dots
    $dot.each((i, el) => {
      const $this = $(el);
      $this.attr({
        role: 'tab',
        'aria-selected': false,
        'aria-label': `slide ${i + 1}`
      });
      if ($this.hasClass(classText.active)) {
        $this.attr('aria-selected', true);
      }
    });

    // Add active class to clicked nav item
    $$.carousel.on('changed.owl.carousel', () => {
      $dot.attr('aria-selected', false);
      $dot.each((i, el) => {
        const $this = $(el);
        if ($this.hasClass(classText.active)) {
          $this.attr('aria-selected', true);
        }
      });
    });

    // Hide cloned slides from screen readers
    $cloned.attr('aria-hidden', true);
  }

  init() {
    const { $$, config } = this;
    $$.carousel.owlCarousel(config);
    this.a11y();
  }
}
