/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Language labels controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

// Open Add language dialog
function openAddNewLanguage(link, page)
{
  var url = xliteConfig.script + '?target=language_select&widget=\\XLite\\View\\LanguagesModify\\AddLanguage';

  loadDialogByLink(link, url, {width: 600, height: 500});

  return false;
}

// Open Add new label dialog
function openAddNewLabel(link, language)
{
  var url = xliteConfig.script + '?target=language_label&widget=\\XLite\\View\\LanguagesModify\\AddLabel';

  if (language) {
    url += '&code=' + language;
  }

  loadDialogByLink(link, url, {width: 600, height: 600});

  return false;
}

// Open Edit label dialog
function openEditLabelDialog(link, id, language)
{
  var url = xliteConfig.script + '?target=language_label&label_id=' + id + '&widget=\\XLite\\View\\LanguagesModify\\EditLabel';

  if (language) {
    url += '&code=' + language;
  }

  loadDialogByLink(link, url, {width: 600, height: 600});

  return false;
}
