<?php

namespace Speak;

class NumberTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException Speak\Speller\Exception\NumberIsTooLargeException
     */
    public function speakWithBigNumberShouldThrowException()
    {
        $number = new Number();
        $number->speak(PHP_INT_MAX * 2);
    }

    /**
     * @test
     * @expectedException Speak\Speller\Exception\NegativeNotAllowedException
     */
    public function speakWithNegativeNumberShouldThrownException()
    {
        $number = new Number();
        $number->speak(-1);
    }

    /**
     * @test
     * @dataProvider provideTranscriptions
     */
    public function speakShouldReturnStringRepresentationOfTheGivenNumber($number, $transcription)
    {
        $this->assertEquals($transcription, (new Number())->speak($number));
    }

    public function provideTranscriptions()
    {
        return [
            [1234, 'um mil duzentos e trinta e quatro'],
            [100, 'cem'],
            [1500, 'um mil e quinhentos'],
            [10000, 'dez mil'],
            [9856, 'nove mil oitocentos e cinquenta e seis']
        ];
    }
}
