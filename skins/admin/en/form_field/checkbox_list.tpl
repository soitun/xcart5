{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Checkbox list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<ul {getAttributesCode():h}>
{displayCommentedData(getCommentedData())}
{foreach:getOptions(),optionValue,optionLabel}
<li><label><input {getOptionAttributesCode(optionValue):h} /> {optionLabel:stripTags}</label></li>
{end:}
</ul>
