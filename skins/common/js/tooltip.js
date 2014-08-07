/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Tooltip widget JS class
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function Tooltip()
{
  var obj = this;

  jQuery(this.pattern).each(
    function () {
      attachTooltip(
        jQuery(obj.caption, this),
        jQuery('.help-text', this).hide().html()
      );
    }
  );
}

Tooltip.prototype.pattern = '.tooltip-main';
Tooltip.prototype.caption = '.tooltip-caption';

// Autoloading new Tooltip widget
core.autoload(Tooltip);

jQuery(document).ready(
  function() {
    // Open warning popup
    core.microhandlers.add(
      'Tooltip',
      '.tooltip-main',
      function(event) {
        core.autoload(Tooltip);
      }
    );
});
