<?php

namespace Adv\State;

use StateTransitionValidator\TransitionalStateInterface;

final class LimitedState implements TransitionalStateInterface
{
    const NAME = 'limited';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }
}
