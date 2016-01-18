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

namespace Speak;

use Speak\Speller\TurkishNumberSpeller;

class TurkishNumberSpellerTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @test
     * @expectedException \Speak\Speller\Exception\NumberIsTooLargeException
     */
    public function speakWithBigNumberShouldThrowException()
    {
        $number = new Number(new TurkishNumberSpeller());
        $number->speak(PHP_INT_MAX * 2);
    }

    /**
     * @test
     * @expectedException \Speak\Speller\Exception\NegativeNotAllowedException
     */
    public function speakWithNegativeNumberShouldThrownException()
    {
        $number = new Number(new TurkishNumberSpeller());
        $number->speak(-1);
    }

    /**
     * @test
     * @dataProvider provideTranscriptions
     */
    public function speakShouldReturnStringRepresentationOfTheGivenNumber($number, $transcription)
    {
        $this->assertEquals($transcription, (new Number(new TurkishNumberSpeller()))->speak($number));
    }

    public function provideTranscriptions()
    {
        return [
            [1001, 'bin bir'],
            [2345, 'iki bin üç yüz kırk beş'],
            [100, 'yüz'],
            [2500, 'iki bin beş yüz'],
            [10000, 'on bin'],
            [10500, 'on bin beş yüz'],
            [9856, 'dokuz bin sekiz yüz elli altı'],
            [2578521952, 'iki milyar beş yüz yetmiş sekiz milyon beş yüz ' .
                         'yirmi bir bin dokuz yüz elli iki'],
            [1332578521952, 'bir trilyon üç yüz otuz iki milyar beş ' .
                             'yüz yetmiş sekiz milyon beş yüz yirmi bir ' .
                             'bin dokuz yüz elli iki']
        ];
    }
}
