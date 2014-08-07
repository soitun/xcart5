/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Common functions
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */
var URLHandler = {

  mainParams: {target: true, action: true},

  baseURLPart: ('undefined' != typeof(window.xliteConfig) ? xliteConfig.script : 'admin.php') + '?',
  argSeparator: '&',
  nameValueSeparator: '=',

  // Return query param
  getParamValue: function(name, params)
  {
    return name
      + this.nameValueSeparator
      + encodeURIComponent(typeof params[name] === 'boolean' ? Number(params[name]) : params[name]);
  },

  // Get param value for the target and action params
  getMainParamValue: function(name, params)
  {
    return URLHandler.getParamValue(name, params);
  },

  // Get param value for the remained params
  getQueryParamValue: function(name, params)
  {
    return URLHandler.getParamValue(name, params);
  },

  // Build HTTP query
  implodeParams: function(params, method)
  {
    result = '';
    isStarted = false;

    for (x in params) {

      if (isStarted) {
        result += this.argSeparator;
      } else {
        isStarted = true;
      }

      result += method(x, params);
    }

    return result;
  },

  // Implode target and action params
  implodeMainParams: function(params)
  {
    return this.implodeParams(params, this.getMainParamValue);
  },

  // Implode remained params
  implodeQueryParams: function(params)
  {
    return this.implodeParams(params, this.getQueryParamValue);
  },

  // Return some params
  getParams: function(params, toReturn)
  {
    var result = [];

    for (var x in toReturn) {
      if ('undefined' != typeof(params[x])) {
        result[x] = params[x];
      }
    }

    return result;
  },

  // Unset some params
  clearParams: function(params, toClear)
  {
    var result = [];

    for (var x in params) {
      if (!(x in toClear)) {
        result[x] = params[x];
      }
    }

    return result;
  },

  // Compose target and action
  buildMainPart: function(params)
  {
    return this.implodeMainParams(this.getParams(params, this.mainParams));
  },

  // Compose remained params
  buildQueryPart: function(params)
  {
    return this.argSeparator + this.implodeQueryParams(this.clearParams(params, this.mainParams));
  },

  // Compose URL
  buildURL: function(params)
  {
    return this.baseURLPart + this.buildMainPart(params) + this.buildQueryPart(params);
  }
};

/**
 * Columns selector
 */
jQuery(document).ready(
  function() {
    jQuery('input.column-selector').click(
      function(event) {
        if (!this.columnSelectors) {
          var idx = jQuery(this).parents('th').get(0).cellIndex;
          var table = jQuery(this).parents('table').get(0);
          this.columnSelectors = jQuery('tr', table).find('td:eq('+idx+') :checkbox');
        }

        this.columnSelectors.prop('checked', this.checked ? 'checked' : '');
      }
    );
  }
);

// Dialog

// Abstract open dialog
function openDialog(selector, additionalOptions)
{
  additionalOptions = additionalOptions || {};

  var box = jQuery(selector);

  _.each(
    ['h2','h1'],
    function(tag) {
      var elm = box.find(tag);
      if ('undefined' == typeof(additionalOptions.title) || !additionalOptions.title) {
        additionalOptions.title = elm.html();
      }
      elm.remove();
    }
  );

  return popup.open(jQuery(selector), additionalOptions);
}

// Loadable dialog
function loadDialog(url, dialogOptions, callback, link, $this)
{
  openWaitBar();

  var selector = 'tmp-dialog-' + (new Date()).getTime() + '-' + jQuery(link).attr('class').toString().replace(/ /g, '-');

  core.get(
    url,
    function(ajax, status, data) {
      if (data) {
        var div = jQuery(document.body.appendChild(document.createElement('div')))
          .hide()
          .html(jQuery.trim(data));

        if (1 == div.get(0).childNodes.length) {
          div = jQuery(div.get(0).childNodes[0]);
        }

        // Specific CSS class to manage this specific popup window
        div.addClass(selector);

        // Every popup window (even hidden one) has this one defined CSS class.
        // You should use this selector to manage any popup window entry.
        div.addClass('popup-window-entry');

        openDialog('.' + selector, dialogOptions);

        if (callback) {
          callback.call($this, '.' + selector, link);
        }
      }
    }
  );

  return '.' + selector;
}

// Load dialog by link
function loadDialogByLink(link, url, options, callback, $this)
{
  if (!link.linkedDialog || jQuery(link).hasClass('always-reload')) {
    link.linkedDialog = loadDialog(url, options, callback, link, $this);

  } else {
    openDialog(link.linkedDialog, options, callback);
  }
}

function openWaitBar()
{
  popup.openAsWait();
}

function closeWaitBar()
{
  popup.close();
}

// Check for the AJAX support
function hasAJAXSupport()
{
  if (typeof(window.ajaxSupport) == 'undefined') {
    window.ajaxSupport = false;
    try {

      var xhr = window.ActiveXObject ? new ActiveXObject('Microsoft.XMLHTTP') : new XMLHttpRequest();
      window.ajaxSupport = xhr ? true : false;

    } catch(e) { }
  }

  return window.ajaxSupport;
}

// Check list of checkboxes
function checkMarks(form, reg, lbl) {
  var is_exist = false;

  if (!form || form.elements.length == 0)
    return true;

  for (var x = 0; x < form.elements.length; x++) {
    if (
      form.elements[x].type == 'checkbox'
      && form.elements[x].name.search(reg) == 0
      && !form.elements[x].disabled
    ) {
      is_exist = true;

      if (form.elements[x].checked)
        return true;
    }
  }

  if (!is_exist)
    return true;

  if (lbl) {
    alert(lbl);

  } else if (lbl_no_items_have_been_selected) {
    alert(lbl_no_items_have_been_selected);

  }

  return false;
}

