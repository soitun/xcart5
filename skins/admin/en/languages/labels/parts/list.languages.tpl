{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Languages list template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="languages.labels", weight="100")
 *}

<ul class="languages-list" IF="getLanguages()">
  <li FOREACH="getLanguages(),id,lng">
    <a href="{buildURL(#labels#,##,_ARRAY_(#code#^lng.getCode()))}" IF="!lng.code=getCode()">{lng.getName()}</a>
    <span IF="lng.code=getCode()">{lng.getName()}</span>
  </li>
</ul>
