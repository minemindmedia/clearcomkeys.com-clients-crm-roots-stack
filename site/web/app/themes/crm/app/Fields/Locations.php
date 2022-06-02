<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Locations extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $locations = new FieldsBuilder('locations');

        $locations
            ->setLocation('taxonomy', '==', 'location');

        $locations
            ->addText('location', [
                'label' => 'Location',
                'instructions' => 'Add a new location',
                'required' => 1,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'default_value' => '',
                'placeholder' => '',
                'prepend' => '',
                'append' => '',
                'maxlength' => '',
        ]);

        return $locations->build();
    }
}
