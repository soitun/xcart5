{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * The "Try again" button
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.step.ready_to_install.buttons.sections", weight="200")
 *}

<widget IF="!isNextStepAvailable()" class="\XLite\View\Button\Link" label="{t(#Check again#)}" style="main-button" location="{buildURL(#upgrade#,#check_integrity#)}" />
