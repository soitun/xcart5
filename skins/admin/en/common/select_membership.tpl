{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Membership selection template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<select {if:!nonFixed}class="fixed-select"{end:} name="{getParam(#field#)}">
  <option value="%" IF="{getParam(#allOption#)}" selected="{isSelected(#%#,getParam(#value#))}">{t(#All membership levels#)}</option>
  <option value="" selected="{isSelected(##,getParam(#value#))}">{t(#No membership#)}</option>
  <option value="pending_membership" IF="{getParam(#pendingOption#)}" selected="{isSelected(#pending_membership#,getParam(#value#))}">{t(#Pending membership#)}</option>
  <option FOREACH="getMemberships(),membership" value="{membership.getMembershipId()}" selected="{isSelected(membership.getMembershipId(),getParam(#value#))}">{membership.getName()}</option>
</select>
