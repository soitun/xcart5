{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Link to the Module marketplace terms of use page
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *
 * @ListChild (list="admin.main.page.footer.right", weight="150")
 *}

<a IF="getTarget()=#addons_list_marketplace#|getTarget()=#addons_list_installed#" href="{getXCartURL(#http://www.x-cart.com/module-marketplace-terms-of-use.html#)}" target="_blank">{t(#Module Marketplace. Terms of use#)}</a>
