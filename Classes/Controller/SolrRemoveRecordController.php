<?php

declare(strict_types=1);

namespace StudioMitte\SolrEnhancement\Controller;

use ApacheSolrForTypo3\Solr\ConnectionManager;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use StudioMitte\SolrEnhancement\ContextMenu\AccessCheck;
use TYPO3\CMS\Backend\Utility\BackendUtility;
use TYPO3\CMS\Core\Authentication\BackendUserAuthentication;
use TYPO3\CMS\Core\Http\JsonResponse;
use TYPO3\CMS\Core\Localization\LanguageService;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class SolrRemoveRecordController
{
    protected AccessCheck $accessCheck;

    public function __construct(AccessCheck $accessCheck = null)
    {
        $this->accessCheck = $accessCheck ?: GeneralUtility::makeInstance(AccessCheck::class);
    }

    public function mainAction(ServerRequestInterface $request): ResponseInterface
    {
        $parsedBody = $request->getParsedBody();
        $queryParams = $request->getQueryParams();
        $recordUid = (int)($parsedBody['uid'] ?? $queryParams['uid'] ?? 0);
        $table = $parsedBody['table'] ?? $queryParams['table'] ?? '';
        $language = null;

        if ($this->accessCheck->tableIsValid($table)) {
            $pageId = null;

            $connectionManager = GeneralUtility::makeInstance(ConnectionManager::class);
            $fullRecord = BackendUtility::getRecord($table, $recordUid);
            if ($fullRecord) {
                if ($table !== 'pages') {
                    $pageId = $fullRecord['pid'];
                    $language = $fullRecord['sys_language_uid'] ?? 0;
                } else {
                    $pageId = $recordUid;
                    $language = $fullRecord['sys_language_uid'];
                }
            }

            if ($pageId) {
                $connection = $connectionManager->getConnectionByPageId($pageId, $language);
                $connection->getWriteService()->deleteByQuery(sprintf('type:%s AND uid:%s', $table, $recordUid));
            }
        }

        return new JsonResponse([
            'success' => true,
            'title' => 'cleared',
            'message' => ''
        ]);
    }

    protected function getBackendUserAuthentication(): BackendUserAuthentication
    {
        return $GLOBALS['BE_USER'];
    }

    protected function getLanguageService(): LanguageService
    {
        return $GLOBALS['LANG'];
    }
}
