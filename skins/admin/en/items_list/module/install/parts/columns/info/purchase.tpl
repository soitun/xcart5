{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules main section list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.module.install.columns.module-main-section", weight="200")
 *}

<widget
  IF="canPurchase(module)"
  class="\XLite\View\Button\Addon\Purchase"
  moduleObj="{module}"
  style="main-button" />

<div IF="canPurchase(module)" class="or-activate">{t(#or#)}<widget class="\XLite\View\Button\ActivateKey" label="Activate key" /></div>
