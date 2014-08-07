{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Zone: city masks template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="zones.zone.details", weight="300")
 *}

<widget class="\XLite\View\FormField\Textarea\Simple" value="{zone.getZoneCities(1)}" label="City masks" rows="5" cols="70" fieldName="zone_cities" help="{t(#Zone city masks help#)}" IF="isCityMasksEditEnabled()" />
