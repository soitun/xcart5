{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Zone: country selector template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="zones.zone.details", weight="100")
 *}

<widget class="\XLite\View\FormField\Listbox\Country" fieldName="zone_countries" label="Countries" labelFrom="All countries" labelTo="Selected countries" value="{zone.getZoneCountries()}" wrapperClass="zone-countries" />
