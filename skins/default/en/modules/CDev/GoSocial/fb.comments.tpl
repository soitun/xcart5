{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Facebook comments
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="\XLite\Module\CDev\GoSocial\View\ExternalSDK\Facebook" />
<div class="fb-comments"{foreach:getAttributes(),k,v} data-{k}="{v}"{end:}></div>
