/**
 * Module: TYPO3/CMS/SolrEnhancement/ContextMenuActions9
 *
 * @exports TYPO3/CMS/SolrEnhancement/ContextMenuActions9
 */

define(function () {
    'use strict';

    /**
     * @exports TYPO3/CMS/SolrEnhancement/ContextMenuActions9
     */
    var ContextMenuActions9 = {};

    /**
     * @param {string} table
     * @param {int} uid of the page
     */
    ContextMenuActions9.removeFromSolr = function (table, uid) {

        $.ajax({
            url: TYPO3.settings.ajaxUrls['web_list_solrrecordclear'],
            data: {
                table: table,
                uid: uid
            }
        }).done(function (data) {
            // the parent node needs to be overwritten, not the object
            top.TYPO3.Notification.info('Record has been removed');

        });

    };

    return ContextMenuActions9;
});
