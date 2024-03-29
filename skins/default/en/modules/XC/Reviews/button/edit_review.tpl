{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Popup button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<button type="button" class="{getClass()}" title="{t(#Edit review#)}">
{displayCommentedData(getURLParams())}
<span class="fa fa-pencil-square-o">{t(getButtonContent())}</span>
</button>
