<?php

namespace Speak;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
trait SpellerAwareTrait
{

    /**
     * @var NumberSpellerInterface
     */
    protected $speller;

    /**
     * @see SpellerAwareInterface::setSpeller()
     */
    public function setSpeller(NumberSpellerInterface $speller)
    {
        $this->speller = $speller;
    }
}
