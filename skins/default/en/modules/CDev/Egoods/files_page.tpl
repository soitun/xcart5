{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * User files
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="orders-files">
  <ul class="orders">
    <li FOREACH="getOrdersWithFiles(),order" class="order">
      <ul class="files">
        <li FOREACH="order.getDownloadAttachments(),attachment" class="file">
          <div class="row">
            <img src="images/spacer.gif" alt="{t(attachment.attachment.storage.getMimeName())}" class="mime-icon {attachment.attachment.storage.getMimeClass()}" />
            <a class="name" href="{attachment.getURL()}">{attachment.attachment.getPublicTitle()}</a>
            <span IF="attachment.attachment.storage.getSize()" class="size">({formatSize(attachment.attachment.storage.getSize())})</span>
          </div>
          <div IF="attachment.attachment.getDescription()" class="description">{attachment.attachment.getDescription()}</div>
        </li>
      </ul>
      <div class="info">
        <a href="{buildURL(#order#,##,_ARRAY_(#order_number#^order.getOrderNumber()))}">{t(#Order X#,_ARRAY_(#id#^order.getOrderNumber()))}</a>
        <span class="date">({formatTime(order.getDate())})</span>
      </div>
    </li>
  </ul>
</div>
