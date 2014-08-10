<?php namespace CodeZero\Validator;

use CodeZero\Validator\Exceptions\ValidationException;

class Validator {

    /**
     * Validation Service
     *
     * @var ValidationService
     */
    private $validator;

    /**
     * Rules Parser
     *
     * @var RulesParser
     */
    private $rulesParser;

    /**
     * Constructor
     *
     * @param ValidationService $validator
     */
    public function __construct(ValidationService $validator, RulesParser $rulesParser)
    {
        $this->validator = $validator;
        $this->rulesParser = $rulesParser;
    }

    /**
     * Perform validation
     *
     * @param array $input
     * @param array $rules
     * @param array $vars
     *
     * @return bool
     * @throws ValidationException
     */
    public function validate(array $input, array $rules, array $vars = array())
    {
        // No rules? Nothing to validate!
        if (empty($rules))
            return true;

        $rules = $this->rulesParser->parse($rules, $vars);

        // Call the ValidationService,
        // which will return a ValidationResult
        $validation = $this->validator->validate($input, $rules);

        if ($validation->fails())
        {
            throw new ValidationException($validation->errors());
        }

        return true;
    }

}