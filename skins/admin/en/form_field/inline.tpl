{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Inline container
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="{getContainerClass()}">
  <div IF="hasSeparateView()" class="view"><widget template="{getViewTemplate()}" /></div>
  <div IF="isEditable()" class="field"><widget template="{getFieldTemplate()}" /></div>
</div>
