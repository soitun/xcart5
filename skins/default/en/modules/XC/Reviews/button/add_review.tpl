{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Button 'Add review'
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="reviews.general", weight="20")
 *}
<div id="product-reviews-button">
    <widget IF="{isAllowedAddReview()}" class="\XLite\Module\XC\Reviews\View\Button\Customer\AddReview" label="{t(#Add review#)}" style="regular-main-button" product="{product}" />
    <div class="add-review-button-disabled" IF="{!isAllowedAddReview()}">{getAddReviewMessage()}</div>
</div>
