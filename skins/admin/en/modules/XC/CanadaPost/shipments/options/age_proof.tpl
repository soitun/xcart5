{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Option :: age proof
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget
  class="\XLite\Module\XC\CanadaPost\View\FormField\Select\AgeProofType"
  fieldId="opt-age-proof-{parcelIdx}"
  fieldName="parcelsData[{parcel.getId()}][optAgeProof]"
  fieldOnly="true"
  value="{parcel.getOptAgeProof()}" />
