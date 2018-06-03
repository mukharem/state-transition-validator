<?php

namespace StateTransitionValidator;

class Validator implements ValidatorInterface
{
    /**
     * @var TransitionalModelInterface
     */
    private $transitionalModel;

    /**
     * @var TransitionCollectionInterface
     */
    private $transitionCollection;

    /**
     * @param TransitionCollectionInterface $transitionCollection
     */
    public function __construct(TransitionCollectionInterface $transitionCollection)
    {
        $this->transitionCollection = $transitionCollection;
    }

    /**
     * {@inheritdoc}
     */
    public function validTransition(TransitionalStateInterface $targetState)
    {
        if (!$this->transitionCollection->existState($this->transitionalModel->getState())) {
            //todo write log

            return false;
        }

        return
            $this->transitionCollection->existTransition(
                $this->transitionalModel->getState(),
                $targetState
            );
    }

    /**
     * @param TransitionalModelInterface $transitionalModel
     * @return self
     */
    public function setTransitionalModel(TransitionalModelInterface $transitionalModel)
    {
        $this->transitionalModel = $transitionalModel;

        return $this;
    }
}
