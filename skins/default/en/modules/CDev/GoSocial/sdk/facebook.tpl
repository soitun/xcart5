{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Facebook SDK loader
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div id="fb-root"></div>
<script type="text/javascript">
//<![CDATA[
(function(d){
  var js, id = 'facebook-jssdk';
  if (d.getElementById(id)) {
    return;
  }
  js = d.createElement('script');
  js.id = id;
  js.async = true;
  js.src = "{getSDKUrl():h}";
  d.getElementsByTagName('head')[0].appendChild(js);
}(document));
//]]>
</script>
