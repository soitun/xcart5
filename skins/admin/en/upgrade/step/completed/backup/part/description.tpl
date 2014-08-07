{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Backup mesaage
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.step.completed.backup.sections", weight="100")
 *}

{* :NOTE: message is already translated *}
<div class="upgrade-note upgrade-description">
  {t(#The upgrade is completed. Please, do not close this page until you check your web site and check that everything works properly#)}.
</div>

<widget class="\XLite\View\Button\Link" style="main-button" label="{t(#Open storefront#)}" blank="1" location={getShopURL()} />

<div class="upgrade-note upgrade-description">
  {t(#If there are some critical errors occured you can do the following#)}:
</div>

<list name="actions" type="inherited" />
