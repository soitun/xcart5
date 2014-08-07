{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Membership field value in view mode
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:getMembershipName()}
{getMembershipName()}
{else:}
{t(#All customers wholesale#)}
{end:}
