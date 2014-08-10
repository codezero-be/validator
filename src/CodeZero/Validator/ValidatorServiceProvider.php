<?php namespace CodeZero\Validator;

use Config;
use Illuminate\Foundation\AliasLoader;
use Illuminate\Support\ServiceProvider;

class ValidatorServiceProvider extends ServiceProvider {

    /**
     * Bootstrap the application events.
     *
     * @return void
     */
    public function boot()
    {
        $this->package('codezero/validator');
    }

    /**
     * Register the service provider.
     *
     * @return void
     */
    public function register()
    {
        $this->registerValidationService();

        $this->registerValidate();

        $this->registerValidateAlias();
    }

    /**
     * Get the services provided by the provider.
     *
     * @return array
     */
    public function provides()
    {
        return ['validate'];
    }

    /**
     * Register the validation service binding
     */
    private function registerValidationService()
    {
        $this->app->bind(
            'CodeZero\Validator\ValidationService',
            'CodeZero\Validator\LaravelValidationService'
        );
    }

    /**
     * Hook up the Validate class for the Validate alias
     */
    private function registerValidate()
    {
        $this->app->bindShared('validate', function()
        {
            return $this->app->make('CodeZero\Validator\Support\Validate');
        });
    }

    /**
     * Register the Validate alias if it does not already exist
     */
    private function registerValidateAlias()
    {
        $this->app->booting(function()
        {
            $loader = AliasLoader::getInstance();
            $aliases = Config::get('app.aliases');

            if (empty($aliases['Validate']))
            {
                $loader->alias('Validate', 'CodeZero\Validator\Facade\Validate');
            }
        });
    }

} 