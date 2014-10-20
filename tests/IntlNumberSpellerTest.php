<?php

namespace Speak\Test;

use Speak\Number;

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
        $object = new Number();
        $this->assertEquals($transcription, $object->speak($number));
    }

    public function provideDeutschTranscriptions()
    {
        return array(
            array(1234, 'ein­tausend­zwei­hundert­vier­und­dreißig'),
            array(100, 'ein­hundert'),
            array(9888, 'neun­tausend­acht­hundert­acht­und­achtzig')
        );
    }
}
