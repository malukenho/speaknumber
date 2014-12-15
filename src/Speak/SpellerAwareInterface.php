<?php

namespace Speak;

/**
 * @author Andrey K. Vital <andreykvital@gmail.com>
 */
interface SpellerAwareInterface
{
    /**
     * @param NumberSpellerInterface $speller speller to be used.
     */
    public function setSpeller(NumberSpellerInterface $speller);
}
