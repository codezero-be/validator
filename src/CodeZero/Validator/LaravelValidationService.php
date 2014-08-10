<?php namespace CodeZero\Validator;

use Illuminate\Validation\Factory as IlluminateValidator;

class LaravelValidationService implements ValidationService {

    /**
     * Laravel's Validator
     *
     * @var IlluminateValidator
     */
    private $validator;

    /**
     * Constructor
     *
     * @param IlluminateValidator $validator
     */
    public function __construct(IlluminateValidator $validator)
    {
        $this->validator = $validator;
    }

    /**
     * Perform validation
     *
     * @param array $input
     * @param array $rules
     *
     * @return ValidationResult
     */
    public function validate(array $input, array $rules = array())
    {
        $errors = null;

        $validation = $this->validator->make($input, $rules);

        if ($validation->fails())
        {
            $errors = $validation->messages();
        }

        return new ValidationResult($errors);
    }


}