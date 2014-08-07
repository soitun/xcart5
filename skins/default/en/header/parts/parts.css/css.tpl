{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Header part
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="head.css", weight="100")
 *}
{if:!doCSSAggregation()}
<link FOREACH="getCSSResources(),file" href="{getResourceURL(file.url)}" rel="stylesheet" type="text/css" media="{file.media}" />
{end:}
