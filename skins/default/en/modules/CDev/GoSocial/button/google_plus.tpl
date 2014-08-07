{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Google+ button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="gplus">
  <div class="g-plusone"{foreach:getButtonAttributes(),k,v} data-{k}="{v}"{end:}></div>
</div>
<widget class="\XLite\Module\CDev\GoSocial\View\ExternalSDK\GooglePlus" />
