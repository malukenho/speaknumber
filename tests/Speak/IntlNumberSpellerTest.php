<?php

namespace Speak;

class IntlNumberSpellerTest extends \PHPUnit_Framework_TestCase
{

    protected function assertPreConditions()
    {
        if (!extension_loaded('intl')) {
            $this->markTestSkipped();
        }
    }

    /**
     * @return void
     */
    protected function setUp()
    {
        locale_set_default('de_DE');
    }

    /**
     * @return void
     */
    protected function tearDown()
    {
        locale_set_default('pt_BR');
    }

    /**
     * @test
     * @dataProvider provideDeutschTranscriptions
     */
    public function speakShouldStringRepresentationOfTheGivenNumber($number, $transcription)
    {
        $this->assertEquals($transcription, (new Number())->speak($number));
    }

    public function provideDeutschTranscriptions()
    {
        return [
            [1234, 'ein­tausend­zwei­hundert­vier­und­dreißig'],
            [100, 'ein­hundert'],
            [9888, 'neun­tausend­acht­hundert­acht­und­achtzig']
        ];
    }
}
