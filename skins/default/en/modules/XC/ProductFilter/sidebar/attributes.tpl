{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attributes 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="filter{if:getTitle()} group{end:}">
  <h4 IF="getTitle()">{getTitle()}</h4>
  <ul class="clearfix attributes">
    <li FOREACH="getAttributesList(),a" class="clearfix {a.class}">
      {a.widjet.display()}
    </li>
  </ul>
</div>
