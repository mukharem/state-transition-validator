<?php

namespace Adv\State;

use StateTransitionValidator\TransitionalStateInterface;

final class OutdatedState implements TransitionalStateInterface
{
    const NAME = 'outdated';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }
}
