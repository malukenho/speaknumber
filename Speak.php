<?php
namespace Number;

use InvalidArgumentException;

class Speak
{

    public function __construct($number)
    {
        if (! is_numeric($number)) {
            throw new InvalidArgumentException('Passe um valor numérico para a classe');
        }
        if (strlen($number) != 4) {
            throw new InvalidArgumentException('Só é suportado números com 4 dígitos');
        }

        $this->_number = (string) $number;
    }

    public function speak()
    {
        return $this->_mountNumber();
    }

    protected function _mountNumber()
    {
        $numbers = array(
            '1' => 'um',
            '2' => 'dois',
            '3' => 'tres',
            '4' => 'quatro',
            '5' => 'cinco',
            '6' => 'seis',
            '7' => 'sete',
            '8' => 'oito',
            '9' => 'nove',
            '10' => 'dez',
            '11' => 'onze',
            '12' => 'doze',
            '13' => 'treze',
            '14' => 'quatorze',
            '15' => 'quinze',
            '16' => 'dezeseis',
            '17' => 'dezesete',
            '18' => 'dezoito',
            '19' => 'dezenove'
        );

        $homes = array(
            '1' => 'unidade',
            '2' => 'zentos',
            '3' => 'cento',
            '4' => 'mil'
        );

        $centenas = array(
            '1' => 'cento',
            '2' => 'duzentos',
            '3' => 'trezentos',
            '4' => 'quatrocentos',
            '5' => 'quinhentos',
            '6' => 'seiscentos',
            '7' => 'setecentos',
            '8' => 'oitocentos',
            '9' => 'novecentos',
            '10' => 'mil'
        );


        $decimal = array(
            '2' => 'vinte',
            '3' => 'trinta',
            '4' => 'quarenta',
            '5' => 'cinquenta',
            '6' => 'sessenta',
            '7' => 'setenta',
            '8' => 'oitenta',
            '9' => 'noventa'
        );


        $result = '';

        $result .= $numbers[$this->_number[0]]. ' ';
        $result .= $homes[strlen($this->_number)]. ' ';

        if ($this->_number[1] != 0) {
            $result .= $centenas[$this->_number[1]];
        }

        if ($this->_number[2] != 0 and !isset($numbers[ltrim($this->_number[2].$this->_number[3], 0)])) {
            $result .= ' e ' . $decimal[$this->_number[2]]. ' e '. $numbers[$this->_number[3]];
        } else {
            $result .= ' e '. $numbers[ltrim($this->_number[2].$this->_number[3], 0)];
        }
        return $result;
    }
}
