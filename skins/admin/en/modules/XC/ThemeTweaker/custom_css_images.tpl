{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Custom CSS template
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<widget class="\XLite\Module\XC\ThemeTweaker\View\Form\CustomCssImages" name="form" />

  <widget class="\XLite\Module\XC\ThemeTweaker\View\Images" />

  <div class="new-image">
    {t(#New image#)}: <input type="file" name="new_image" />
  </div>

  <div class="buttons">
    <widget class="\XLite\View\Button\Submit" style="action" label="Save changes" />
  </div>

<widget name="form" end />
