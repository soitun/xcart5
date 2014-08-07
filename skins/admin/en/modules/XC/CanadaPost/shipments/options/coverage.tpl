{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Option :: coverage
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget
  class="\XLite\View\FormField\Input\Text\Price"
  fieldId="opt-coverage-{parcelIdx}"
  fieldName="parcelsData[{parcel.getId()}][optCoverage]"
  fieldOnly="true"
  min="0"
  comment="{t(#In store currency (0 - do not use coverage)#)}"
  value="{parcel.getOptCoverage()}" />
