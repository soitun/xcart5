/* vim: set ts=2 sw=2 sts=2 et: */

/**
 * Reviews list controller
 *
 * @author    Qualiteam software Ltd <info@x-cart.com>
 * @copyright Copyright (c) 2011-2014 Qualiteam software Ltd <info@x-cart.com>. All rights reserved
 * @license   http://www.x-cart.com/license-agreement.html X-Cart 5 License Agreement
 * @link      http://www.x-cart.com/
 */

function ReviewsListView(base)
{
  ReviewsListView.superclass.constructor.apply(this, arguments);
}

extend(ReviewsListView, ListView);

// Reviews list class
function ReviewsListController(base)
{
  ReviewsListController.superclass.constructor.apply(this, arguments);
}

extend(ReviewsListController, ListsController);

ReviewsListController.prototype.name = 'ReviewsListController';
ReviewsListController.prototype.findPattern = '.product-average-rating';

ReviewsListController.prototype.getListView = function()
{
  return new ReviewsListView(this.base);
};

// Get event namespace (prefix)
ReviewsListView.prototype.getEventNamespace = function()
{
  return 'list.reviews';
};

/**
 * Load reviews lists controller
 */
core.autoload(ReviewsListController);
