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

class IntlNumberSpellerTest extends \PHPUnit_Framework_TestCase
{
    protected function assertPreConditions()
    {
        if (!extension_loaded('intl')) {
            $this->markTestSkipped();
        }
    }

    protected function setUp()
    {
        locale_set_default('de_DE');
    }

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
        $this->assertEquals($transcription, (new Number())->speak($number));
    }

    public function provideDeutschTranscriptions()
    {
        return [
            [1234, 'ein­tausend­zwei­hundert­vier­und­dreißig'],
            [100, 'ein­hundert'],
            [9888, 'neun­tausend­acht­hundert­acht­und­achtzig']
        ];
    }
}
