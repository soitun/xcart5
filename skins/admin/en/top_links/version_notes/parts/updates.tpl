{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * "Updates are available" link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="top_links.version_notes", weight="200")
 *}

<li IF="areUpdatesAvailable()" class="updates-note">
  <a href="{buildURL(#upgrade#,##,_ARRAY_(#mode#^#install_updates#))}" title="{t(#Updates for the X-Cart core and/or installed modules are available#)}">
    {t(#Updates are available#)}
  </a>
</li>
