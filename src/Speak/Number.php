<?php

namespace Speak;

use Speak\Speller\IntlNumberSpeller;
use Speak\Speller\BrazilianNumberSpeller;

class Number implements SpellerAwareInterface
{

    use SpellerAwareTrait;

    public function __construct(NumberSpellerInterface $speller = null)
    {
        $this->setSpeller(
            $this->getDefaultSpeller($speller)
        );
    }

    /**
     * @return string
     */
    public function speak($number)
    {
        return $this->speller->spell($number);
    }

    /**
     * @return NumberSpellerInterface
     */
    private function getDefaultSpeller($speller = null)
    {
        if ($speller) {
            return $speller;
        }

        if (extension_loaded('intl')) {
            $speller = new IntlNumberSpeller();
        }

        return $speller ?: new BrazilianNumberSpeller();
    }
}
