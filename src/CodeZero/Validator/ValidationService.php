<?php namespace CodeZero\Validator;

interface ValidationService {

    /**
     * Perform validation
     *
     * @param array $input
     * @param array $rules
     *
     * @return ValidationResult
     */
    public function validate(array $input, array $rules = array());

}