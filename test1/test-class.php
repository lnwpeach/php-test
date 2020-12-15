<?php

abstract class abs {
    abstract function foo();
    abstract function bar();
}

trait tat {
    function foo() {
        echo "foo";
    }
    function bar() {
        echo "bar";
    }
}

class Test {
    use tat;
    public static $prop = "prop";
    const CONSTT1 = 1;

    function __construct() {
        // echo self::$prop;
        $this->foo();
        echo $ab;
    }

    function foo() {
        echo "fooo";
    }
}

$test = new Test();
// echo $test->foo();

?>