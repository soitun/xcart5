{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Page to display when marketplace is not available
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

 <div class="box-frame marketplace-not-connected">
   {* Translation of the message must be done inside the getWarningMessage() method *}
   <div class="box">
     {getWarningMessage():h}<br /><br />
     {t(#After the problem has been fixed, try to connect again.#,_ARRAY_(#clear_cache#^buildURL(#addons_list_marketplace#,#clear_cache#))):h}
   </div>
 </div>
