{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Language name cell
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<span class="flag"><img src="{entity.getFlagURL()}" /></span>
<a href="{buildURL(#labels#,##,_ARRAY_(#code#^entity.getCode()))}">{entity.getName()}</a>
<widget IF="{getLanguageHelpMessage(entity)}" class="\XLite\View\Tooltip" id="menu-links-help-text" text="{getLanguageHelpMessage(entity):h}" isImageTag="true" className="help-small-icon" />
