{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Quantity input box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.details.page.info", weight="19")
 * @ListChild (list="product.details.quicklook.info", weight="19")
 *}

<span class="coming-soon-label" IF="product.isUpcomingProduct()">
  {t(#Coming soon#)}
  <span class="coming-soon-note" IF="config.CDev.ProductAdvisor.cs_display_date">({t(#expected on#)} <span class="coming-soon-date">{formatDate(product.getArrivalDate())}</span>)</span>
</span>
