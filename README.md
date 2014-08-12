# Form Input Validator #

[![Build Status](https://travis-ci.org/codezero-be/validator.svg?branch=master)](https://travis-ci.org/codezero-be/validator)
[![Latest Stable Version](https://poser.pugx.org/codezero/validator/v/stable.svg)](https://packagist.org/packages/codezero/validator)
[![Total Downloads](https://poser.pugx.org/codezero/validator/downloads.svg)](https://packagist.org/packages/codezero/validator)
[![License](https://poser.pugx.org/codezero/validator/license.svg)](https://packagist.org/packages/codezero/validator)

This package provides an easy to use interface to handle server side form validation and lets you create your custom form validation classes without much effort.

Although the core of this package is not bound to any framework, I have included a ServiceProvider and ValidationService implementation specifically for [Laravel](http://www.laravel.com/).

I have also included a ValidationTrait and a facade (both for Laravel) so you can use this package in a way you like best (see below for more).

## Installation ##

Install this package through Composer:

    "require": {
    	"codezero/validator": "1.*"
    }

## Laravel 4 Implementation ##

After installing, update your `app/config/app.php` file to include a reference to this package's service provider in the providers array:

    'providers' => [
	    'CodeZero\Validator\ValidatorServiceProvider'
    ]

This package will automatically register the `Validate` alias, if this is not already taken.

You can handle failed validations by catching the ValidationException. One automated way is to add the following handler to `app/start/global.php`. But you could as easily catch it in a try/catch block.

	App::error(function(CodeZero\Validator\Exceptions\ValidationException $exception)
	{
	    return Redirect::back()->withInput()->withErrors($exception->getErrors());
	});


### Laravel Specific Usage ###

#### 1. Create a FormValidator to validate your form ####

	use CodeZero\Validator\FormValidator;

	class UpdateUserForm extends FormValidator {

		/**
	     * Validation rules
	     *
	     * @var array
	     */	
	    protected $rules = [
	        'name' => 'required',
	        'email' => 'required|email|unique,email,{userId}'
	    ];
	
	}

Note the `{userId}` placeholder as an example.

#### 2. Handle the input ####

Create your form and then handle the input in your controller in one of the following ways.

##### Validate with a facade: #####

	$input = Input::all();
	$vars = ['{userId}' => $someUser->id];

	Validate::form('UpdateUserForm', $input, $vars);

You can pass the input and any placeholder key/value pairs as the second and third parameter, but if you leave both off, the package will automatically fetch `Input::all()` for you.

To have typesafety or autocomplete in IDE's, you might do this instead:

	Validate::form(get_class(UpdateUserForm), $input, $vars);

Or if you use PHP 5.5 or above, this is even cleaner:

	Validate::form(UpdateUserForm::class, $input, $vars);

##### Validate with a trait: #####

	use CodeZero\Validator\Support\ValidatorTrait;
	
	class HomeController extends BaseController {
	
	    use ValidatorTrait;
	
		public function update()
		{
	        $input = Input::all();
	        $vars = ['{userId}' => $someUser->id];
	
			$this->validate(UpdateUserForm::class, $input, $vars);
	        
	        return Redirect::to('/');
		}
	
	}

#### 3. Show any validation errors ####

Showing the errors in your form is as easy as doing this for each field:

	{{ $errors->first('name', '<p>:message</p>'); }}

That's it!