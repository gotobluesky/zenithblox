(function ($) {
  "use strict";

  $(document).ready(function () {
    const delay = () => {
      return new Promise((resolve) => {
        setTimeout(() => {
          resolve();
        }, 1000);
      });
    };

    sortable.onSortCompleted(async (event, ui) => {
      await delay();
      let parent_id = ui.item.getParent().attr("id");
      let id = ui.item.attr("id");
      let level = ui.item.attr("data-level");
      setTreeViewData(parent_id, id, level);
    });

    $(document).on("click", ".add-child", function (e) {
      e.preventDefault();
      $(this).addChildBranch();
    });

    $(document).on("click", ".add-sibling", function (e) {
      e.preventDefault();
      $(this).addSiblingBranch();
    });

    $(document).on("click", ".remove-branch", function (e) {
      e.preventDefault();

      const confirm = window.confirm(
        "Are you sure you want to delete this branch?"
      );
      if (!confirm) {
        return;
      }

      $(this).removeBranch();
    });
  });
})(jQuery);
