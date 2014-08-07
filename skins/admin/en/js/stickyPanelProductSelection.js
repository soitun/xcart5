/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Sticky panel controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function StickyPanelProductSelection(base)
{
  base = jQuery(base);
  if (0 < base.length && base.hasClass('sticky-panel')) {
    base.get(0).controller = this;
    this.base = base;

    this.process();
  }
}

extend(StickyPanelProductSelection, StickyPanelModelList);

// Autoloader
StickyPanelProductSelection.autoload = function()
{
  jQuery('.sticky-panel.product-selection-sticky-panel').each(
    function() {
      new StickyPanelProductSelection(this);
    }
  );
};

// Reposition
StickyPanelProductSelection.prototype.reposition = function(isResize)
{

};
