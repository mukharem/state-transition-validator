<?php

namespace Adv\State;

use StateTransitionValidator\TransitionalStateInterface;

final class ActiveState implements TransitionalStateInterface
{
    const NAME = 'active';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }
}
