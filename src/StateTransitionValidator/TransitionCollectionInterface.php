<?php

namespace StateTransitionValidator;

use StateTransitionValidator\Exception\NonExistRootStateException;

interface TransitionCollectionInterface
{
    /**
     * @param TransitionalStateInterface $state
     * @return bool
     */
    public function existState(TransitionalStateInterface $state);

    /**
     * @throws NonExistRootStateException
     * @param TransitionalStateInterface $root
     * @param TransitionalStateInterface $targetState
     * @return bool
     */
    public function existTransition(TransitionalStateInterface $root, TransitionalStateInterface $targetState);
}
