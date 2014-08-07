/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Common button controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2013 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function setFormAttribute(form, name, value)
{
  form.elements[name].value = value;
}

function setFormAction(form, action)
{
    setFormAttribute('action', action);
}

function submitForm(form, attrs)
{
  jQuery.each(
    attrs,
    function (name, value) {
      var e = form.elements.namedItem(name);
      if (e) {
        e.value = value;
      }
    }
  );

	jQuery(form).submit();
}

function submitFormDefault(form, action)
{
	var attrs = {};
  if (typeof(action) != 'undefined' && action !== null) {
  	attrs['action'] = action;
  }

	submitForm(form, attrs);
}
