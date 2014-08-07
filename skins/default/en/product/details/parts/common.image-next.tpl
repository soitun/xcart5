{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product details image box
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="product.details.page.image.photo", weight="15")
 *}
<a IF="product.getImages()&!product.countImages()=1" class="arrow right-arrow" href="javascript:void(0);"><img src="images/spacer.gif" alt="Next image" /></a>
<span IF="!product.getImages()|product.countImages()=1" class="arrow right-arrow"></span>
