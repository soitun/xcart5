{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Marketplace banner
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<div class="top-controls banner">
  <div class="banner-info main-banner">
    <a class="module-link" href="{getMainBannerURL()}"><img class="module-image" src="{getMainBannerImg()}" alt="" /></a>
    <list name="marketplace.landing.controls" />
  </div>
  <div class="banners-collection-box">
    <div class="banner-info banners-collection" FOREACH="getBannersCollection(),banner">
      <a class="module-link" href="{getBannerURL(banner)}"><img class="module-image" src="{getBannerImg(banner)}" alt="" /></a>
    </div>
  </div>
</div>
