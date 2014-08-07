{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Orders search page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<widget IF="isSearchVisible()" class="XLite\View\SearchPanel\Order\Admin\Main" />

<widget class="\XLite\View\Form\ItemsList\Order\Main" name="orders_form" />
  <widget class="\XLite\View\ItemsList\Model\Order\Admin\Search" />
<widget name="orders_form" end />
