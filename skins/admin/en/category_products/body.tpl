{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Category page template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{* Open <form ...> tag *}
<widget class="\XLite\View\Form\ItemsList\Product\CategoryProducts" name="products_form" />

  {* List of products *}
  <widget class="\XLite\View\ItemsList\Model\Product\Admin\CategoryProducts" />

{* Close </form> tag *}
<widget name="products_form" end />
