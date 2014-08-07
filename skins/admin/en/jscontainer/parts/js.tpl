{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Not cached JS part
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="jscontainer.js", weight="100")
 *}
{if:!doJSAggregation()}
<script FOREACH="getJSResources(),file" type="text/javascript" src="{getResourceURL(file.url)}"></script>
{end:}
