{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<a IF="promoBanner" href="{promoBanner.module_banner_url}">
 <img src="{promoBanner.banner_url}" class="promo-banner" />
</a>

<table cellspacing="0" cellpadding="0" class="data-table items-list modules-list{if:promoBanner} module-list-has-promo-banner{end:}">

  <tr FOREACH="getPageData(),idx,module" class="{getModuleClassesCSS(module)}">
    <list name="columns" type="inherited" module="{getModuleFromMarketplace(module)}" />
  </tr>

</table>
