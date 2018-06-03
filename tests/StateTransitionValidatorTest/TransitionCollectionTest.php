<?php

namespace StateTransitionValidatorTest;

use PHPUnit\Framework\TestCase;
use StateTransitionValidator\TransitionalStateInterface;
use StateTransitionValidator\TransitionCollection;

class TransitionCollectionTest extends TestCase
{
    /**
     * @dataProvider casesProviderForExistStateMethod
     * @param array $transitions
     * @param $input
     * @param bool $exceptedResult
     */
    public function testExistStateMethod(array $transitions, $input, bool $exceptedResult)
    {
        $transitionCollection = $this->createTransitionCollection($transitions);

        $result = $transitionCollection->existState($input);

        $this->assertSame($exceptedResult, $result);
    }

    /**
     * @dataProvider casesProviderForExistTransitionMethod
     * @param array $transitions
     * @param array $input
     * @param bool $exceptedResult
     */
    public function testExistTransitionMethod(array $transitions, array $input, bool $exceptedResult)
    {
        $transitionCollection = $this->createTransitionCollection($transitions);

        $result = $transitionCollection->existTransition($input['root'], $input['target']);

        $this->assertSame($exceptedResult, $result);
    }

    /**
     * @expectedException StateTransitionValidator\Exception\NonExistRootStateException
     */
    public function testExistTransitionMethodExceptionCase()
    {
        $transitionCollection = $this->createTransitionCollection([]);

        $transitionCollection
            ->existTransition(
                $this->createStubState('A'),
                $this->createStubState('B')
            );
    }

    /**
     * @return array
     */
    public function casesProviderForExistTransitionMethod()
    {
        return [
            [
                'transitions' => [$this->getTransitions('A', 'B')],
                'input' => [
                    'root' => $this->createStubState('A'),
                    'target' => $this->createStubState('B'),
                ],
                'exceptedResult' => true,
            ],
            [
                'transitions' => [
                    $this->getTransitions('A', 'B'),
                    $this->getTransitions('B', 'A'),
                ],
                'input' => [
                    'root' => $this->createStubState('B'),
                    'target' => $this->createStubState('A'),
                ],
                'exceptedResult' => true,
            ],
            [
                'transitions' => [
                    $this->getTransitions('A', 'B'),
                    $this->getTransitions('B', 'C'),
                ],
                'input' => [
                    'root' => $this->createStubState('B'),
                    'target' => $this->createStubState('A'),
                ],
                'exceptedResult' => false,
            ],
        ];
    }

    /**
     * @return array
     */
    public function casesProviderForExistStateMethod()
    {
        return [
            [
                'transitions' => [$this->getTransitions('A', 'B')],
                'input' => $this->createStubState('C'),
                'exceptedResult' => false,
            ],
            [
                'transitions' => [$this->getTransitions('A', 'B')],
                'input' => $this->createStubState('A'),
                'exceptedResult' => true,
            ],
            [
                'transitions' => [],
                'input' => $this->createStubState('A'),
                'exceptedResult' => false,
            ],
        ];
    }

    /**
     * @param string $root
     * @param string $target
     * @return array
     */
    private function getTransitions($root, $target)
    {
        return [
            $this->createStubState($root),
            $this->createStubState($target),
        ];
    }

    /**
     * @param $stateName
     * @return \PHPUnit\Framework\MockObject\MockObject
     */
    private function createStubState($stateName)
    {
        $stub = $this->createMock(TransitionalStateInterface::class);

        $stub->method('getName')
            ->will($this->returnValue($stateName));

        return $stub;
    }

    /**
     * @param array $transitions
     * @return TransitionCollection
     */
    private function createTransitionCollection(array $transitions)
    {
        $transitionCollection = new TransitionCollection();

        foreach ($transitions as $transition) {
            $transitionCollection->addTransition($transition[0], $transition[1]);
        }

        return $transitionCollection;
    }
}
