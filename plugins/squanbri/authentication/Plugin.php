<?php namespace Squanbri\Authentication;

use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Squanbri\Authentication\Components\Account' => 'Account',
            'Squanbri\Authentication\Components\Companies' => 'Companies',
            'Squanbri\Authentication\Components\Users' => 'Users',
            'Squanbri\Authentication\Components\Vacancies' => 'Vacancies',
            'Squanbri\Authentication\Components\Resume' => 'Resume',
            'Squanbri\Authentication\Components\Favourites' => 'Favourites',
            'Squanbri\Authentication\Components\Pagination' => 'Pagination',
            'Squanbri\Authentication\Components\Courses' => 'Courses',
        ];
    }

    public function registerSettings()
    {
    }
}
