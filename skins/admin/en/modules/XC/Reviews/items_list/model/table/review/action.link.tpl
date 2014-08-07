{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Edit Review link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<widget IF="{getProductId()}" class="XLite\Module\XC\Reviews\View\Button\Admin\EditReview" style="edit-review" id="{entity.getId()}" target_product_id="{getProductId()}" />
<widget IF="{!getProductId()}" class="XLite\Module\XC\Reviews\View\Button\Admin\EditReview" style="edit-review" id="{entity.getId()}" />
