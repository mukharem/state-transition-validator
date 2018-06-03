<?php

namespace StateTransitionValidator;

use StateTransitionValidator\Exception\NonExistRootStateException;

class TransitionCollection implements TransitionCollectionInterface
{
    /**
     * @var array
     */
    private $transitions;

    /**
     * {@inheritdoc}
     */
    public function existState(TransitionalStateInterface $state)
    {
        return isset($this->transitions[$state->getName()]);
    }

    /**
     * {@inheritdoc}
     */
    public function existTransition(TransitionalStateInterface $root, TransitionalStateInterface $targetState)
    {
        if (!$this->existState($root)) {
            throw new NonExistRootStateException("Non exist root state: '{$root->getName()}'");
        }

        return
            in_array(
                $targetState->getName(),
                $this->transitions[$root->getName()]
            );
    }

    /**
     * @param TransitionalStateInterface $root
     * @param TransitionalStateInterface $targetState
     * @return void
     */
    public function addTransition(TransitionalStateInterface $root, TransitionalStateInterface $targetState)
    {
        if (isset($this->transitions[$root->getName()])) {
            array_push($this->transitions[$root->getName()], $targetState->getName());
        } else {
            $this->transitions[$root->getName()] = [$targetState->getName()];
        }
    }
}
