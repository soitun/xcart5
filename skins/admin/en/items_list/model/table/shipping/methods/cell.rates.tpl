{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Shipping rates link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="itemsList.shipping-methods.cell.rates", weight="100")
 *}

<a href="{buildURL(#shipping_rates#,##,_ARRAY_(#methodid#^entity.getMethodId()))}" class="rates" IF="entity.hasRates()" title="{t(#Click to edit rates#)}">{t(#Edit rates (X)#,_ARRAY_(#count#^entity.getRatesCount()))}</a>

<a href="{buildURL(#shipping_rates#,##,_ARRAY_(#methodid#^entity.getMethodId()))}#addmarkup" class="rates no-rates" IF="!entity.hasRates()" title="{t(#Click to add rates#)}">{t(#Add rates#)}</a>
