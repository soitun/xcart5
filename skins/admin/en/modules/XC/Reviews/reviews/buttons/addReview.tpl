{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add review button template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @listChild (list="itemsList.xc.reviews.review.header")
 * @listChild (list="itemsList.xc.reviews.productreview.header")
 *}

<widget IF="{getProductId()}" class="XLite\Module\XC\Reviews\View\Button\Admin\AddReview" style="add-review" target_product_id="{getProductId()}" />
<widget IF="{!getProductId()}" class="XLite\Module\XC\Reviews\View\Button\Admin\AddReview" style="add-review" />
