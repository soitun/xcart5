{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Twetter SDK loader
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<script type="text/javascript">
//<![CDATA[
!function(d,s,id){
  var js,fjs = d.getElementsByTagName(s)[0];
  if(!d.getElementById(id)) {
    js = d.createElement(s);
    js.id = id;
    js.src = "//platform.twitter.com/widgets.js";
    fjs.parentNode.insertBefore(js,fjs);
  }
}(document,"script","twitter-wjs");
//]]>
</script>

