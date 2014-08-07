{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product controller tab
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="product-attachments">

  <div class="add-file">
    <widget
      class="XLite\View\Button\FileSelector"
      label="Add file"
      object="product"
      objectId="{product.getProductId()}"
      fileObject="attachments" />
  </div>

  {if:product.attachments.count()}
  <widget class="XLite\Module\CDev\FileAttachments\View\Form\Attachments" product="{getProduct()}" name="product_attachments" />

    <ul class="files" IF="product.getAttachments()">
      <li FOREACH="product.getAttachments(),index,attachment" class="{getItemClass(attachment)}">

        <div class="row">
          <list name="product.attachments.row" attachment="{attachment}" />
        </div>

        <div class="info" style="display: none;">
          <list name="product.attachments.properties" attachment="{attachment}" />
        </div>

      </li>
    </ul>

    <widget class="XLite\Module\CDev\FileAttachments\View\Panel\Product" />

  <widget name="product_attachments" end />
  {end:}
</div>
