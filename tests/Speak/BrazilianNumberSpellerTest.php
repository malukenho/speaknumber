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

use Speak\Speller\BrazilianNumberSpeller;

class BrazilianNumberSpellerTest extends \PHPUnit_Framework_TestCase
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
        $this->assertEquals($transcription, (new Number(new BrazilianNumberSpeller()))->speak($number));
    }

    public function provideTranscriptions()
    {
        return [
            [1234, 'um mil e duzentos e trinta e quatro reais'],
            [100, 'cem reais'],
            [1500, 'um mil e quinhentos reais'],
            [10000, 'dez mil reais'],
            [9856, 'nove mil e oitocentos e cinquenta e seis reais'],
            ['30.500,80', 'trinta mil quinhentos reais e oitenta centavos'],
            [2000000, 'dois milhões de reais'],
            ['2.000.000,02', 'dois milhões e dois centavos'],
        ];
    }
}
