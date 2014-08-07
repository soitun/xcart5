{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Membership selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<select name="{getParam(#field#)}">
  <option value="" selected="{isSelected(##,value)}">{t(#No membership#)}</option>
  <option FOREACH="getMemberships(),membership" value="{membership.membership_id}" selected="{isSelectedMembership(membership)}">{membership.getName()}</option>
</select>
