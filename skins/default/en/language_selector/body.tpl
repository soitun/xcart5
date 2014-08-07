{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Language selector
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<li class="language_label">{t(#Language#)}</li>
<li class="language-selector">
  <ul>
    <li class="current"><span class="lng"><img src="{currentLanguage.flagURL}" alt="" /> <span>{currentLanguage.code}</span></span></li>
    <li FOREACH="getActiveLanguages(),language" class="not-current"><a href="{getChangeLanguageLink(language)}"><img src="{language.flagURL}" alt="" /> <span>{language.code}</span></a></li>
  </ul>
</li>
