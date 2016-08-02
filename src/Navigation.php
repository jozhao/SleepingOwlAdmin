<?php

namespace SleepingOwl\Admin;

use SleepingOwl\Admin\Contracts\NavigationInterface;

/*
 * TODO refactor base class
 */
class Navigation extends \KodiComponents\Navigation\Navigation implements NavigationInterface
{
    /**
     * @param string|null $view
     *
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function render($view = null)
    {
        $this->findActivePage();
        $this->filterByAccessRights();
        $this->filterEmptyPages();

        $this->sort();

        if (! is_null($view)) {
            return view($view, [
                'pages' => $this->getPages(),
            ])->render();
        }

        return app('sleeping_owl.template')->view('_partials.navigation.navigation', [
            'pages' => $this->getPages(),
        ])->render();
    }
}
