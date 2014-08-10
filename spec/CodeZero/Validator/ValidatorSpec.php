<?php namespace spec\CodeZero\Validator;

use CodeZero\Validator\RulesParser;
use CodeZero\Validator\ValidationResult;
use CodeZero\Validator\ValidationService;
use PhpSpec\ObjectBehavior;
use Prophecy\Argument;

class ValidatorSpec extends ObjectBehavior {

    function let(ValidationService $validator, RulesParser $rulesParser)
    {
        $this->beConstructedWith($validator, $rulesParser);
    }

    function it_is_initializable()
    {
        $this->shouldHaveType('CodeZero\Validator\Validator');
    }

    function it_immediately_passes_validation_if_no_rules_are_provided(ValidationService $validator, RulesParser $rulesParser, ValidationResult $validationResult)
    {
        $input = [];
        $rules = [];

        $rulesParser->parse($rules, [])->shouldNotBeCalled()->willReturn($rules);
        $validator->validate($input, $rules)->shouldNotBeCalled()->willReturn($validationResult);
        $validationResult->fails()->shouldNotBeCalled();

        $this->validate($input, $rules)->shouldReturn(true);
    }

    function it_passes_validation_if_no_input_is_provided(ValidationService $validator, RulesParser $rulesParser, ValidationResult $validationResult)
    {
        $input = [];
        $rules = ['name' => 'some_rule'];

        $rulesParser->parse($rules, [])->shouldBeCalled()->willReturn($rules);
        $validator->validate($input, $rules)->shouldBeCalled()->willReturn($validationResult);
        $validationResult->fails()->shouldBeCalled()->willReturn(false);

        $this->validate($input, $rules)->shouldReturn(true);
    }

    function it_returns_true_if_validation_passes(ValidationService $validator, RulesParser $rulesParser, ValidationResult $validationResult)
    {
        $input = ['name' => 'John Doe'];
        $rules = ['name' => 'some_rule'];

        $rulesParser->parse($rules, [])->shouldBeCalled()->willReturn($rules);
        $validator->validate($input, $rules)->shouldBeCalled()->willReturn($validationResult);
        $validationResult->fails()->shouldBeCalled()->willReturn(false);

        $this->validate($input, $rules)->shouldReturn(true);
    }

    function it_throws_if_validation_fails(ValidationService $validator, RulesParser $rulesParser, ValidationResult $validationResult)
    {
        $input = ['name' => 'John Doe'];
        $rules = ['name' => 'some_rule'];

        $rulesParser->parse($rules, [])->shouldBeCalled()->willReturn($rules);
        $validator->validate($input, $rules)->shouldBeCalled()->willReturn($validationResult);
        $validationResult->fails()->shouldBeCalled()->willReturn(true);
        $validationResult->errors()->shouldBeCalled()->willReturn('foo');

        $this->shouldThrow('CodeZero\Validator\Exceptions\ValidationException')->duringValidate($input, $rules);
    }

}
