{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * AustraliaPost settings page main template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<p><b>Australia Post</b> module allows to use online shipping rates calculation via <a href="http://auspost.com.au/devcentre/pacpcs.html" target="_new">Postage Assessment Calculation service</a>.</p>
<p>Please note that rates are calculated for shipping from Australian locations only.</p>

<br /><br />

{if:config.CDev.AustraliaPost.optionValues}

<widget template="modules/CDev/AustraliaPost/config.tpl" />

<widget template="modules/CDev/AustraliaPost/test.tpl" />

{else:}

<widget template="modules/CDev/AustraliaPost/renew_settings.tpl" />

{end:}
