{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Header bar account links
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="layout.header.bar", weight="100")
 * @ListChild (list="layout.responsive.account", weight="50")
 *}

<ul class="account-links" IF="isLogged()">
  <list name="layout.header.bar.links.logged" />
</ul>
