/**
 * Module: TYPO3/CMS/SolrEnhancement/ContextMenuActions
 *
 * JavaScript to handle the click action of the "Hello World" context menu item
 * @exports TYPO3/CMS/SolrEnhancement/ContextMenuActions
 */

define(function () {
  'use strict';

  /**
   * @exports TYPO3/CMS/SolrEnhancement/ContextMenuActions
   */
  var ContextMenuActions = {};

  /**
   * Say hello
   *
   * @param {string} table
   * @param {int} uid of the page
   */
  ContextMenuActions.removeFromSolr = function (table, uid) {
    require(['TYPO3/CMS/Core/Ajax/AjaxRequest'], function (AjaxRequest) {
      const request = new AjaxRequest(TYPO3.settings.ajaxUrls.web_list_solrrecordclear).withQueryArguments({
        table: table,
        uid: uid
      });
      request.get().then(
        async function (response) {
          const data = await response.resolve();
          top.TYPO3.Notification.info('Record has been removed');

        }, function (error) {
          console.error('Request failed because of error: ' + error.status + ' ' + error.statusText);
        }
      );
    });

  };

  return ContextMenuActions;
});
