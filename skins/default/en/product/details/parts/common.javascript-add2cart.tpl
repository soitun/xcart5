{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Custom javascript
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.details.page", weight="1000")
 *}
<script IF="product.getJavascript()" type="text/javascript">
$(document).ready(
  function() {
    $('form[name="add_to_cart"]').submit(
      function() {
        {product.getJavascript()}
      }
    );
  }
);
</script>
