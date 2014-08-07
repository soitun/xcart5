{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Select language dialog
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<div class="select-language-dialog">
  <h2>{t(#Select language to edit#)}</h2>
  <ul class="added-languages">
    <li FOREACH="getAddedLanguages(),l">
      {if:canDelete(l)}
        {if:isTranslateLanguage(l)}
          <a href="{buildURL(#languages#,#delete#,_ARRAY_(#lng_id#^l.lng_id,#page#^page))}" class="delete" onclick="javascript: return confirmLanguageDelete(this, {l.lng_id}, '', '{page}');"><img src="images/spacer.gif" alt="" /></a>
        {else:}
          <a href="{buildURL(#languages#,#delete#,_ARRAY_(#lng_id#^l.lng_id,#page#^page,#language#^language))}" class="delete" onclick="javascript: return confirmLanguageDelete(this, {l.lng_id}, '{language}', '{page}');"><img src="images/spacer.gif" alt="" /></a>
        {end:}
      {else:}
        <img src="images/spacer.gif" alt="" class="delete" />
      {end:}
      {if:isInterfaceLanguage(l)}
        <img src="images/spacer.gif" alt="" class="selected" />
      {else:}
        <a href="{buildURL(#languages#,#switch#,_ARRAY_(#lng_id#^l.lng_id,#page#^page,#language#^language))}"{if:l.enabled} class="switch enabled"{else:} class="switch"{end:}><img src="images/spacer.gif" alt="" /></a>
      {end:}
      <img IF="l.flagURL" src="{l.flagURL}" alt="" class="flag" />
      <span class="code">{l.code}</span>
      {if:canSelect(l)}
        <a href="{buildURL(#languages#,##,_ARRAY(#language#^l.code,#page#^page))}" class="name">{l.name}</a>
      {else:}
        <span class="name selected">{l.name}</span>
      {end:}
    </li>
  </ul>

  <hr class="tiny" />

  <h2>{t(#Add new language#)}</h2>

  <ul class="inactive-languages">
    <li FOREACH="getInactiveLanguages(),l"><img IF="l.flagURL" src="{l.flagURL}" alt="" /><span>{l.code}</span><a href="{buildURL(#languages#,#active#,_ARRAY_(#lng_id#^l.lng_id,#language#^l.code,#page#^page))}">{l.name}</a></li>
  </ul>

</div>
