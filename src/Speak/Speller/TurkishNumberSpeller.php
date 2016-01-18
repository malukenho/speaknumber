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
 * @author Ogün Karakuş <kirk5bucuk@gmail.com>
 */
class TurkishNumberSpeller extends AbstractNumberSpeller
{
    /**
     * {@inheritDoc}
     */
    protected function format($number)
    {
        $return     = [];
        $number     = number_format((int) $number, 0, '.', '.');
        $separator  = $this->getSeparator();

        if ($number == 0) {
            return 'sıfır';
        }

        $chunks = array_reverse(explode('.', $number));

        foreach ($chunks as $idx => $chunk) {
            if ($chunk == 0) {
                continue;
            }

            $exponent = $this->getExponents()[$idx];

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

        $return_count = count($return);

        // Fixes for 1001, 1500 etc. numbers Turkish translation.
        if ($return_count >= 4 && $return_count <= 6)
        {
            if ($return[$return_count - 1] == 'bir')
            {
                unset($return[$return_count - 1]);

                $return = array_values($return);
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
            return [];
        }

        if ($chunk == 100) {
            return ['yüz'];
        }

        if (($chunk < 20) && ($chunk > 10)) {
            return (array) $this->getContractions()[$chunk % 10];
        }

        $x = strlen($chunk) - 1;
        $y = $chunk{ 0 };

        $word = $this->getDictionary()[$x][$y];
        $next = substr($chunk, 1);

        return array_merge(
            (array) $word,
            $this->getTokensFor($next)
        );
    }

    /**
     * @return string[]
     */
    private function getExponents()
    {
        return [
            null,
            'bin',
            'milyon',
            'milyar',
            'trilyon',
            null,
            null,
            null,
            null,
            null,
            null,
            null
        ];
    }

    /**
     * @return string[]
     */
    private function getContractions()
    {
        return [
            null,
            'on bir',
            'on iki',
            'on üç',
            'on dört',
            'on beş',
            'on altı',
            'on yedi',
            'on sekiz',
            'on dokuz'
        ];
    }

    /**
     * @return string[][]
     */
    private function getDictionary()
    {
        return [
            [
                null,
                'bir',
                'iki',
                'üç',
                'dört',
                'beş',
                'altı',
                'yedi',
                'sekiz',
                'dokuz'
            ], [
                null,
                'on',
                'yirmi',
                'otuz',
                'kırk',
                'elli',
                'altmış',
                'yetmiş',
                'seksen',
                'doksan'
            ], [
                null,
                'yüz',
                'iki yüz',
                'üç yüz',
                'dört yüz',
                'beş yüz',
                'altı yüz',
                'yedi yüz',
                'sekiz yüz',
                'dokuz yüz'
            ]
        ];
    }

    /**
     * @return string
     */
    private function getSeparator()
    {
        return ' ';
    }
}
