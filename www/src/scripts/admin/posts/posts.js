import CategoryCheckboxes from './controls/category-checkboxes';

class Posts {
  constructor() {
    this.categoryCheckboxes = new CategoryCheckboxes();
  }

  /**
   * Initialize everything needed for posts in the admin.
   */
  init() {
    this.categoryCheckboxes.init();
  }
}

export default Posts;
