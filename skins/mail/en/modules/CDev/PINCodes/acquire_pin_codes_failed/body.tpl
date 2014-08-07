{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<html>
<body>
{t(#Could not assign PIN codes to the following products:#)}
<div>
{foreach:order.getItems(),index,item}
  <div IF="item.countMissingPinCodes()">
    {item.product.name:h} : {t(#X PIN Codes were not assigned.#,_ARRAY_(#count#^item.countMissingPinCodes()))}
  </div>
{end:}
</div>
{signature:h}
</body>
</html>
