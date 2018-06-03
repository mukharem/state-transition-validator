<?php

namespace Adv\State;

use StateTransitionValidator\TransitionalStateInterface;

final class RemovedState implements TransitionalStateInterface
{
    const NAME = 'removed';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }
}
