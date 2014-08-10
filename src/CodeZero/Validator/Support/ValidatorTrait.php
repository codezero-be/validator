<?php namespace CodeZero\Validator\Support;

use App;
use Input;

trait ValidatorTrait {

    /**
     * Call validate on the specified derived FormValidator
     *
     * @param string $validator
     * @param array $input
     * @param array $vars
     *
     * @return bool
     * @throws \CodeZero\Validator\Exceptions\ValidationException
     */
    public function validate($validator, array $input = null, $vars = array())
    {
        $input = $input ?: Input::all();

        return App::make($validator)->validate($input, $vars);
    }

} 