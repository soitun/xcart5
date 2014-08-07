{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Canada Post products return :: from :: files
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="capost_return.form", weight="300")
 *}

<div IF="productsReturn.hasLinks()" class="documents">
  
  <h2>{t(#Documents#)}</h2>

  <ul>
    <li FOREACH="productsReturn.getLinks(),link">
      <a href="{link.storage.getURL()}">{link.getLinkTitle()}</a>
    </li>
  </ul>
  
</div>
