<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class FrontPage extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $frontPage = new FieldsBuilder('front_page');

        $frontPage
            ->setLocation('page_type', '==', 'front_page');

        $frontPage
            ->addText('front-page-testing');

        return $frontPage->build();
    }
}
