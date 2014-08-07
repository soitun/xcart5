{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Display product attribute values in invoice
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
<li FOREACH="item.getAttributeValues(),av" style="color: #5a5a5a;line-height: 1.6em;margin: 0px;padding: 0px;list-style: none;background: transparent none;">{av.getName()}: {av.getValue()}</li>
