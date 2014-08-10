<?php namespace CodeZero\Validator; 

class ValidationResult {

    /**
     * @var null
     */
    private $errors;

    function __construct($errors = null)
    {
        $this->errors = $errors;
    }

    /**
     * Get validation errors
     *
     * @return mixed
     */
    public function errors()
    {
        return $this->errors;
    }

    /**
     * Verify validation failure
     *
     * @return bool
     */
    public function fails()
    {
        return !! $this->errors;
    }

}