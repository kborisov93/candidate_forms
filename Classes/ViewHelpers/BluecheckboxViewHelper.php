<?php


namespace M4Solutions\CandidateForms\ViewHelpers;

use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

class BluecheckboxViewHelper extends AbstractViewHelper
{
    private const CHECKBOX_IMAGE = __DIR__ . '/../../Resources/Private/Images/blue-bg-cross.svg';

    public function initializeArguments()
    {
        $this->registerArgument(
            'value',
            'boolean',
            'Specifies the checkbox state.',
            true
        );
    }

    protected $escapeOutput = false;

    public static function renderStatic(
        array $arguments,
        \Closure $renderChildrenClosure,
        RenderingContextInterface $renderingContext
    ) {
        $value = $arguments['value'];

        $img = sprintf('<img src="%s" style="width: 5mm; height: 5mm;" />',self::CHECKBOX_IMAGE );
        return  $value ? $img : '';
    }
}
