<?php

namespace Speak\Speller;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class BrazilianNumberSpeller extends AbstractNumberSpeller
{

    /**
     * {@inheritDoc}
     */
    protected function format($number)
    {
        $return = array();
        $number = number_format((int)$number, 0, '.', '.');
        $separator = $this->getSeparator();

        if ($number == 0) {
            return 'zero';
        }

        $chunks = array_reverse(explode('.', $number));

        foreach ($chunks as $idx => $chunk) {
            if ($chunk == 0) {
                continue;
            }

            $exponents = $this->getExponents();
            $exponent = $exponents[$idx];
            $exponent = ($chunk > 1)
                ? str_replace('ão', 'ões', $exponent)
                : $exponent;

            $return[] = $exponent;
            $return[] = implode($separator, array_filter($this->getTokensFor($chunk)));
        }

        if (count($return) > 2) {
            reset($chunks);

            $chunk = current($chunks);

            if (!($chunk % 100) || ($chunk < 100)) {
                $suffix = &$return[1];
                $suffix = trim($separator . $suffix);
            }
        }

        return implode(
            ' ',
            array_reverse(array_filter($return))
        );
    }

    /**
     * @return string[]
     */
    private function getTokensFor($chunk)
    {
        if (false == $chunk) {
            return array();
        }

        if ($chunk == 100) {
            return array('cem');
        }

        if (($chunk < 20) && ($chunk > 10)) {
            $contractions = $this->getContractions();
            return (array)$contractions[$chunk % 10];
        }

        $x = strlen($chunk) - 1;
        $y = $chunk{0};

        $dictionary = $this->getDictionary();
        $word = $dictionary[$x][$y];
        $next = substr($chunk, 1);

        return array_merge(
            (array)$word,
            $this->getTokensFor($next)
        );
    }

    /**
     * @return string[]
     */
    private function getExponents()
    {
        return array(
            null,
            'mil',
            'milhão',
            'bilhão',
            'trilhão',
            'quatrilhão',
            'quintilhão',
            'sextilhão',
            'septilhão',
            'octilhão',
            'nonilhão',
            'decilhão'
        );
    }

    /**
     * @return string[]
     */
    private function getContractions()
    {
        return array(
            null,
            'onze',
            'doze',
            'treze',
            'quatorze',
            'quinze',
            'dezesseis',
            'dezessete',
            'dezoito',
            'dezenove'
        );
    }

    /**
     * @return string[][]
     */
    private function getDictionary()
    {
        return array(
            array(
                null,
                'um',
                'dois',
                'três',
                'quatro',
                'cinco',
                'seis',
                'sete',
                'oito',
                'nove'
            ), array(
                null,
                'dez',
                'vinte',
                'trinta',
                'quarenta',
                'cinquenta',
                'sessenta',
                'setenta',
                'oitenta',
                'noventa'
            ), array(
                null,
                'cento',
                'duzentos',
                'trezentos',
                'quatrocentos',
                'quinhentos',
                'seiscentos',
                'setecentos',
                'oitocentos',
                'novecentos'
            )
        );
    }

    /**
     * @return string
     */
    private function getSeparator()
    {
        return ' e ';
    }
}
