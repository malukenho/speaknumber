<?php

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
    public function format($number)
    {
        $formatter = new NumberFormatter($this->locale, NumberFormatter::SPELLOUT);
        return $formatter->format($number);
    }
}
