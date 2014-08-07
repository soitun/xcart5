{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Canada Post delivery to post office section 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="invoice.bottom", weight="15")
 *}

<list IF="order.getCapostOffice()" name="invoice.bottom.d2po" />
