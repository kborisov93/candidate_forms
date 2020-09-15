<?php

declare(strict_types=1);

namespace M4Solutions\CandidateForms\Domain\Finishers;


use Mpdf\HTMLParserMode;
use Mpdf\Mpdf;
use Mpdf\Output\Destination;
use TYPO3\CMS\Extbase\Utility\DebuggerUtility;
use TYPO3\CMS\Fluid\View\StandaloneView;

class CompanyFormFinisher extends \TYPO3\CMS\Form\Domain\Finishers\AbstractFinisher
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
        $clientId     = $this->parseOption('clientId');
        $clientSecret = $this->parseOption('clientSecret');
        $siteUrl      = $this->parseOption('siteUrl');
        $listName     = $this->parseOption('listName');
        DebuggerUtility::var_dump($values);

        $view = $this->objectManager->get(StandaloneView::class);

        $view->setFormat('html');
        $view->setTemplatePathAndFilename(__DIR__ . '/../../../Resources/Private/Templates/company-form-pdf.html');
        $view->assignMultiple(
            array(
                'crossSrc'                                 => __DIR__ . '/../../../Resources/Private/Images/cross.svg',
                'blankSrc'                                 => __DIR__ . '/../../../Resources/Private/Images/blank_cross.svg',
                'logoSrc'                                  => __DIR__ . '/../../../Resources/Private/Images/logo.svg',
                'company-name'                             => 'KEY DEVELOPMENT OOD',
                'client-no'                                => '12345678',
                'project'                                  => 'DEMO DEMO',
                'contact-person'                           => 'ANGEL MILANOV',
                'devision'                                 => 'SOFTWARE-ENTWICKLUNG',
                'function'                                 => 'ARCHITEKT',
                'address-1'                                => 'SLIVNITSA 141',
                'zip-code'                                 => '1233',
                'city'                                     => 'SOFIA',
                'phone'                                    => '35988888888',
                'mobile-phone'                             => '35988888888',
                'email'                                    => 'A.MILANOV@KEYDEV.EU',
                'vat-id'                                   => 'BG203409100',
                'employment-reason'                        => array(
                    0 => 'NEUE STELLE',
                    1 => 'NACHFOLGE',
                    2 => 'ZUSÄTZLICHER BEDARF',
                ),
                'gridrow-5'                                => null,
                'employment-reason-others-checkbox'        => '1',
                'employment-reason-others-text'            => 'fixe deine felder',
                'vacancy-duration'                         => array(0 => 'NEU', 1 => 'MEHR ALS 6 MONATE',),
                'actions-taken'                            => array(0 => 'MASSNAHME BEENDET',),
                'concrete-actions-taken-1'                 => array(0 => 'INTERN', 1 => 'EXTERN',),
                'concrete-actions-taken-2'                 => array(0 => 'INTERNET', 1 => 'SOCIAL MEDIA',),
                'contentelement-4'                         => null,
                'applications-recieved'                    => array(0 => 'ÜBER 10',),
                'applications-satisfaction'                => array(0 => 'MITTEL',),
                'gridrow-6'                                => null,
                'application-satisfaction-reason-checkbox' => '1',
                'application-satisfaction-reason-text'     => 'Es ist so',
                'contentelement-5'                         => null,
                'recruitment-type'                         => array(0 => 'ARBEITERNEHMERÜBERLASSUNG',),
                'gridrow-7'                                => null,
                'recruitment-type-other-checkbox'          => '1',
                'recruitment-type-other-text'              => 'Sonstige Informationen',
                'starting-date'                            => array(0 => 'SOFORT',),
                'starting-date-text'                       => '12.01.1012',
                'contractual-relationship'                 => array(0 => 'UNBEFRISTET',),
                'contractual-relationship-text'            => '123123',
                'gridrow-18'                               => null,
                'job-designation'                          => array(
                    0 => array('designation' => 'PHP PRORAMMIERER',),
                    1 => array('designation' => 'TYPO3 PROGRAMMIER',),
                    2 => array('designation' => 'SONSTIER ENTWICKLER',),
                ),
                'required-employee-count'                  => '12',
                'location'                                 => 'SOFIA',
                'area-of-employment'                       => array(
                    0 => array('area' => 'SOFTWARE ENTWICKLUNG',),
                    1 => array('area' => 'INTERESSANTE SACHEN',),
                ),
                'qualifications'                           => array(
                    0 => array('qualification' => 'SQL',),
                    1 => array('qualification' => 'PHP',),
                    2 => array('qualification' => 'JAVA',),
                ),
                'gridrow-19'                               => null,
                'soft-skills'                              => array(
                    0 => array('skill' => 'ANSPRECHBAR',),
                    1 => array('skill' => 'NICHT IDIOTEN',),
                ),
                'other-qualifications'                     => array(
                    0 => array('other-qualification' => 'GESELLIG',),
                    1 => array('other-qualification' => 'TECHNICHER GEDANKE ZU HABEN',),
                ),
                'experience'                               => array(0 => 'ÜBER 10 JAHRE',),
                'leadership'                               => array(0 => 'NEIN',),
                'team-size'                                => array(0 => 'BIS 5 MITARBEITER',),
                'computer-skills'                          => array(
                    0 => array('computer-skills-text' => 'MIT COMPUTER ARBEITEN ZU KÖNNEN',),
                    1 => array('computer-skills-text' => 'MSOFFICE',),
                    2 => array('computer-skills-text' => 'PROGRAMMEN',),
                ),
                'gridrow-11'                               => null,
                'mother-tongue'                            => array(0 => 'MUTTERSPRACHE:',),
                'mother-tongue-text'                       => 'TÜRKISCH',
                'foreign-languages'                        => array(
                    0 => array(
                        'language'    => 'BULGARISCH',
                        'proficiency' => array(0 => 'KONVERSATIONSSICHER',),
                    ),
                    1 => array(
                        'language'    => 'ENGLISCH',
                        'proficiency' => array(
                            0 => 'KONVERSATIONSSICHER',
                            1 => 'GRUNDKENNTNISSE',
                        ),
                    ),
                ),
                'gridrow-12'                               => null,
                'mobility'                                 => array(0 => 'FAHRERLAUBNIS', 1 => 'KLASSEN:',),
                'driving-licence'                          => 'B, M',
                'gridrow-13'                               => null,
                'working-time-full-time'                   => array(0 => 'VOLLZEIT',),
                'working-time-full-time-text'              => '40',
                'working-time-part-time'                   => array(0 => 'TEILZEIT',),
                'working-time-part-time-text'              => '20',
                'working-time-minor'                       => '',
                'working-time-minor-text'                  => '',
                'working-time-other'                       => '',
                'working-time-other-text'                  => '',
                'gridrow-14'                               => null,
                'extra-time-regulation'                    => array(0 => 'ÜBERSTUNDENKONTO', 1 => 'SONSTIGES'),
                'extra-time-regulation-text'               => 'asdads',
                'gridrow-15'                               => null,
                'salary-year'                              => '',
                'salary-year-text'                         => '',
                'salary-hourly-rate'                       => array(0 => 'BRUTTO- STUNDENGEHALT',),
                'salary-hourly-rate-text'                  => '40',
                'gridrow-16'                               => null,
                'benefits-1'                               => array(0 => 'BONIFIKATION', 1 => 'PROVISION',),
                'benefits-2'                               => array(0 => 'JOBTICKET', 1 => 'SONSTIGE'),
                'benefits-other-text'                      => 'asdasd',
                'contentelement-6'                         => null,
                'distinguishing-characteristics'           => 'WIR SIND EINE FORTSCHLITTLICHES FIRMA',
                'company-philosophie'                      => 'PISNA MI DA PISHA ',
                'career-development'                       => 'MNOGO MI PISNA DA PISHA, ARE STIGA TOLKOVA',
                'education-opportunities'                  => 'ZASHTO IMA O6TE POLETA',
                'references'                               => '4EP!1!!!!',
                'contentelement-7'                         => null,
                'gridrow-17'                               => null,
                'proposal-preparation-1'                   => array(0 => 'VERMITTLUNG BASIS', 1 => 'VERMITTLUNG PLUS',),
                'proposal-preparation-2'                   => array(0 => 'AN-ÜBERLASSUNG',),
                'proposal-preparation-other-text'          => '',
                'company-operation-field'                  => array(0 => 'GEWÜNSCHTE OFFIZIELLE TÄTIGKEIT FÜR IHR UNTERNEHMEN',),
                'company-operation-field-text'             => 'SOFTWARE- SOFTWARE-ENTWICKLUN SOFTWARE-ENTWICKLUN SOFTWARE',
                'create-proposal'                          => '1',
                'confirm-privacy-policy'                   => '1',
                'contentelement-8'                         => null,
                'uBJ1NTembwIZF4fMyx'                       => null,
                'wNIXeOzgDaHimR4n'                         => '',
                'vKxnbo2k1lcDBVXq7486w'                    => '',
            )
        );

        $stylesheet = file_get_contents(__DIR__ . '/../../../Resources/Private/Styles/company-form.css');

        $mpdf = new Mpdf(
            [
                'mode'                 => 'utf-8',
                'format'               => 'A4',
                'orientation'          => 'P',
                'fontDir'              => __DIR__ . '/../../../Resources/Private/Fonts',
                'fontdata'             => [
                    'opensans' => [
                        'R' => 'OpenSans-Regular.ttf',
                        'B' => 'OpenSans-Bold.ttf'
                    ]
                ],
                'default_font'         => 'opensans',
                'setAutoTopMargin'     => 'stretch',
                'autoMarginPadding'    => 0,
            ]
        );

        $mpdf->WriteHTML($stylesheet, HTMLParserMode::HEADER_CSS);
        $mpdf->WriteHTML($view->render(), HTMLParserMode::HTML_BODY);

        try {
            $ctx        = ClientContext::connectWithClientCredentials($siteUrl, $clientId, $clientSecret);
            $targetList = $ctx->getWeb()->getLists()->getByTitle($listName);
            $uploadFile = $targetList->getRootFolder()->uploadFile(
                'company ' . date('d-m-Y His') . ' ' . $values['company-name']. '.pdf',
                $mpdf->Output('name', Destination::STRING_RETURN)
            );
            $ctx->executeQuery();
            print "File {$uploadFile->getServerRelativeUrl()} has been uploaded\r\n";
        } catch (\Exception $e) {
            echo 'Error: ', $e->getMessage();
        }
    }



}
