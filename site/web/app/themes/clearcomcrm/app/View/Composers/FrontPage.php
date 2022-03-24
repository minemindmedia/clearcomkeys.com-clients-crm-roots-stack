<?php

namespace App\View\Composers;
use Roots\Acorn\View\Composer;
use Roots\Acorn\View\Composers\Concerns\AcfFields;


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

    public static function title()
    {
        return get_post()->post_title;
    }

}
