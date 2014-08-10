<?php namespace CodeZero\Validator;

use CodeZero\Validator\Exceptions\MissingValidationRulesException;

abstract class FormValidator {

    /**
     * Validator
     *
     * @var Validator
     */
    private $validator;

    /**
     * Constructor
     *
     * @param Validator $validator
     */
    public function __construct(Validator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Perform validation
     *
     * @param array $input
     * @param array $vars
     *
     * @return bool
     * @throws MissingValidationRulesException
     */
    public function validate(array $input, array $vars = array())
    {
        // Check if the derived class
        // has a $rules property...
        $this->checkForRulesProperty();

        $rules = $this->rules;

        $this->validator->validate($input, $rules, $vars);
    }

    /**
     * Check if the derived class has a $rules property
     *
     * @return void
     * @throws MissingValidationRulesException
     */
    private function checkForRulesProperty()
    {
        if ( ! property_exists($this, 'rules'))
        {
            $msg = 'Could not find the [$rules] property on the derived FormValidator.';

            throw new MissingValidationRulesException($msg);
        }
    }

} 