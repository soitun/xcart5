{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Customer's saved credit cards footer 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="admin.account.saved_cards.after", weight="100")
 *}

<br/><br/>

{if:allowZeroAuth()}
  &nbsp;&nbsp;<a href="{buildURL(#add_new_card#,##,_ARRAY_(#profile_id#^getCustomerProfileId()))}">{t(#Add new credit card#)}</a>
{end:}
