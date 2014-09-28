<?php

namespace Speak;

use Speak\Speller\BrazilianNumberSpeller;

class Number implements SpellerAwareInterface
{

    use SpellerAwareTrait;

    public function __construct(NumberSpellerInterface $speller = null)
    {
        $this->setSpeller($speller ?: new BrazilianNumberSpeller());
    }

    /**
     * @return string
     */
    public function speak($number)
    {
        return $this->speller->spell($number);
    }
}
