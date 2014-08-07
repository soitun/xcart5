{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Model
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="settings general-settings settings-{page}">
  <widget IF="target=#module#" class="\XLite\View\Model\ModuleSettings" useBodyTemplate="1" />
  <widget IF="!target=#module#" class="\XLite\View\Model\Settings" useBodyTemplate="1" />
</div>
