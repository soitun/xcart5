{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Reviewer name and link to his profile (if registered)
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

{if:getProfileId(entity)}
<a href="{buildURL(#profile#,##,_ARRAY_(#profile_id#^getProfileId(entity)))}">
{end:}
{if:entity.reviewerName}
  {entity.reviewerName}
{else:}
  {t(#Unknown#)}
{end:}
{if:entity.email}&nbsp;({entity.email}){end:}
{if:getProfileId(entity)}</a>{end:}
