{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Welcome section. Used if connector is not configured. 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<br />

<img src="skins/admin/en/modules/CDev/XPaymentsConnector/method_icon.png" width="130" height="55" />

<br /><br />

<p>
  {t(#This module connects X-Cart and#)}
  <a href="{getXpaymentsLink()}" target="_blank">{t(#X-Payments#)}</a>
  {t(# PA-DSS certified payment extension.#)}
</p>

<br />

<p>{t(#If you already have X-Payments installed click "Next".#)}</p>
<p>{t(#Otherwise you need to get X-Payments installed first.#)}</p>

<br />

<a href="{getPurchaseLink()}" target="_blank" class="btn btn-default" style="text-decoration: none;">{t(#See pricing#)}</a>

<a href="{getConnectionLink()}" class="btn regular-button regular-main-button" style="text-decoration: none;">{t(#Next#)}</a>
