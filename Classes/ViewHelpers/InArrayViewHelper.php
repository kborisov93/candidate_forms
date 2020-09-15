<?php


namespace M4Solutions\CandidateForms\ViewHelpers;


use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

class InArrayViewHelper extends AbstractViewHelper
{
    public function initializeArguments()
    {
        $this->registerArgument(
            'haystack',
            'array',
            'The array to test.',
            true
        );
        $this->registerArgument(
            'needle',
            'string',
            'The string to search for.'
        );
    }


    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $haystack = $arguments['haystack'];
        $needle   = $arguments['needle'];
        if (is_numeric($needle)) {
            $needle = (string)$needle;
        }

        return in_array($needle, $haystack, true) ? 1 : 0;
    }
}
