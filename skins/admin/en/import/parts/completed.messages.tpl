{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Import completed section : errors 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="import.completed.content", weight="100")
 *}

<ul class="messages" IF="getMessages()">
  <li FOREACH="getMessages(),message">
    <i class="icon-ok"></i> {message.text} <span IF="message.comment">{message.comment}</span>
  </li>
</ul>
<div class="empty" IF="!getMessages()&getErrorMessages()">
  <div class="message" FOREACH="getErrorMessages(),message">
    <i class="icon-ok"></i> {message.text:h} <div IF="message.comment" class="comment">{message.comment:h}</div>
  </div>
</div>