/*
  Parameters:
  checkboxes       - array of tag names
  checkboxes_form    - form name with these checkboxes
*/
function change_all(flag, formname, arr) {
  if (!formname)
    formname = checkboxes_form;
  if (!arr)
    arr = checkboxes;
  if (!document.forms[formname] || arr.length == 0)
    return false;
  for (var x = 0; x < arr.length; x++) {
    if (arr[x] != '' && document.forms[formname].elements[arr[x]] && !document.forms[formname].elements[arr[x]].disabled) {
         document.forms[formname].elements[arr[x]].checked = flag;
      if (document.forms[formname].elements[arr[x]].onclick)
        document.forms[formname].elements[arr[x]].onclick();
    }
  }
}

function checkAll(flag, form, prefix) {
  if (!form) {
    return;
  }

  if (prefix) {
    var reg = new RegExp('^' + prefix, '');
  }
  for (var i = 0; i < form.elements.length; i++) {
    if (
      form.elements[i].type == "checkbox"
      && (!prefix || form.elements[i].name.search(reg) == 0)
      && !form.elements[i].disabled
    ) {
      form.elements[i].checked = flag;
    }
  }
}

/*
  Opener/Closer HTML block
*/
function visibleBox(id, skipOpenClose)
{
  var elm1 = document.getElementById('open' + id);
  var elm2 = document.getElementById('close' + id);
  var elm3 = document.getElementById('box' + id);

  if(!elm3) {
    return false;
  }

  if (skipOpenClose) {
    elm3.style.display = (elm3.style.display == '') ? 'none' : '';

  } else if (elm1) {
    if (elm1.style.display == '') {
      elm1.style.display = 'none';

      if (elm2) {
        elm2.style.display = '';
      }

      elm3.style.display = 'none';
      jQuery('.DialogBox').css('height', '1%');

    } else {
      elm1.style.display = '';
      if (elm2) {
        elm2.style.display = 'none';
      }

      elm3.style.display = '';
    }
  }

  return true;
}

/**
 * Attach tooltip to some element on hover action
 */
function attachTooltip(elm, content) {
  jQuery(elm).each(
    function () {
      if (isBootstrapUse()) {
        jQuery(this).tooltip({
          html:      true,
          title:     content,
          placement: 'right'
        });
      } else {
        jQuery(this).tooltip({
          items:     this,
          'content': content
        });

      }
    }
  );
}

/**
 * Overlay registry
 */
var waitOverlayRegistry = {};

function assignWaitOverlay(elem)
{
  pattern = elem.prop('class');
  if (!_.isUndefined(elem.get(0).waitOverlay) && elem.get(0).waitOverlay) {
    unassignWaitOverlay(elem);
  }

  var div = jQuery('<div class="wait-block-overlay"><div class="wait-block"><div></div></div></div>');

  var offset = elem.offset();
  div.css({
    top:    offset.top + 'px',
    left:   offset.left + 'px',
    width:  elem.outerWidth() + 'px',
    height: elem.outerHeight() + 'px'
  });

  // We do not show the overlay if the element has zero width or height (the element is not visible)
  if (0 !== elem.outerWidth() && 0 !==  elem.outerHeight()) {
    jQuery('body').append(div);
  }

  waitOverlayRegistry[pattern] = div;
  elem.get(0).waitOverlay = div;

  elem.trigger('assignOverlay', { widget: elem });

  return div;
}

function unassignWaitOverlay(elem, force)
{
  pattern = elem.prop('class');
  var overlay = null;
  if (waitOverlayRegistry[pattern]) {
    overlay = waitOverlayRegistry[pattern];

  } else if (force) {
    overlay = jQuery('.wait-block-overlay').eq(0);
  }

  if (overlay) {
    overlay.remove();
    if (elem.get(0)) {
      elem.trigger('unassignOverlay', { widget: elem });
      elem.get(0).waitOverlay = null;
    }
  }
}

function isBootstrapUse()
{
  return 'undefined' != typeof(jQuery.fn.modal)
    && _.isFunction(jQuery.fn.modal);
}

/**
 * State widget specific objects and methods (used in select_country.js )
 * @TODO : Move it to the one object after dynamic loading widgets JS implementation
 */
var statesList = [];
var stateSelectors = [];

function UpdateStatesList(base)
{
  var _stateSelectors;

  base = base || document;

  jQuery('.country-selector', base).each(function (index, elem) {
    statesList = array_merge(statesList, core.getCommentedData(elem, 'statesList'));
    _stateSelectors = core.getCommentedData(elem, 'stateSelectors');

    stateSelectors[_stateSelectors.fieldId] = new StateSelector(
      _stateSelectors.fieldId,
      _stateSelectors.stateSelectorId,
      _stateSelectors.stateInputId
    );
  });
}

jQuery(document).ready(
  function() {
    // Open warning popup
    core.microhandlers.add(
      'OverlayHeightResize',
      '*:first',
      function(event) {
        jQuery('.ui-widget-overlay').css('height', jQuery(document).height());
        jQuery('.ui-widget-overlay').css('width', jQuery('body').innerWidth());
      }
    );

    core.microhandlers.add(
      'PopupModelButtonWidthFix',
      '.model-form-buttons',
      function (event) {
        jQuery('.ajax-container-loadable .model-form-buttons')
          .each(function (index, elem) {
            jQuery('.button', elem).width(jQuery(elem).width());
          });
      }
    );
});
