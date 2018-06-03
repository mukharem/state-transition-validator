<?php

namespace Adv\State;

use StateTransitionValidator\TransitionalStateInterface;

final class NewState implements TransitionalStateInterface
{
    const NAME = 'new';

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return self::NAME;
    }
}
