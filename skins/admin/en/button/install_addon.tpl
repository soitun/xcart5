{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Install addon button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<button type="submit"
{if:hasName()} name="{getName()}"{end:}
{if:hasValue()} value="{getValue()}"{end:}
{if:hasClass()} class="{getClass()}"{end:}
onclick="javascript:document.location='{getURL()}';"
><span>{t(getButtonLabel())}</span></button>
