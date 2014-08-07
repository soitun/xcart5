{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Core version select popup details
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.selector-version.details", weight="300")
 *}

<select name="version">
<option FOREACH="getCoreVersionsList(),version,data">{version}</option>
</select>
