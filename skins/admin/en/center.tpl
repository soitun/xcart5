{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Center column
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="admin.main.page.content.center", weight="10")
 *}
<widget template="noscript.tpl" />

<h1 class="title" id="page-title" IF="isTitleVisible()&getTitle()">{t(getTitle())}</h1>

<list name="admin.center" />

<widget target="access_denied" template="access_denied.tpl" />

{*** TODO: will be moved to the dashboard side bar
<widget template="common/dialog.tpl" head="Customer zone warning" body="customer_zone_warning.tpl" IF="{getCustomerZoneWarning()}" />
***}

{* Some bug in Flexy *}
<widget target="product_list" template="product/product_list_form.tpl">

<widget target="product" class="\XLite\View\Tabber" body="{pageTemplate}" switch="page" />
<widget target="add_product" class="\XLite\View\Tabber" body="{pageTemplate}" switch="page" />

<widget target="profile" template="common/dialog.tpl" head="Delete profile - Confirmation" body="profile/confirm_delete.tpl" IF="mode=#delete#" />

<widget target="order" class="\XLite\View\Tabber" body="{pageTemplate}" switch="page" />
