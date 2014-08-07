{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * List of status messages
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{* :TODO: merge with the "skins/admin/en/upgrade/step/prepare/status_messages/body.tpl" *}

<div class="service-messages-section">
  <div class="ready-to-install-service-message">
    <div FOREACH="getMessages(),entryName,messageList">
      {foreach:messageList,message}
      {* :NOTE: do not add t(##) here: messages are already translated *}
      <div class="message-entry">{message}</div>
      {end:}
    </div>
  </div>
</div>
