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

use NumberFormatter;
use RuntimeException;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
class IntlNumberSpeller extends AbstractNumberSpeller
{
    /**
     * @var string
     */
    private $locale;

    /**
     * @param string $locale locale to be used for spelling out the number.
     */
    public function __construct($locale = null)
    {
        if (!extension_loaded('intl')) {
            throw new RuntimeException('A extensão intl não está instalada.');
        }

        $this->locale = $locale ?: locale_get_default();
    }

    /**
     * {@inheritDoc}
     */
    protected function format($number)
    {
        $formatter = new NumberFormatter($this->locale, NumberFormatter::SPELLOUT);
        return $formatter->format($number);
    }
}
