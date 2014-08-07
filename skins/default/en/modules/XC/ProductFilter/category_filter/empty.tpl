{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Empty 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="empty-box">
  <span>Oops!</span>
  <div>{t(#No products matching your criteria found. Please try again with different parameters.#)}</div>
  <a 
    href="{buildURL(#category#,##,_ARRAY_(#category_id#^category.category_id))}" 
    class="reset-filter">
    {t(#Show all products in this category#)}
  </a>
</div>
