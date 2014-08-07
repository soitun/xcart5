/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Search pabel functionality
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

var SearchConditionBox = function(submitFormFlag)
{
  var makeSubmitFormFlag = !_.isUndefined(submitFormFlag) && (submitFormFlag === true);

  // Switch secondary box visibility
  jQuery('.search-conditions-box .arrow').click(
    function() {
      var searchConditions = jQuery('.search-conditions-box');
      if (searchConditions.hasClass('full')) {
        searchConditions.removeClass('full')
      } else {
        searchConditions.addClass('full')
      }
    }
  );

  // Add some additional functionality for the search conditions boxes
  jQuery('.search-conditions-box').each(
    function() {
      var $this = jQuery(this);
      var linked = core.getCommentedData($this, 'linked');

      if (jQuery(linked).length > 0) {
        var $form = $this.parents('form').eq(0);

        $form.submit(
          function (event) {
            event.stopImmediatePropagation();

            var $linked = jQuery(linked).get(0).itemsListController;

            $form.find(':input').each(function (id, elem) {
              if ('action' !== jQuery(elem).attr('name') && 'returnURL' !== jQuery(elem).attr('name')) {
                var value = jQuery(elem).val();

                if (
                    'checkbox' === jQuery(elem).attr('type')
                    && false == jQuery(elem).prop('checked')
                ) {
                    value = '';
                }

                $linked.setURLParam(jQuery(elem).attr('name'), value);
              }
            });

            $linked.loadWidget();

            return false;
          }
        );
        if (makeSubmitFormFlag) {
          $form.submit();
        }
      }
    }
  );

    // Scroll to items list anchor if search is running
    if (
      (self.location + '').search(/searched=1/) != -1
      && !self.location.hash
    ) {
      var a = null;

      jQuery('.search-conditions-box').each(
        function() {
          jQuery(this).parents('form').eq(0).nextAll().each(
            function () {
              if (!a) {
                var tmp = jQuery(this).find('a.list-anchor');
                if (tmp.length) {
                  a = tmp;
                }
              }
            }
          );
        }
      );

      if (a) {
        self.location.hash = a.attr('name');
      }

    }

    // Expand secondary box if box has filled fields
    var boxes = jQuery('.search-conditions-box:not(.full) .search-conditions-hidden');
    if (boxes.length) {
      boxes.each(
        function() {
          var filled = false;
          jQuery(this).find('input[type="text"],select,textarea').each(
            function() {
              if (jQuery(this).val()) {
                filled = true;
              }
            }
          );

          if (filled) {
            jQuery(this).parents('.search-conditions-box').eq(0).addClass('full');
          }
        }
      );
    }
};

jQuery().ready(SearchConditionBox);
