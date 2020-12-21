<?php

namespace App\Providers;

use Collective\Html\FormBuilder;
use Illuminate\Support\ServiceProvider;

class HtmlMacrosServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->registerFormControl();
    }

    private function registerFormControl()
    {
        FormBuilder::macro('control', function ($type, $errors, $nom, $placeholder, $addAttributes = []) {
            $valeur = \Request::old($nom) ? \Request::old($nom) : null;
            $attributes = array_merge(
                [
                    'class' => 'form-control ' . ($errors->has($nom) ? 'is-invalid' : ''),
                    'placeholder' => $placeholder,
                    'id' => $nom,
                    'required' => 'required'
                ],
                $addAttributes);
            return sprintf('
				%s
				%s',
                call_user_func_array(['Form', $type], [$nom, $valeur, $attributes]),
                $errors->first($nom, "
                   <span class='invalid-feedback' role='alert'>
                        <strong>:message</strong>
                   </span>")
            );
        });
    }
    /*
    private function registerFormControl()
    {
        FormBuilder::macro('control', function($type, $errors, $nom, $placeholder, $addAttributes=[])
        {
            $valeur = \Request::old($nom) ? \Request::old($nom) : null;
            $attributes = array_merge(['class' => 'form-control', 'placeholder' => $placeholder], $addAttributes);
            return sprintf('
				<div class="form-group %s">
					%s
					%s
				</div>',
                $errors->has($nom) ? 'has-error' : '',
                call_user_func_array(['Form', $type], [$nom, $valeur, $attributes]),
                $errors->first($nom, '<small class="help-block">:message</small>')
            );
        });
    }*/
}
