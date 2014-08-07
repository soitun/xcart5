{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Zone: states selector template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="zones.zone.details", weight="200")
 *}

<widget class="\XLite\View\FormField\Listbox\State" fieldName="zone_states" label="States" labelFrom="All states" labelTo="Selected states" value="{zone.getZoneStates()}" wrapperClass="zone-states" />
