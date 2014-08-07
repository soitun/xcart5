{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Add (activate) language
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="add-new-language-dialog">
  <h2>{t(#Add new language#)}</h2>
  <ul class="inactive-languages">
    <li FOREACH="getInactiveLanguages(),l">
      <img IF="l.getFlagURL()" src="{l.getFlagURL()}" alt="" /><span>{l.getCode()}</span>
      <a IF="getModulePageURL(l)" href="{getModulePageURL(l)}">{l.getName()}</a>
      <a IF="!getModulePageURL(l)" href="{buildURL(#languages#,#active#,_ARRAY_(#lng_id#^l.getLngId(),#static_form_id#^1))}">{l.getName()}</a>
    </li>
  </ul>
</div>
