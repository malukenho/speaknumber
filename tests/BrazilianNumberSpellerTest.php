<?php

namespace Speak\Test;

use Speak\Number;
use Speak\Speller\BrazilianNumberSpeller;

class NumberTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException \Speak\Speller\Exception\NumberIsTooLargeException
     */
    public function speakWithBigNumberShouldThrowException()
    {
        $number = new Number(new BrazilianNumberSpeller());
        $number->speak(PHP_INT_MAX * 2);
    }

    /**
     * @test
     * @expectedException \Speak\Speller\Exception\NegativeNotAllowedException
     */
    public function speakWithNegativeNumberShouldThrownException()
    {
        $number = new Number(new BrazilianNumberSpeller());
        $number->speak(-1);
    }

    /**
     * @test
     * @dataProvider provideTranscriptions
     */
    public function speakShouldReturnStringRepresentationOfTheGivenNumber($number, $transcription)
    {
        $speller = new BrazilianNumberSpeller();
        $speaker = new Number($speller);

        $this->assertEquals($transcription, $speaker->speak($number));
    }

    public function provideTranscriptions()
    {
        return array(
            array(1234, 'um mil duzentos e trinta e quatro'),
            array(100, 'cem'),
            array(1500, 'um mil e quinhentos'),
            array(10000, 'dez mil'),
            array(9856, 'nove mil oitocentos e cinquenta e seis')
        );
    }
}
