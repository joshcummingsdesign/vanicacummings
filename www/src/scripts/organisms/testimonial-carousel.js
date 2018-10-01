import Carousel from '../components/carousel';

export default class TesimonialCarousel {
  constructor() {
    this.classText = {
      carousel: '.js-testimonial-carousel'
    };
    this.config = {
      items: 1,
      loop: true,
      nav: true
    };
  }

  cacheElements() {
    return new Promise((resolve, reject) => {
      const { classText } = this;

      this.$$ = { carousel: $(classText.carousel) };

      if (!this.$$.carousel.length) {
        reject();
      } else {
        resolve();
      }
    });
  }

  createCarousel() {
    const { $$, config } = this;
    this.carousel = new Carousel($$.carousel, config);
  }

  init() {
    this.cacheElements().then(() => this.createCarousel(), () => {});
  }
}
