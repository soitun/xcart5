{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Canada Post settings widget
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{t(#Canada Post module allows to use online shipping rates calculation via Canada Post#):h}
<br />
{t(#Please note that rates are calculated for shipping from Canadian locations only.#)}

<br / ><br />

{if:isWizardEnabled()}

  <widget template="modules/XC/CanadaPost/settings/wizard.tpl" />

{else:}

  <widget template="modules/XC/CanadaPost/settings/wizard.tpl" />

  <br /><br />

  <widget template="modules/XC/CanadaPost/settings/config.tpl" />

  <br /><br /><br />

  <widget template="modules/XC/CanadaPost/settings/test.tpl" />

{end:}
