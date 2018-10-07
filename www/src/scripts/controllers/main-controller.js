import TestimonialCarousel from '../organisms/testimonial-carousel';
import MainLayout from '../layout/main-layout';

export default class MainController {
  constructor() {
    this.testimonialCarousel = new TestimonialCarousel();
    this.mainLayout = new MainLayout();
  }

  init() {
    this.testimonialCarousel.init();
    this.mainLayout.init();
  }
}
