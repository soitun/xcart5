{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Product thumbnail zoom
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
{*<div class="product-photo" style="height:{getWidgetMaxHeight()}px; width:{getWidgetMaxWidth()}px">*}
<div class="product-photo">
  <a href="{getZoomImageURL()}" class="cloud-zoom" id="pimage_{product.product_id}" rel="adjustX: {getZoomAdjustX()}, showTitle: false, tintOpacity: 0.5, tint: '#fff', lensOpacity: 0" title="{t(#Thumbnail#)}">
  <widget class="\XLite\View\Image" image="{product.getImage()}" className="photo product-thumbnail" id="product_image_{product.product_id}" verticalAlign="top" alt="{t(#Thumbnail#)}" maxWidth="{getWidgetMaxWidth()}" maxHeight="{getWidgetMaxHeight()}" />
{displayCommentedData(getJSData())}
  </a>
</div>
