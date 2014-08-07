{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Review page template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="review model-properties">

  <widget class="\XLite\Module\XC\Reviews\View\Form\Review\Admin\Review" name="edit_review_form" />

    <div class="model-properties">
    <ul class="table default-table">
      <list name="review.modify.fields" />
    </ul>
  </div>

  <div class="model-form-buttons pending" IF="entity.isNotApproved()">
    <list name="review.modify.buttons.pending" />
  </div>

  <div class="model-form-buttons" IF="!entity.isNotApproved()">
    <list name="review.modify.buttons.approved" />
  </div>

  <widget name="edit_review_form" end />
</div>
