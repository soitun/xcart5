{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product quantity inline widget for manual pin codes products
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div IF="entity.hasManualPinCodes()" class="manual-pins-amount">
<widget class="\XLite\View\Tooltip" text="{t(#Quantity in stock is determined by the amount of the remaining PIN codes.#)}" caption="{entity.getRemainingPinCodesCount()}" isImageTag="false" id="pins-amount-tooltip" >
</div>
