{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Language label edit action
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="edit-label-wrapper">
  <a
    href="javascript:void(0);"
    class="edit always-reload"
    title="{t(#Click to edit all this label translations#)}"
    onclick="javascript: return openEditLabelDialog(this, {entity.label_id}, '{code}');">
    <img src="images/spacer.gif" alt="" />
  </a>
</div>

