{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Export download box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="download-box {if:isCompletedSection()} completed-download{else:}begin-download{end:}">
  <div class="subcontent clearfix">
    <list name="export.completed.content" />
  </div>
  <div class="buttons" IF="isCompletedSection()">
    <list name="export.completed.buttons" />
  </div>
</div>
