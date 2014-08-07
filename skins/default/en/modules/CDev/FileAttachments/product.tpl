{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Attachments list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="product-attachments">
  <ul>
    <li FOREACH="getAttachments(),attachment">
      <img src="images/spacer.gif" alt="{t(attachment.storage.mimeName)}" class="mime-icon {attachment.storage.getMimeClass()}" />
      <a href="{attachment.storage.getFrontURL()}">{attachment.getPublicTitle()}</a>
      <span IF="attachment.storage.getSize()" class="size">({formatSize(attachment.storage.getSize())})</span>
      <div IF="attachment.getDescription()"class="description">{attachment.getDescription()}</div>
    </li>
  </ul>
</div>
