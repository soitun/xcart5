{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Subcategories count link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.country.cell.states", weight="100")
 *}

<a href="{buildURL(#states#,##,_ARRAY_(#country_code#^entity.getCode()))}" class="country-states" IF="entity.hasStates()" title="{t(#Click to edit states#)}">{t(#Edit states (X)#,_ARRAY_(#count#^entity.getStatesCount()))}</a>

<a href="{buildURL(#states#,##,_ARRAY_(#country_code#^entity.getCode()))}" class="country-states no-states" IF="!entity.hasStates()" title="{t(#Click to add states#)}">{t(#Add states#)}</a>
