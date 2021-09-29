<?php

declare(strict_types=1);

namespace StudioMitte\SolrEnhancement\ContextMenu;

use TYPO3\CMS\Core\Configuration\ExtensionConfiguration;
use TYPO3\CMS\Core\Utility\GeneralUtility;

class AccessCheck
{
    public static function tableIsValid(string $tableName): bool
    {
        $settings = GeneralUtility::makeInstance(ExtensionConfiguration::class)->get('solr_enhancement');
        $tables = GeneralUtility::trimExplode(',', $settings['tables'] ?? '', true);
        return in_array($tableName, $tables, true);
    }
}
