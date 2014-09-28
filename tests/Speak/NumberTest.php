<?php

chdir(__DIR__);

require '../../src/Speak/Number.php';

use Speak\Number;

class NumberTest extends \PHPUnit_Framework_TestCase
{

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Passe um valor numérico para a classe
     */
    public function instantiationWithInvalidNumberShouldThrowAnException()
    {
        $number = new Number('##');
    }

    /**
     * @test
     * @expectedException InvalidArgumentException
     * @expectedExceptionMessage Só é suportado números com 4 dígitos
     */
    public function instantiationWithUnsupportedLengthNumberShouldThrowAnException()
    {
        $number = new Number('99999');
    }

    /**
     * @test
     */
    public function speakShouldReturnStringRepresentationOfNumber()
    {
        $number = new Number('1234');

        $this->assertEquals(
            'um mil duzentos e trinta e quatro',
            $number->speak()
        );
    }
}
