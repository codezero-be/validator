<?php namespace spec\CodeZero\Validator;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class RulesParserSpec extends ObjectBehavior {

    function it_is_initializable()
    {
        $this->shouldHaveType('CodeZero\Validator\RulesParser');
    }

    function it_returns_rules_if_no_vars_are_provided()
    {
        $rules = ['name' => 'unique,name,{id}'];
        $vars = [];

        $expectedResult = ['name' => 'unique,name,{id}'];

        $this->parse($rules, $vars)->shouldReturn($expectedResult);
    }

    function it_replaces_rules_placeholders_with_provided_vars()
    {
        $rules = ['name' => 'unique,name,{id}'];
        $vars = ['{id}' => 5];

        $expectedResult = ['name' => 'unique,name,5'];

        $this->parse($rules, $vars)->shouldReturn($expectedResult);
    }

    function it_replaces_multiple_rules_placeholders_with_provided_vars()
    {
        $rules = [
            'firstname' => 'unique,firstname,{id}',
            'lastname' => 'unique,lastname,{id}',
            'password' => 'min:{length}',
            'weirdness' => 'unique,weirdness,{id}|min:{length}'
        ];

        $vars = [
            '{id}' => 5,
            '{length}' => 2
        ];

        $expectedResult = [
            'firstname' => 'unique,firstname,5',
            'lastname' => 'unique,lastname,5',
            'password' => 'min:2',
            'weirdness' => 'unique,weirdness,5|min:2'
        ];

        $this->parse($rules, $vars)->shouldReturn($expectedResult);
    }

}