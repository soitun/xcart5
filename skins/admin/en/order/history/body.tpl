{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Order history
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="panel panel-default">
<div class="panel-heading">
  <h4 class="panel-title">
    <a data-toggle="collapse" data-interval="0" data-target="#orderHistory" href="javascript:void(0);">{t(#Order history#)}</a>
    <a class="expanded-view panel-actions" href="javascript:void(0);">{t(#Expanded view#)}</a>
    <a class="compact-view panel-actions" href="javascript:void(0);">{t(#Compact view#)}</a>
  </h4>
</div>
<div id="orderHistory" class="panel-collapse collapse" style="height: auto;">
<ul class="panel-body">
  <list name="order.history.base" />
</ul>
</div>
</div>
