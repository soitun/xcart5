/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Sticky panel controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function StickyPanel(base)
{
  base = jQuery(base);
  if (0 < base.length && base.hasClass('sticky-panel')) {
    base.get(0).controller = this;
    this.base = base;

    this.process();
    this.unmarkAsChanged();
    this.unmarkMoreActionAsEnabled();
  }
}

extend(StickyPanel, Base);

// Autoloader
StickyPanel.autoload = function()
{
  jQuery('.sticky-panel').not('.another-sticky').each(
    function() {
      new StickyPanel(this);
    }
  );
};

// Default options
StickyPanel.prototype.defaultOptions = {
  bottomPadding:       0,
  parentContainerLock: true
};

// Panel
StickyPanel.prototype.panel = null;

// Timer resource
StickyPanel.prototype.timer = null;

// Current document
StickyPanel.prototype.doc = null;

// Last scroll top
StickyPanel.prototype.lastScrollTop = null;

// Last height
StickyPanel.prototype.lastHeight = null;

// Panel height
StickyPanel.prototype.panelHeight = null;

// Parent container top range
StickyPanel.prototype.parentContainerTop = null;

// Process widget (initial catch widget)
StickyPanel.prototype.process = function()
{
  // Initialization
  this.panel = this.base.find('.box').eq(0);

  this.base.height(this.panel.outerHeight());

  if (!this.isModal()) {
    this.processReposition();
  }

  // Form change activation behavior
  if (this.isFormChangeActivation()) {
    var form = this.base.parents('form').eq(0);
    form.bind(
      'state-changed',
      _.bind(this.markAsChanged, this)
    );
    form.bind(
      'state-initial',
      _.bind(this.unmarkAsChanged, this)
    );
    form.bind(
      'more-action-enabled',
      _.bind(this.markMoreActionAsEnabled, this)
    );
    form.bind(
      'more-action-initial',
      _.bind(this.unmarkMoreActionAsEnabled, this)
    );
  }
};

// Check - sticky panel in dialog widget or not
StickyPanel.prototype.isModal = function()
{
  return this.base.parents('.ui-dialog').length > 0;
}

// Process rreposition behaviour
StickyPanel.prototype.processReposition = function ()
{
  this.doc = jQuery(window.document);
  this.lastScrollTop = this.doc.scrollTop();
  this.lastHeight = jQuery(window).height();
  this.panelHeight = this.base.height();
  this.parentContainerTop = this.base.parent().offset().top;

  // Assign move operators
  jQuery(window)
    .scroll(_.bind(this.checkRepositionEvent, this))
    .resize(_.bind(this.checkRepositionEvent, this));

  core.bind(
    'stickyPanelReposition',
    _.bind(this.reposition, this)
  );
  this.reposition();
}

// Get options
StickyPanel.prototype.getOptions = function()
{
  var options = this.base.data('options') || {};

  jQuery.each(
    this.defaultOptions,
    function (key, value) {
      if ('undefined' == typeof(options[key])) {
        options[key] = value;
      }
    }
  );

  return options;
};

// Check reposition - need change behavior or not
StickyPanel.prototype.checkRepositionEvent = function()
{
  if (this.timer) {
    clearTimeout(this.timer);
    this.timer = null;
  }

  setTimeout(
    _.bind(this.checkRepositionEventTick, this),
    50
  );
};

// Check reposition - need change behavior or not (on set timer)
StickyPanel.prototype.checkRepositionEventTick = function()
{
  var scrollTop = this.doc.scrollTop();
  var height = jQuery(window).height();
  if (Math.abs(scrollTop - this.lastScrollTop) > 0 || height != this.lastHeight) {
    var resize = height != this.lastHeight;
    this.lastScrollTop = scrollTop;
    this.lastHeight = height;
    this.reposition(resize);
  }
};

// Reposition
StickyPanel.prototype.reposition = function(isResize)
{
  var options = this.getOptions();

  this.panel.stop();

  var boxScrollTop = this.base.offset().top;
  var docScrollTop = this.doc.scrollTop();
  var windowHeight = jQuery(window).height();
  var diff = windowHeight - boxScrollTop + docScrollTop - this.panel.outerHeight() - options.bottomPadding;

  this.panel.css({width: this.base.width()});

  if (0 > diff) {
    if (options.parentContainerLock && this.parentContainerTop > (boxScrollTop + diff)) {
      this.panel.css({position: 'absolute', top: this.parentContainerTop - boxScrollTop});

    } else if ('fixed' != this.panel.css('position')) {
      this.panel.css({
        position: 'fixed',
        top: windowHeight - this.panel.outerHeight() - options.bottomPadding
      });
      this.panel.addClass('sticky');

    } else if (isResize) {
      this.panel.css({position: 'fixed', top: windowHeight - this.panel.outerHeight() - options.bottomPadding});
    }

  } else if (this.panel.css('top') != '0px') {
    this.panel.css({position: 'absolute', top: 0});
    this.panel.removeClass('sticky');
  }
};

// Check - form change activation behavior
StickyPanel.prototype.isFormChangeActivation = function()
{
  return this.base.hasClass('form-change-activation');
};

// Mark as changed
StickyPanel.prototype.markAsChanged = function()
{
  this.getFormChangedButtons().each(
    function() {
      this.enable();
    }
  );

  this.getFormChangedLinks().removeClass('disabled');
};

// Unmark as changed
StickyPanel.prototype.unmarkAsChanged = function()
{
  this.getFormChangedButtons().each(
    function() {
      this.disable();
    }
  );

  this.getFormChangedLinks().addClass('disabled');
};

// Mark as changed
StickyPanel.prototype.markMoreActionAsEnabled = function()
{
  this.getMoreActionButtons().each(
    function() {
      this.enable();
    }
  );
};

// Unmark as changed
StickyPanel.prototype.unmarkMoreActionAsEnabled = function()
{
  this.getMoreActionButtons().each(
    function() {
      this.disable();
    }
  );
};

// Get a form button, which should change as the state of the form
StickyPanel.prototype.getFormChangedButtons = function()
{
  // If there is any element inside the dropdown menu with the "always-enabled" state
  // then we do not disable the toggle list action button
  return (this.base.find('.dropdown-menu .always-enabled').length > 0)
    ? this.base.find('button').not('.always-enabled, .toggle-list-action')
    : this.base.find('button').not('.always-enabled, .more-action, .more-actions');
};

StickyPanel.prototype.getMoreActionButtons = function()
{
  return this.base.find('.more-action, .more-actions');
};

// Get a form links, which should change as the state of the form
StickyPanel.prototype.getFormChangedLinks = function()
{
  return this.base.find('.cancel');
};

// Autoload
core.microhandlers.add(
  'sticky-panel',
  '.sticky-panel',
  function () {
    core.autoload(StickyPanel);
  }
);
