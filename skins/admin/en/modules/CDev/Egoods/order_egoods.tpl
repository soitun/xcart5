{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order's e-goods list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<ul class="egoods-items">
  <li FOREACH="getItems(),item" class="item {if:item.product.product_id}live-product{else:}deleted-product{end:}">
    <div class="title">
      {if:item.product.product_id}
        <a href="{buildURL(#product#,##,_ARRAY_(#id#^item.product.product_id))}">{item.product.name}</a>
      {else:}
        <span>{item.name}</span>
      {end:}
      <span class="qty">&times; {item.getAmount()}</span>
    </div>
    <ul class="attachments">
      <li FOREACH="item.getPrivateAttachments(),attachment" class="{getAttachmentClass(attachmentArrayPointer,attachment)}">
        <img src="images/spacer.gif" alt="" class="rt-corner" />
        <div class="attachment-title">
          {if:attachment.attachment}
            <a href="{buildURL(#product#,##,_ARRAY_(#id#^item.product.product_id,#page#^#attachments#))}">{attachment.attachment.getPublicTitle()}<img src="images/spacer.gif" alt="" class="right-fade" /></a>
          {else:}
            <span>{attachment.getTitle()}</span>
          {end:}
        </div>
        <div IF="!item.product.product_id" class="info blocked">{t(#Product removed#)}</div>
        <div IF="!attachment.getAttachment()" class="info blocked">{t(#Attachment removed#)}</div>
        <div IF="!attachment.isOrderCompleted()" class="info unavailable">
          <strong>{t(#Unavailable#)}</strong>
          <span>{t(#Order is not processed#)}</span>
        </div>
        <div IF="item.product.product_id&attachment.getAttachment()&attachment.isOrderCompleted()" class="info">
          <div IF="attachment.hasAttemptsLimit()" class="attempts">
            {if:attachment.isAttemptsEnded()}
              <span>{t(#Expired by limit#)}</span>
            {else:}
              <strong>{t(#Downloads left#)}:</strong> {attachment.getAttemptsLeft()} / {attachment.getAttemptLimit()}
            {end:}
          </div>
          <div IF="attachment.hasExpireLimit()">
            {if:attachment.isExpired()}
              <span>{t(#Expired by TTL#)}</span>
            {else:}
              <strong>{t(#Expires in#)}:</strong> {formatTTL(attachment.getExpiresLeft())}
            {end:}
          </div>
          <div IF="attachment.isExpired()|attachment.isAttemptsEnded()" class="status {getStatusClass(attachment)}">{t(#Blocked#)}</div>
          <div IF="attachment.getBlocked()" class="status {getStatusClass(attachment)}">{t(#Blocked by administrator#)}</div>
          <div IF="attachment.isAvailable()" class="status {getStatusClass(attachment)}">{t(#Available for download#)}</div>
          <widget class="XLite\Module\CDev\Egoods\View\Form\OrderEgood" formParams="{_ARRAY_(#order_id#^item.order.getOrderId(),#attachment_id#^attachment.getId())}" name="egood" />
            {if:attachment.isExpired()|attachment.isAttemptsEnded()}
              <widget class="XLite\Module\CDev\Egoods\View\Button\Renew" label="Renew" />
            {else:}
              {if:attachment.getBlocked()}
                <widget class="XLite\Module\CDev\Egoods\View\Button\Renew" label="Unblock and renew" />
              {else:}
                <widget class="XLite\Module\CDev\Egoods\View\Button\Block" label="Block" />
                <widget class="XLite\Module\CDev\Egoods\View\Button\Renew" label="Renew" />
              {end:}
            {end:}
          <widget name="egood" end />
        </div>
      </li>
    </ul>
    <div class="clear"></div>
  </li>
</ul>

