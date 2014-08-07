{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Module status
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="upgrade.install_updates.sections.form.info.module", weight="200")
 *}

<li class="enabled" IF="entry.isEnabled()">{t(#enabled#)}</li>
<li class="disabled" IF="!entry.isEnabled()">{t(#now disabled#)}</li>
