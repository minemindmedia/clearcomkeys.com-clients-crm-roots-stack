<?php

namespace App\View\Composers;

use Roots\Acorn\View\Composer;

class FrontPage extends Composer
{
    /**
     * List of views served by this composer.
     *
     * @var array
     */
    protected static $views = [
        'partials.content-front-page',
    ];

    /**
     * Data to be passed to view before rendering.
     *
     * @return array
     */

         public function with()
    {
        return [
            'heading' => $this->heading(),
        ];
    }


    public function heading()
    {
        return the_field('test-shit') ?? false;
    }
}
