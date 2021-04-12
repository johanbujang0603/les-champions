<?php

namespace App\Nova;

use Laravel\Nova\Fields\ID;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Password;
use Laravel\Nova\Fields\PasswordConfirmation;
use Ebess\AdvancedNovaMediaLibrary\Fields\Images;

/** @mixin \App\Models\User */
class User extends Resource
{
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static string $model = \App\Models\User::class;

    /**
     * The number of results to display when searching for relatable resources without Scout.
     *
     * @var int|null
     */
    public static $relatableSearchResults = 150;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public function title()
    {
        return $this->first_name . ' ' . $this->last_name;
    }

    /**
     * The logical group associated with the resource.
     *
     * @var string
     */
    public static function group()
    {
        return get_string('Users');
    }

    /**
     * Get the displayable label of the resource.
     *
     * @return string
     */
    public static function label()
    {
        return get_string('Users');
    }

    /**
     * Get the displayable singular label of the resource.
     *
     * @return string
     */
    public static function singularLabel()
    {
        return get_string('User');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id', 'first_name', 'last_name', 'email',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     *
     * @return array
     */
    public function fields(Request $request)
    {
        return [
            ID::make()->sortable(),

            Images::make(__('Avatar'), 'users-avatars')
                ->conversionOnIndexView('thumbnail'),

            Text::make(__('Firstname'), 'first_name')
                ->sortable()
                ->rules('required', 'max:191')
                ->hideFromIndex(),

            Text::make(__('Lastname'), 'last_name')
                ->sortable()
                ->rules('required', 'max:191')
                ->hideFromIndex(),

            Text::make(__('Fullname'), fn () => __($this->fullName))
                ->sortable()
                ->onlyOnIndex(),

            Text::make('Email')
                ->sortable()
                ->rules('required', 'email:rfc,filter', 'max:191')
                ->creationRules('unique:users,email')
                ->updateRules('unique:users,email,{{resourceId}}'),

             Password::make(__('Password'), 'password')
                ->onlyOnForms()
                ->creationRules('required', 'string', 'min:8')
                ->updateRules('nullable', 'string', 'min:8'),

            PasswordConfirmation::make(__('Password Confirmation')),
        ];
    }
}
