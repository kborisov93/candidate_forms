<?php
defined('TYPO3_MODE') or die();

call_user_func(function () {
    \TYPO3\CMS\Core\Utility\ExtensionManagementUtility::addStaticFile(
        'm4solutions_candidate_forms',
        'Configuration/TypoScript',
        'Repeatable form configuration'
    );
});
