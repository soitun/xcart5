/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Common rountines
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

jQuery(document).ready(
function () {
  var module = _.keys(hash.get())[0];
  if (module) {
    jQuery('.module-' + module).addClass('active');
    window.setTimeout(function () {
      window.scrollBy(0, -150);
      jQuery('.module-' + module).addClass('non-active');
    }, 500);
  }
});


function confirmNote(action, id)
{

  var extraTxt = '';

  if (
    'disable' == action
    && typeOf(id) !== undefined
    && depends[id]
    && depends[id].length > 0
  ) {
    extraTxt = "\n" + dependedAlert + "\n";

    for (i in depends[id]) {
      extraTxt += depends[id][i] + "\n";
    }
  }

  text = confirmNotes[action] ? confirmNotes[action] + extraTxt : confirmNotes['default'];

  return text;
}
