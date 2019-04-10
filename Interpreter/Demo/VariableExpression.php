<?php


namespace Interpreter\Demo;


class VariableExpression extends Expression {
    private $name;
    private $val;

    public function __construct($name, $val = null) {
        $this->name = $name;
        $this->val  = $val;
    }

    function interpret(InterpreterContext $context) {
        if (!is_null($this->val)) {
            $context->replace($this, $this->val);
            $this->val = null;
        }
    }

    function setValue($value) {
        $this->val = $value;
    }

    function getKey() {
        return $this->name;
    }
}
