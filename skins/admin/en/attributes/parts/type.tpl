{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Type 
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div{if:productClass} data-class-id="{productClass.getId()}"{end:} data-id="{entity.getId()}" />
<a href="javascript: void(0);" class="edit-attribute" label="{t(#Edit attribute#)}"><span>{t(#Edit attribute#)}</span></a>
{t(entity.getTypes(entity.getType()))}
</div>
