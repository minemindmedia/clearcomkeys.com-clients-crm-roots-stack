<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class LocationDealerships extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $locationDealerships = new FieldsBuilder('dealership_details');

        $locationDealerships
            ->setLocation('taxonomy', '==', 'dealership');

        $locationDealerships 
            ->addGroup('physical_address', [
                'wrapper' => [
                'width' => '100%',
                'class' => '',
                'id' => '',
                ],
            ])
                ->addSelect('company', [
                    'label' => 'Select Company',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '100%',
                        'class' => '',
                        'id' => '',
                    ],
                    'choices' => ['DriveTime', 'Carvana', 'ClearComKeys'],
                    'default_value' => [],
                    'allow_null' => 0,
                    'multiple' => 0,
                    'ui' => 1,
                    'ajax' => 1,
                    'return_format' => 'value',
                    'placeholder' => 'Choose One',
                ])
                ->addText('street_address', [
                    'label' => 'Street Address',
                    'wrapper' => [
                    'width' => '100%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('city', [
                    'label' => 'City',
                    'wrapper' => [
                    'width' => '33.3%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('state', [
                    'label' => 'State',
                    'wrapper' => [
                    'width' => '33.3%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('zip', [
                    'label' => 'Zip',
                    'wrapper' => [
                    'width' => '33.3%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addDateTimePicker('last_in_person_training', [
                    'label' => 'Last In-Person Training Date',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '50%',
                        'class' => '',
                        'id' => '',
                    ],
                    'display_format' => 'F j, Y g:i a',
                    'return_format' => 'Y-m-d H:i:s',
                ])
                ->addDateTimePicker('last_zoom_training', [
                    'label' => 'Last Zoom Training Date',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '50%',
                        'class' => '',
                        'id' => '',
                    ],
                    'display_format' => 'F j, Y g:i a',
                    'return_format' => 'Y-m-d H:i:s',
                ])
            ->endGroup();

        return $locationDealerships->build();
    }
}
