<?php

namespace StateTransitionValidator;

interface ValidatorInterface
{
    /**
     * @param TransitionalStateInterface $targetState
     * @return bool
     */
    public function validTransition(TransitionalStateInterface $targetState);
}
