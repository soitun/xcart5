{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Block content : items
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="dashboard-center.welcome.non-root.content", weight="10")
 *}

<div class="step-items">
  <ul>
    <li FOREACH="getRoles(),role" class="item-role">{role.name}</li>
  </ul>
</div>


