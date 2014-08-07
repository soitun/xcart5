{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Parcel options
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<h3>{t(#Parcel options#)}</h3>

<table class="capost-parcel-options">

  <tr FOREACH="parcel.getAllowedOptionClasses(),optionClass">
    <td>
      <label>{t(optionClass.title)}<label>
    </td>
    <td>
      <widget template="{optionClass.template}" />
    </td>
  </tr>

</table>
