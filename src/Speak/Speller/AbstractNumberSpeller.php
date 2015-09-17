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

use Speak\NumberSpellerInterface;
use Speak\Speller\Exception\NumberIsTooLargeException;
use Speak\Speller\Exception\NegativeNotAllowedException;

abstract class AbstractNumberSpeller implements NumberSpellerInterface
{
    /**
     * @see NumberSpellerInterface::spell()
     */
    abstract protected function format($number);

    /**
     * {@inheritDoc}
     *
     * @throws NegativeNotAllowedException se o número fornecido for um número negativo.
     * @throws NumberIsTooLargeException se o número fornecido for muito grande (> PHP_INT_MAX).
     */
    public function spell($number)
    {
        if ($number < 0) {
            throw new NegativeNotAllowedException('Números negativos não são aceitos.');
        }

        if ($number > PHP_INT_MAX) {
            throw new NumberIsTooLargeException(
                sprintf('O número fornecido %s é muito grande.', $number)
            );
        }

        return $this->format($number);
    }
}
