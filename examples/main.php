<?php

require_once __DIR__ . '/../vendor/autoload.php';

use Adv\Adv;
use Adv\State\NewState;
use Adv\State\ActiveState;
use Adv\State\LimitedState;
use Adv\State\OutdatedState;
use Adv\State\RemovedState;
use StateTransitionValidator\TransitionCollection;
use StateTransitionValidator\Validator;

$transitionCollection = new TransitionCollection();
$transitionCollection->addTransition(new NewState(), new ActiveState());
$transitionCollection->addTransition(new NewState(), new LimitedState());
$transitionCollection->addTransition(new ActiveState(), new OutdatedState());
$transitionCollection->addTransition(new LimitedState(), new ActiveState());
$transitionCollection->addTransition(new OutdatedState(), new RemovedState());
$transitionCollection->addTransition(new OutdatedState(), new ActiveState());

$validator = new Validator($transitionCollection);
$adv = new Adv();
$validator->setTransitionalModel($adv);

$targetState = new RemovedState();
echo 'Transition from Active to Removed is possible:' . PHP_EOL;
if ($validator->validTransition($targetState)) {
    fwrite(STDERR, "ERROR.\n");
    exit(1);
} else {
    echo 'NO' . PHP_EOL;
}

$targetState = new ActiveState();
echo 'Transition from New to Active is possible:' . PHP_EOL;
if ($validator->validTransition($targetState)) {
    echo 'YES' . PHP_EOL;
    $adv->setState($targetState);
} else {
    fwrite(STDERR, "ERROR.\n");
    exit(1);
}

// For emitting event, for example we need a manager which will change state, and a decorator which will create event if transition happens
