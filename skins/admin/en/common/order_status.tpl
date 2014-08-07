{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * ____file_title____
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}
{if:order.isSelected(#status#,#Q#)}{t(#Queued#)}{end:}
{if:order.isSelected(#status#,#P#)}{t(#Processed#)}{end:}
{if:order.isSelected(#status#,#I#)}{t(#Incomplete#)}{end:}
{if:order.isSelected(#status#,#F#)}{t(#Failed#)}{end:}
{if:order.isSelected(#status#,#D#)}{t(#Declined#)}{end:}
{if:order.isSelected(#status#,#C#)}{t(#Complete#)}{end:}
