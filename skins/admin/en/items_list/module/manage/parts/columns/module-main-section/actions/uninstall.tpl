{* vim: set ts=2 sw=2 sts=2 et: *}

{**
 * Modules actions list
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 *}

<a class="uninstall fa fa-trash-o"
  href="{buildURL(#addons_list_installed#,#uninstall#,_ARRAY_(#moduleId#^module.getModuleId(),%\XLite::FORM_ID%^%\XLite::getFormId()%))}"
  onclick="javascript: return confirm(confirmNote('uninstall', '{module.getModuleId()}'));"></a>
