import AjaxRequest from "@typo3/core/ajax/ajax-request.js";

class ContextMenuActions {

    removeFromSolr(table, uid) {
        const request = new AjaxRequest(TYPO3.settings.ajaxUrls.web_list_solrrecordclear).withQueryArguments({
            table: table,
            uid: uid
        });
        request.get().then(
            async function (response) {
                const data = await response.resolve();
                // not working in 11?
                top.TYPO3.Notification.info('Record has been removed');

            }, function (error) {
                console.error('Request failed because of error: ' + error.status + ' ' + error.statusText);
            }
        );
    };
}

export default new ContextMenuActions();