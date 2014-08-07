/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Attributes
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery().ready(
  function () {
    jQuery('div.attributes div.checkbox').click(
      function () {
        var input = jQuery(':checkbox', this);
        if (!input.prop('checked')) {
          input.prop('checked', 'checked');
          input.get(0).setAttribute('checked', 'checked');

        } else {
          input.removeProp('checked');
        }
        checkCreateVariants();
      }
    );

    jQuery('div.attributes div.checkbox input').click(
      function (event) {
        event.stopPropagation();
      }
    );

    jQuery('div.attributes div.values').click(
      function () {
        jQuery(this).parent().toggleClass('fade-variant');
      }
    );

    jQuery('div.attributes div.checkbox input').change(
      function () {
        checkCreateVariants();
      }
    );

    jQuery('a.submit-form').click(
      function () {
        jQuery('form.form-attributes input[name=action]').val(jQuery(this).data('mode'));
        jQuery('form.form-attributes').submit();
        return false;
      }
    );

    jQuery('div.variants-are-based button').click(
      function () {
        jQuery('div.variants-are-based').hide();
        jQuery('div.variants').hide();
        jQuery('div.sticky-panel').hide();
        jQuery('div.attributes').removeClass('hidden');
      }
    );

    checkCreateVariants();
  }
);

function checkCreateVariants() {
    var variantsCount = 1;
    jQuery('div.attributes input:checked').each(
      function() {
        variantsCount *= jQuery(this).data('count');
      }
    );

    if (variantsCount > 1) {
        jQuery('.create-variants').show();
        jQuery('div.attributes').addClass('checked');
        jQuery('div.attributes .save-changes span').text(jQuery('div.attributes .buttons').data('attributes-title'));

    } else {
        jQuery('.create-variants').hide();
        jQuery('div.attributes').removeClass('checked');
        jQuery('div.attributes .save-changes span').text(jQuery('div.attributes .buttons').data('no-attributes-title'));
    }

    jQuery('.variants-count').text('(' + variantsCount + ')');
}
