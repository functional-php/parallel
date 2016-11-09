<?php

namespace tests\units;

use atoum;
use FunctionalPHP\Parallel as P;


class stdClass extends atoum
{
    /** @dataProvider mapDataProvider */
    public function testMap(callable $callable, array $data, array $expected)
    {
        $this->variable(P\map(2, $callable, $data))->isIdenticalTo($expected);
    }

    public function mapDataProvider()
    {
        return [
            [ function($i) { return $i + 5; }, [1, 2, 3, 4], [6, 7, 8, 9] ]
        ];
    }
    
    /** @dataProvider filterDataProvider */
    public function testfilter(callable $callable, array $data, array $expected)
    {
        $this->variable(P\filter(2, $callable, $data))->isIdenticalTo($expected);
    }

    public function filterDataProvider()
    {
        return [
            [ function($i) { return $i % 2 == 0; }, [1, 2, 3, 4], [2, 4] ],
        ];
    }
    /** @dataProvider foldDataProvider */
    public function testfold(callable $callable, array $data, $initial, $expected)
    {
        $this->variable(P\fold(2, $callable, $data, $initial))->isIdenticalTo($expected);
    }

    public function foldDataProvider()
    {
        return [
            [ function($a, $b) { return $a + $b; }, [1, 2, 3, 4], 0, 10 ]
        ];
    }
}
