/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Remove/Approve buttons controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function onRemoveButton(obj)
{
  var form = jQuery(obj).parents('form').eq(0);
  form.find('input[name=action]').val('delete');
  form.submit();
}

function onApproveButton(obj)
{
  var form = jQuery(obj).parents('form').eq(0);
  form.find('input[name=action]').val('approve');
  form.submit(); 
}
