{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Trial upgrade notice
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.step.prepare.buttons.sections", weight="200")
 *}
<div IF="{displayTrialNotice()}" class="update-trial-notice">
  {t(#You can install these updates after purchasing and activating your X-Cart 5 license key#,_ARRAY_(#URL#^getPurchaseURL())):h}
</div>
