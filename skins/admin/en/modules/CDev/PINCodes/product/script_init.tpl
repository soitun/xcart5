{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Script variables initialization
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.pinCodes", weight="10")
 *}

<script type="text/javascript">
//<![CDATA[
  var lbl_cannot_remove_sold_pincode = '{t(#Cannot remove a sold PIN code#)}';
  var pins_enabled = "{if:product.getPinCodesEnabled()}1{end:}";
//]]>
</script>

