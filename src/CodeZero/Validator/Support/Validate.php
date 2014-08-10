<?php namespace CodeZero\Validator\Support;

class Validate {

    use ValidatorTrait;

    public function form($validator, $input = null, $vars = array())
    {
        return $this->validate($validator, $input, $vars);
    }

} 