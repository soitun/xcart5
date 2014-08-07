{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Left sidebar
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="layout.main.center", weight="100")
 *}

<div id="sidebar-first" class="column sidebar" IF="isSidebarFirstVisible()">
  <div class="section">
    <list name="sidebar.first" />
  </div>
</div>
