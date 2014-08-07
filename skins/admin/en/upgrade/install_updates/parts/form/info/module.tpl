{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Upgrade entry icon
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.install_updates.sections.form.info", weight="200")
 *}

<li class="module" IF="isModule(entry)">
  <ul class="details">
  <list name="sections.form.info.module" type="inherited" entry="{entry}" />
  </ul>
</li>
