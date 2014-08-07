{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Option :: way to deliver
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget
  class="\XLite\Module\XC\CanadaPost\View\FormField\Select\DeliveryWayType"
  fieldId="opt-way-to-deliver-{parcelIdx}"
  fieldName="parcelsData[{parcel.getId()}][optWayToDeliver]"
  fieldOnly="true"
  value="{parcel.getOptWayToDeliver()}" />
