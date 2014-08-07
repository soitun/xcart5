{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Products list page template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget IF="isSearchVisible()" class="\XLite\View\SearchPanel\Product\Admin\Main" />

{* Open <form ...> tag *}
<widget class="\XLite\View\Form\ItemsList\Product\Main" name="products_form" />

  {* List of products *}
  <widget class="\XLite\View\ItemsList\Model\Product\Admin\Search" />

{* Close </form> tag *}
<widget name="products_form" end />
