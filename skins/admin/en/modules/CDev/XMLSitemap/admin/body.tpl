{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Sitemap page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="sitemap settings general-settings">
  <p class="url">{t(#XML sitemap URL: X#,_ARRAY_(#url#^getSitemapURL())):h}</p>

  <widget class="\XLite\Module\CDev\XMLSitemap\View\Form\Sitemap" name="form" />

  <p>{t(#Mark, the search engines you want to inform of the structure of your site using the site map#)}</p>

  <ul class="engines">
    <li FOREACH="getEngines(),key,engine">
      <input type="checkbox" name="engines[]" value="{key}" id="engine{key}" />
      <label for="engine{key}">{t(engine.title)}<label>
    </li>
  </ul>

  <widget class="\XLite\Module\CDev\XMLSitemap\View\Form\Settings" category="CDev\XMLSitemap" />  

  <div class="buttons">
    <widget class="\XLite\View\Button\Submit" />
  </div>

  <widget name="form" end />
</div>

