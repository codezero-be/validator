<?php namespace CodeZero\Validator\Exceptions;

use Exception;

class ValidationException extends Exception {

	/**
     * Validation errors
     *
     * @var mixed
     */
	protected $errors;

	/**
     * Create a new ValidationException
     *
     * @param $errors
     * @param string     $message
     * @param int        $code
     * @param Exception  $previous
     */
	public function __construct($errors, $message = '', $code = 0, Exception $previous = null)
	{
		$this->errors = $errors;

		parent::__construct($message, $code, $previous);
	}

	/**
     * Get validation errors
     *
     * @return mixed
     */
	public function getErrors()
	{
		return $this->errors;
	}
     
}