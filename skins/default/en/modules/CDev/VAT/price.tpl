{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product price value
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.plain_price", weight="20")
 *}

{if:isVATApplicable()}
<li IF="isDisplayedPriceIncludingVAT()" class="vat-price"><span class="vat-note-product-price">{t(#incl.VAT#,_ARRAY_(#name#^getVATName()))}</span></li>
<li IF="!isDisplayedPriceIncludingVAT()" class="vat-price"><span class="vat-note-product-price">{t(#excl.VAT#,_ARRAY_(#name#^getVATName()))}</span></li>
{end:}
