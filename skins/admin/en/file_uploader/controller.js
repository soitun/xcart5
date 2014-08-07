/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * file uploader controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

// Main class
function FileUploader(base)
{
  this.commonData = jQuery(base).parent().data();
  this.commonData.target = 'files'
  this.callSupermethod('constructor', arguments);
}

function repositionFiles(base)
{
  var min = 10;
  jQuery(base).find('input.input-position').each(
    function () {
      min = parseInt(10 == min ? min : Math.min(this.value, min));
    }
  );

  jQuery(base).find('input.input-position').each(
    function () {
      jQuery(this).attr('value', min);
      min += 10;
    }
  );
}

extend(FileUploader, ALoadable);

FileUploader.autoload = function()
{
  jQuery('div.file-uploader').each(
    function() {
      new FileUploader(this);
    }
  );
  if (jQuery('.multiple-files').length) {
    jQuery('.multiple-files').sortable({
      placeholder:          'ui-state-highlight',
      forcePlaceholderSize: false,
      distance:             10,
      items:                '> div.item',
      update:               function(event, ui)
      {
        repositionFiles(this);
      }
    });
  }
}

FileUploader.prototype.request = function(formData, multiple)
{
  var o = this;

  formData.append('object_id', jQuery(o.base).data('objectId'));
  if (multiple) {
    o = jQuery(document.createElement('div'))
      .addClass('file-uploader')
      .addClass('dropdown')
      .insertBefore(this.base);
    o = new FileUploader(jQuery(o));
  }
  o.base.html('<div class="spinner"><div class="box"><div class="subbox"></div></div></div>');
  jQuery.ajax({
    url: URLHandler.buildURL(o.commonData),
    type: 'post',
    xhr: function() {
      var myXhr = $.ajaxSettings.xhr();
      return myXhr;
    },
    success: function (data) {
      o.loadHandler(null, null, data);
      var multipleFiles = jQuery(o.base).parents('.multiple-files').get(0);
      if (multipleFiles) {
        repositionFiles(multipleFiles);
      }
      var form = jQuery(o.base).parents('form').get(0);
      if (form) {
        jQuery(form).addClass('changed');
        jQuery(form).trigger('state-changed');
      }
    },
    data: formData,
    cache: false,
    contentType: false,
    processData: false
  });
}

// Postprocess widget
FileUploader.prototype.postprocess = function(isSuccess)
{
  if (isSuccess) {
    var o = this;
    var parentDiv = jQuery(o.base).parent();

    jQuery('a.from-computer', o.base).bind(
      'click',
      function (event)
      {
        jQuery('input[type=file]', o.base).click();

        return false;
      }
    );

    jQuery('div.via-url-popup button', o.base).bind(
      'click',
      function (event)
      {
        viaUrlPopup.dialog('close');
        var formData = new FormData();
        o.commonData.action = 'uploadFromURL';
        if (jQuery('input.copy-to-file', jQuery(this).parent()).prop('checked')) {
          formData.append('copy', 1);
        }
        if (viaUrlPopup.data('multiple')) {
          var area = jQuery('textarea.urls', viaUrlPopup);
          var urls = area.val().split('\n');
          for (var x in urls) {
            if (urls[x]) {
              formData.append('url', urls[x]);
              o.request(formData, true);
            }
          }
          area.val('');

        } else if (jQuery('input.url', viaUrlPopup).val()) {
          formData.append('url', jQuery('input.url', viaUrlPopup).val());
          o.request(formData, false);
        }
      }
    );

    jQuery('input[type=file]', o.base).bind(
      'change',
      function (event)
      {
        var formData = new FormData();
        o.commonData.action = 'uploadFromFile';
        for (i = 0; i < this.files.length; i++) {
          formData.append('file', this.files[i]);
          o.request(formData, viaUrlPopup.data('multiple'));
        }
      }
    );

    jQuery('a.via-url', o.base).bind(
      'click',
      function (event)
      {
        viaUrlPopup.dialog('open');
        jQuery('.dropdown').click();

        return false;
      }
    );

    jQuery('li.alt-text .value', o.base).bind(
      'click',
      function (event)
      {
        jQuery(this).hide();
        jQuery('li.alt-text .input-group', o.base).css('display','table');
        jQuery('li.alt-text .input-group input', o.base).focus();

        return false;
      }
    );

    jQuery('input.input-alt', o.base).bind(
      'click',
      function (event)
      {
        return false;
      }
    ).bind(
      'change keydown blur',
      function (event)
      {
        if (!event.keyCode || 13 === event.keyCode) {
          jQuery(this).parent().hide();
          jQuery('li.alt-text .value span', o.base).text(jQuery(this).val());
          jQuery('li.alt-text .value', o.base).show();

          return false;
        }
      }
    );

    jQuery('a.delete', o.base).bind(
      'click',
      function (event)
      {
        if (jQuery(o.base).hasClass('remove-mark')) {
          jQuery(o.base).removeClass('remove-mark');

        } else {
          jQuery(o.base).addClass('remove-mark');
        }
        jQuery('input.input-delete', o.base).click();
        jQuery('.dropdown').click();

        return false;
      }
    );

    var viaUrlPopup = jQuery('.via-url-popup', o.base);
    viaUrlPopup = jQuery('.via-url-popup', o.base).dialog(
      {
        autoOpen:  false,
        draggable: false,
        title:     viaUrlPopup.data('title'),
        width:     500,
        modal:     true,
        resizable: false,
        open:      _.bind(
          function(event, ui) {
            jQuery('.overlay-blur-base').addClass('overlay-blur');
          },
          this
        ),
        close:     _.bind(
          function(event, ui) {
            jQuery('.overlay-blur-base').removeClass('overlay-blur');
          },
          this
        )
      }
    );

  }
}

core.autoload(FileUploader);
