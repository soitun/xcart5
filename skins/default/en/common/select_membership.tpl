{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<select class="FixedSelect" name="{field}" size="1" id="{field}">
   <option value="%" IF="{allOption}" selected="{isSelected(#%#,value)}">{t(#All#)}</option>
   <option value="" selected="{isSelected(##,value)}">{t(#None#)}</option>
   <option value="pending_membership" IF="pendingOption" selected="{isSelected(#pending_membership#,value)}">{t(#Pending membership#)}</option>
   <option FOREACH="config.Memberships.memberships,membership" selected="{isSelected(membership,value)}" value="{membership:r}">{membership}</option>
</select>
