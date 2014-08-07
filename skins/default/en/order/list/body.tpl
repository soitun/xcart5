{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Orders list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="orders-list {getClassIdentifier()}">

  <list name="orders.children" />

{* TODO Restore

<script type="text/javascript">
jQuery(document).ready(
  function() {
    jQuery('.orders-list.{getClassIdentifier()}').each(
      function() {
        new OrdersListController(this, {getAJAXRequestParamsAsJSObject():r});
      }
    );
  }
);
</script>
*}

</div>
