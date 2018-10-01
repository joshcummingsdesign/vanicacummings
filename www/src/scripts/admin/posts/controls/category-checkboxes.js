class CategoryCheckboxes {
  constructor() {
    this.checklistSelector = '[id$="-all"] > ul.categorychecklist';
  }

  cacheDomElements() {
    const p = new Promise(resolve => {
      this.$checklist = $(this.checklistSelector);
      resolve();
    });
    return p;
  }

  /**
   * Scroll the taxonomy checklist to a checked item.
   */
  scrollToCheckedItems() {
    this.$checklist.each((i, checklist) => {
      const $list = $(checklist);

      const $firstChecked = $list.find(':checkbox:checked').first();

      if (!$firstChecked.length) {
        return;
      }

      const posFirst = $list.find(':checkbox').position().top;
      const posChecked = $firstChecked.position().top;

      $list.closest('.tabs-panel').scrollTop(posChecked - posFirst + 5);
    });
  }

  init() {
    this.cacheDomElements().then(() => this.scrollToCheckedItems());
  }
}

export default CategoryCheckboxes;
