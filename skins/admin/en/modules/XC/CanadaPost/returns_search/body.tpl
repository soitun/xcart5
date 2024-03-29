{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Returns page template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget IF="isSearchVisible()" class="XLite\Module\XC\CanadaPost\View\SearchPanel\ProductsReturn\Admin\Main" />

{* Move all from the widget here *}
<widget template="common/dialog.tpl" body="modules/XC/CanadaPost/returns_search/list/body.tpl" />

