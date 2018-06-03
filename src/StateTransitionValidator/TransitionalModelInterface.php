<?php

namespace StateTransitionValidator;

interface TransitionalModelInterface
{
    /**
     * @return TransitionalStateInterface
     */
    public function getState();
}
