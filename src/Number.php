<?php

namespace Speak;

use Speak\Speller\IntlNumberSpeller;
use Speak\Speller\BrazilianNumberSpeller;

class Number implements SpellerAwareInterface
{

    /**
     * @var NumberSpellerInterface
     */
    protected $speller;

    public function __construct(NumberSpellerInterface $speller = null)
    {
        $this->setSpeller(
            $this->getDefaultSpeller($speller)
        );
    }

    /**
     * @param NumberSpellerInterface $speller
     */
    public function setSpeller(NumberSpellerInterface $speller)
    {
        $this->speller = $speller;
    }


    /**
     * @param $number
     * @return string
     */
    public function speak($number)
    {
        return $this->speller->spell($number);
    }

    /**
     * @param null $speller
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
