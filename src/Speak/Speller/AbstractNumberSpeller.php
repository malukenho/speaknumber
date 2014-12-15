<?php

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
