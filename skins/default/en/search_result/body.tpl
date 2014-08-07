{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Search results
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
{* TODO: REMOVE? we are using items_list/products/* templates instead*}
<div class="{getListTitleClass()}">{t(#X results found#,_ARRAY_(#count#^getCount()))}</div>

<widget template="products_list/body.tpl" />
