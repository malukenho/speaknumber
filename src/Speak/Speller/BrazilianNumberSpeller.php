<?php
/*
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS
 * "AS IS" AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT
 * LIMITED TO, THE IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR
 * A PARTICULAR PURPOSE ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT
 * OWNER OR CONTRIBUTORS BE LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL,
 * SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT
 * LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES; LOSS OF USE,
 * DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND ON ANY
 * THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE
 * OF THIS SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 *
 * This software consists of voluntary contributions made by many individuals
 * and is licensed under the MIT license.
 */

namespace Speak\Speller;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 * @author Isaac Henrique <isaachbnn@gmail.com>
 */
class BrazilianNumberSpeller extends AbstractNumberSpeller
{
    /**
     * {@inheritDoc}
     */
    protected function format($number)
    {
        $return = [];
        $number = $this->convert($number);
        $separator = $this->getSeparator();

        if ($number == 0) {
            return 'zero';
        }

        $chunks = array_reverse(explode('.', $number));

        foreach ($chunks as $idx => $chunk) {
            if ($chunk == 0) {
                continue;
            }

            $exponent = $this->getExponents()[$idx];
            $exponent = ($chunk > 1) ? str_replace(['al', 'vo', 'ão'], ['ais', 'vos', 'ões'], $exponent) : $exponent;
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

        return implode(' ', $this->addReal($return));
    }

    /**
     * @param $chunk
     * @return array
     */
    private function getTokensFor($chunk)
    {
        if (false == $chunk) {
            return [];
        }

        if ($chunk == 100) {
            return ['cem'];
        }

        if (($chunk < 20) && ($chunk > 10)) {
            $contractions = $this->getContractions();

            return (array) $contractions[$chunk % 10];
        }

        $x = strlen($chunk) - 1;
        $y = $chunk{0};
        $dictionary = $this->getDictionary();
        $word = $dictionary[$x][$y];
        $next = substr($chunk, 1);

        return array_merge((array) $word, $this->getTokensFor($next));
    }

    /**
     * @return string[]
     */
    private function getExponents()
    {
        return [
            'centavo',
            'real',
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
            'decilhão',
            'milhões',
        ];
    }

    /**
     * @return array
     */
    private function getContractions()
    {
        return [null, 'onze', 'doze', 'treze', 'quatorze', 'quinze', 'dezesseis', 'dezessete', 'dezoito', 'dezenove'];
    }

    /**
     * @return string[][]
     */
    private function getDictionary()
    {
        return [
            [null, 'um', 'dois', 'três', 'quatro', 'cinco', 'seis', 'sete', 'oito', 'nove'],
            [null, 'dez', 'vinte', 'trinta', 'quarenta', 'cinquenta', 'sessenta', 'setenta', 'oitenta', 'noventa'],
            [
                null,
                'cento',
                'duzentos',
                'trezentos',
                'quatrocentos',
                'quinhentos',
                'seiscentos',
                'setecentos',
                'oitocentos',
                'novecentos',
            ],
        ];
    }

    /**
     * @return string
     */
    private function getSeparator()
    {
        return ' e ';
    }

    /**
     * @param $value
     * @return string
     */
    private function convert($value)
    {
        if (is_string($value)) {
            $value = str_replace(['.', ','], ['', '.'], $value);
        }

        return number_format($value, 2, '.', '.');
    }

    /**
     * @param array $return
     * @return array
     */
    private function addReal(array $return)
    {
        $return = array_filter($return);

        if (!in_array(current($return), ['centavos', 'centavo', 'reais', 'real'])) {
            $return = in_array(current($return), $this->getExponents())
                ? 'mil' === current($return) ? array_merge(['reais'], $return) : array_merge(['de reais'], $return)
                : array_merge(['real'], $return);
        }

        return array_reverse($return);
    }
}
