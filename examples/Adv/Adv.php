<?php

namespace Adv;

use Adv\State\NewState;
use StateTransitionValidator\TransitionalModelInterface;
use StateTransitionValidator\TransitionalStateInterface;

class Adv implements TransitionalModelInterface
{
    /**
     * @var TransitionalStateInterface
     */
    private $state;

    public function __construct()
    {
        $this->state = new NewState();
    }

    /**
     * {@inheritdoc}
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param TransitionalStateInterface $state
     * @return $this
     */
    public function setState(TransitionalStateInterface $state)
    {
        $this->state = $state;

        return $this;
    }
}
