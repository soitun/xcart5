{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Entry new version
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.step.ready_to_install.entries_list.sections.table.columns.error", weight="400")
 *}

<td class="error-messages" colspan="3">
  <div class="error-message-block">
    <div class="error-message" FOREACH="messages,message">
      {message}
    </div>
  </div>
</td>
