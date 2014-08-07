{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Stats management page main template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<ul class="states-list" IF="getCountriesWithStates()">
  <li FOREACH="getCountriesWithStates(),id,country">
    <a href="{buildURL(#states#,##,_ARRAY_(#country_code#^country.getCode()))}" IF="!country.code=getCountryCode()">{country.getCountry()}</a>
    <span IF="country.code=getCountryCode()">{country.getCountry()}</span>
  </li>
</ul>

<widget class="\XLite\View\SearchPanel\States\Main" />

<widget class="\XLite\View\Form\States\States" name="states_form" />
<widget class="\XLite\View\ItemsList\Model\State" />
<widget name="states_form" end />

