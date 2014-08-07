{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Egoods
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<table class="egoods-list">
  <tr FOREACH="getAttachments(),attachment">
    <td>
    {if:attachment.isAvailable()}
      <a href="{attachment.getURL()}">{attachment.attachment.getPublicTitle()}</a>
    {else:}
      {if:attachment.isActive()}
        <span>{attachment.attachment.getPublicTitle()}</span>
      {else:}
        <span>{attachment.getTitle()}</span>
      {end:}
    {end:}
    <span IF="attachment.isActive()&attachment.attachment.storage.getSize()" class="size">({formatSize(attachment.attachment.storage.getSize())})</span>
    </td>
  </tr>
</table>
