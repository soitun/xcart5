/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Products return status selector controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

// Find all return status selectors and disable them if necessary
function CapostReturnStatusesSelectorQueue()
{
    jQuery('select.capost-return-status').each(function(index, elem){
        new CapostReturnStatusesSelector(jQuery(elem));
    });
}

// Selector class
function CapostReturnStatusesSelector(list)
{
    this.container = list;
    this.statusCode = list.val();

    this.checkList();
}

CapostReturnStatusesSelector.prototype.container = null;
CapostReturnStatusesSelector.prototype.statusCode = null;

// Check - is selector should be disabled or not
CapostReturnStatusesSelector.prototype.checkList = function()
{
    if (this.canBeDisabled()) {
        this.disableList();
    }
};

// Check - is selector can be disabled or not
CapostReturnStatusesSelector.prototype.canBeDisabled = function()
{
    return this.statusCode != 'I'
        && !this.container.hasClass('no-disable');
};

// Disable selector
CapostReturnStatusesSelector.prototype.disableList = function()
{
    this.container.prop('disabled', true);
};

core.autoload(CapostReturnStatusesSelectorQueue);

core.bind('stickyPanelReposition', CapostReturnStatusesSelectorQueue);