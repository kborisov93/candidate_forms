<?php


namespace M4Solutions\CandidateForms\ViewHelpers;


use TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper;
use TYPO3Fluid\Fluid\Core\Rendering\RenderingContextInterface;

class CheckboxViewHelper extends AbstractViewHelper
{
    private const CHECKBOX_IMAGE = __DIR__ . '/../../Resources/Private/Images/cross.svg';
    private const BLANK_IMAGE = __DIR__ . '/../../Resources/Private/Images/blank_cross.svg';

    public function initializeArguments()
    {
        $this->registerArgument(
            'value',
            'boolean',
            'Specifies the checkbox state.',
            true
        );
        $this->registerArgument(
            'text',
            'string',
            'Specifies the text of the checkbox.',
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
        $text  = $arguments['text'];

        return sprintf(
            '<table class="checkbox-field" style="height: 6mm; width: 100%%;" autosize="2.4">' .
            '<tr>' .
            '<td style="width: 6mm; padding: 0 2mm;">' .
            '<img src="%s" style="width: 5mm; height: 5mm; display: inline;" />' .
            '</td>' .
            '<td style="padding: 0;">%s</td>' .
            '</tr>' .
            '</table>',
            $value ? self::CHECKBOX_IMAGE : self::BLANK_IMAGE,
            $text
        );
    }
}
