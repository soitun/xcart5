{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Header part
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="head", weight="100")
 *}
{* TODO : Remove the whole static code into the comment model*}
<script type="text/javascript">
var xliteConfig = {
  script:              '{getScript():h}',
  language:            '{currentLanguage.getCode()}',
  success_lng:         '{t(#Success#)}',
  base_url:            '{getBaseShopURL()}',
  form_id:             '{xlite.formId}',
  form_id_name:        '{%\XLite::FORM_ID%}',
  zeroClipboardSWFURL: '{getZeroClipboardSWFUrl()}'
};
</script>
