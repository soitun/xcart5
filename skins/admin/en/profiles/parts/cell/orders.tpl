{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Orders 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:entity.orders_count}
  <a href="{buildURL(#order_list#,#searchByCustomer#,_ARRAY_(#profileId#^entity.profile_id,%\XLite::FORM_ID%^%\XLite::getFormId()%))}">{entity.orders_count}</a>
{else:}
  {t(#n/a#)}
{end:}
