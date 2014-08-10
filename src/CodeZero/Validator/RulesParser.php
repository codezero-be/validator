<?php namespace CodeZero\Validator; 

class RulesParser {

    /**
     * Fill in any placeholders in the validation rules
     *
     * @param array $rules
     * @param array $vars
     *
     * @return array
     */
    public function parse(array $rules, array $vars)
    {
        if ( ! empty($vars))
        {
            // If you write placeholders in your $rules (like {id}),
            // then you can pass them as the 2nd parameter
            // -> array('{id}' => $id)
            foreach ($rules as $key => $rule)
            {
                $rules[$key] = $this->parseVars($rule, $vars);
            }
        }

        return $rules;
    }

    /**
     * Fill in any placeholders in a rule
     *
     * @param $rule
     * @param array $vars
     *
     * @return mixed
     */
    private function parseVars($rule, array $vars)
    {
        foreach ($vars as $var => $value)
        {
            $rule = str_replace($var, $value, $rule);
        }

        return $rule;
    }

} 