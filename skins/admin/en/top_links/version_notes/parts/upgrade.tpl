{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * "Upgrade core" link
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="top_links.version_notes", weight="300")
 *}

<li IF="isCoreUpgradeAvailable()&!areUpdatesAvailable()" class="upgrade-note">
  <widget class="\XLite\View\Upgrade\SelectCoreVersion\Link" />
</li>
