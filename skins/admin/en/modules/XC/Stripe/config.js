/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

core.microhandlers.add(
  'stripe-help-switcher',
  '.stripe',
  function() {
    var box = jQuery(this).find('.instruction');

    box.find('.switcher.show').click(
      function() {
        box.removeClass('hidden');

        return false;
      }
    );

    box.find('.switcher.hide').click(
      function() {
        box.addClass('hidden');

        return false;
      }
    );

    var clip = new ZeroClipboard(
      jQuery(this).find('.webhook .url'),
      {
        moviePath: xliteConfig.zeroClipboardSWFURL
      }
    );
    clip.on(
      'complete',
      _.bind(
        function() {
          jQuery(this).find('.webhook .url').click();

          jQuery(this).find('.webhook .url')
            .validationEngine('showPrompt', jQuery(this).find('.webhook .tooltip').html(), 'load', 'bottomRight');
          jQuery('.formError')
            .addClass('stripe-webhook-tip')
            .css({
              'margin-top': '47px',
              'opacity':    1
            });
          setTimeout(
            _.bind(
              function() {
                jQuery(this).find('.webhook .url').validationEngine('hide');
              },
              this
            ),
            2000
          );
        },
        this
      )
    );

    jQuery(this).find('.webhook .url').click(
      function() {
        if (document.selection) {
          var range = document.body.createTextRange();
          range.moveToElementText(this);
          range.select();

        } else if (window.getSelection) {
          var range = document.createRange();
          range.selectNode(this.childNodes[0]);
          window.getSelection().addRange(range);
        }
      }
    );

  }
);

