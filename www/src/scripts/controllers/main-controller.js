import TestimonialCarousel from '../organisms/testimonial-carousel';

export default class MainController {
  constructor() {
    this.testimonialCarousel = new TestimonialCarousel();
  }

  init() {
    this.testimonialCarousel.init();
  }
}
