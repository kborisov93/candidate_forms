<?php


declare(strict_types=1);

namespace M4Solutions\CandidateForms\Domain\Finishers;


use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use Office365\SharePoint\ClientContext;
use TYPO3\CMS\Core\Exception;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

class CandidatureFormFinisher extends \TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher
{
    private $assign_multiple;

    /**
     * Executes this finisher
     *
     * @throws FinisherException
     * @see AbstractFinisher::execute()
     *
     */

    protected function executeInternal()
    {
        DebuggerUtility::var_dump($this);
        $values = $this->finisherContext->getFormValues();
        DebuggerUtility::var_dump($values);

        $clientId     = $this->parseOption('clientId');
        $clientSecret = $this->parseOption('clientSecret');
        $siteUrl      = $this->parseOption('siteUrl');
        $listName     = $this->parseOption('listName');
        DebuggerUtility::var_dump($siteUrl);

        $values['logoSrc'] = __DIR__ . '/../../../Resources/Private/Images/logo.svg';
        $view              = $this->objectManager->get(StandaloneView::class);

        $view->setFormat('html');
        $view->setTemplatePathAndFilename(__DIR__ . '/../../../Resources/Private/Templates/candidature-form-pdf.html');
        $view->assignMultiple(
            array(
                'logoSrc'                  => __DIR__ . '/../../../Resources/Private/Images/logo.svg',
                'contentelement-1'         => null,
                'application-for'          => 'Lorem ipsum dolor sit amet',
                'gridrow-1'                => null,
                'given-name'               => 'Lorem',
                'surname'                  => 'ipsum',
                'born-surname'             => 'ipsum',
                'gridrow-2'                => null,
                'date-of-birth'            => '01.01.2000',
                'place-of-birth'           => 'Pellentesque',
                'nationality'              => 'Aliquam',
                'gridrow-3'                => null,
                'confession'               => 'maximus libero',
                'family-status'            => 'commodo',
                'children'                 => '1',
                'address'                  => 'Sed a dolor dapibus 1',
                'gridrow-4'                => null,
                'postal-code'              => '1234',
                'residence'                => 'Donec',
                'gridrow-5'                => null,
                'telephone'                => '088888888',
                'mobile'                   => '088888999',
                'email'                    => 'demo@demo.com',
                'gridrow-6'                => null,
                'driving-licence'          => array(0 => 'JA | tak | yes',),
                'driving-licence-category' => '123',
                'automobile'               => array(0 => 'JA | tak | yes',),
                'contentelement-2'         => null,
                'gridrow-7'                => null,
                'education'                => array(
                    0 => array(
                        'primary-education-institution' => 'eleifend tempor',
                        'primary-education-complete'    => array(0 => 'JA | tak | yes',),
                        'gridrow-16'                    => null,
                    ),
                    1 => array(
                        'primary-education-institution' => 'Lorem ipsum dolor sit amet',
                        'primary-education-complete'    => array(0 => 'JA | tak | yes',),
                        'gridrow-16'                    => null,
                    ),
                    2 => array(
                        'primary-education-institution' => 'UNSS',
                        'primary-education-complete'    => array(0 => 'NEIN | nie | no',),
                        'gridrow-16'                    => null,
                    ),
                ),
                'gridrow-9'                => null,
                'university-education'     => array(
                    0 => array(
                        'study'          => 'venenatis sed',
                        'study-complete' => array(0 => 'JA | tak | yes',),
                        'gridrow-17'     => null,
                    ),
                ),
                'gridrow-12'               => null,
                'training'                 => array(
                    0 => array(
                        'training-name'     => ' sodales ornare',
                        'training-complete' => array(0 => 'JA | tak | yes',),
                        'gridrow-18'        => null,
                    ),
                ),
                'gridrow-8'                => null,
                'certificates'             => array(
                    0 => array(
                        'certificate-name'     => ' sodales ornare',
                        'certificate-complete' => array(0 => 'NEIN | nie | no',),
                        'gridrow-19'           => null,
                    ),
                ),
                'gridrow-10'               => null,
                'courses'                  => array(
                    0 => array(
                        'course-name'     => ' sodales ornare',
                        'course-complete' => array(0 => 'NEIN | nie | no',),
                        'gridrow-20'      => null,
                    ),
                ),
                'contentelement-3'         => null,
                'first-language'           => 'Bulgarisch',
                'gridrow-11'               => null,
                'other-languages'          => array(
                    0 => array(
                        'language'           => 'Englisch',
                        'language-knowledge' => array(0 => '3',),
                        'gridrow-21'         => null,
                    ),
                ),
                'contentelement-4'         => null,
                'gridrow-13'               => null,
                'vocational-training'      => array(
                    0 => array(
                        'training-period' => '01.01.2020',
                        'training-school' => 'Pellentesque',
                        'training-degree' => 'Donec facilisis',
                    ),
                ),
                'contentelement-5'         => null,
                'gridrow-14'               => null,
                'professional-activity'    => array(
                    0 => array(
                        'activity-period'  => '01.01.2020',
                        'activity-company' => 'Pellentesque',
                        'job-description'  => 'Donec facilisis',
                    ),
                ),
                'contentelement-6'         => null,
                'gridrow-15'               => null,
                'entry-date'               => '01.01.2000',
                'temporary-appointment'    => array(0 => 'JA | tak | yes',),
                'hear-about-us'            => 'Pellentesque eget maximus libero. Nunc consectetur egestas fringilla. Nullam venenatis leo sit amet aliquet malesuada. Fusce id fringilla dui. Sed aliquam, nibh at varius commodo, sapien ante blandit nibh, eu luctus odio mi at mauris. Mauris efficitur vestibulum nisi, at rutrum ligula hendrerit ut. Sed a dolor dapibus, porta erat a, gravida ex. Quisque volutpat urna et turpis faucibus elementum. ',
                'contentelement-7'         => null,
                'futher-information'       => 'Etiam vitae placerat lectus. Donec facilisis, ante eu pharetra euismod, nisl lectus fringilla lectus, eget volutpat tellus mi et erat. Donec faucibus justo et lectus commodo convallis. Vivamus aliquam molestie semper. In sit amet magna vitae libero cursus ultrices. Sed sit amet leo ac velit aliquam tincidunt. Donec sagittis ex vitae metus gravida pretium. Nam maximus, risus quis rhoncus suscipit, lacus lacus elementum sem, id viverra ex nisl a odio. Maecenas laoreet pretium ante, in tristique risus lobortis non. ',
                'confirmation'             => '1',
                'contentelement-9'         => null,
                'checkbox-2'               => '1',
                'contentelement-8'         => null,
                'XGauw'                    => '',
            )

        );

        $stylesheet = file_get_contents(__DIR__ . '/../../../Resources/Private/Styles/candidature-form.css');

        $mpdf = new Mpdf(
            [
                'mode'              => 'utf-8',
                'format'            => 'A4',
                'orientation'       => 'P',
                'fontDir'           => __DIR__ . '/../../../Resources/Private/Fonts',
                'fontdata'          => [
                    'opensans' => [
                        'R' => 'OpenSans-Regular.ttf',
                        'B' => 'OpenSans-Bold.ttf'
                    ]
                ],
                'default_font'      => 'opensans',
                'setAutoTopMargin'  => 'stretch',
                'autoMarginPadding' => 3,
            ]
        );

        $mpdf->WriteHTML($stylesheet, HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($view->render(), HTMLParserMode::HTML_BODY);

        try {
            $ctx        = ClientContext::connectWithClientCredentials($siteUrl, $clientId, $clientSecret);
            $targetList = $ctx->getWeb()->getLists()->getByTitle($listName);
            $uploadFile = $targetList->getRootFolder()->uploadFile(
                'candidature ' . date('d-m-Y His') . ' ' . $values['surname'] . ' ' . $values['given-name']. '.pdf',
                $mpdf->Output('name', Destination::STRING_RETURN)
            );
            $ctx->executeQuery();
            print "File {$uploadFile->getServerRelativeUrl()} has been uploaded\r\n";
        } catch (\Exception $e) {
            echo 'Error: ', $e->getMessage();
        }
    }

}
