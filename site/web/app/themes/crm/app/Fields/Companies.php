<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Companies extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $companies = new FieldsBuilder('companies');
        $todaysDate = date("F j, Y, g:i a");

        $companies
            ->setLocation('post_type', '==', 'companies');

        $companies 
            ->addText('company', [
                'label' => 'Company',
                'wrapper' => [
                'width' => '100%',
                'class' => '',
                'id' => '',
                ],
            ])
            ->addRelationship('location', [
                'label' => 'Location',
                'instructions' => 'Choose a location for this company',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'post_type' => ['locations'],
                'taxonomy' => [],
                'filters' => [
                    0 => 'search',
                ],
                'elements' => '',
                'min' => '0',
                'max' => '1',
                'return_format' => 'object',
            ])
            ->addGroup('shipping_address', [
                'wrapper' => [
                'width' => '100%',
                'class' => '',
                'id' => '',
                ],
            ])
                ->addText('street_address', [
                    'label' => 'Street Address',
                    'wrapper' => [
                    'width' => '25%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('city', [
                    'label' => 'City',
                    'wrapper' => [
                    'width' => '25%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('state', [
                    'label' => 'State',
                    'wrapper' => [
                    'width' => '25%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('zip', [
                    'label' => 'Zip',
                    'wrapper' => [
                    'width' => '25%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addField('phone', 'acfe_phone_number', [
                    'required' => 0,
                    'label' => 'Phone Number',
                    'default_country' => 'us',
                        'countries' => array(
                            'us',
                            'ca'
                        ),
                    'wrapper' => [
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addField('fax', 'acfe_phone_number', [
                    'required' => 0,
                    'label' => 'Fax Number',
                    'default_country' => 'us',
                        'countries' => array(
                            'us',
                            'ca'
                        ),
                    'wrapper' => [
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
            ->endGroup()

            ->addGroup('billing_address', [
                'wrapper' => [
                'width' => '100%',
                'class' => '',
                'id' => '',
                ],
            ])
                ->addText('street_address', [
                    'label' => 'Street Address',
                    'wrapper' => [
                    'width' => '25%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('city', [
                    'label' => 'City',
                    'wrapper' => [
                    'width' => '25%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('state', [
                    'label' => 'State',
                    'wrapper' => [
                    'width' => '25%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('zip', [
                    'label' => 'Zip',
                    'wrapper' => [
                    'width' => '25%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addField('phone', 'acfe_phone_number', [
                    'required' => 0,
                    'label' => 'Phone Number',
                    'default_country' => 'us',
                        'countries' => array(
                            'us',
                            'ca'
                        ),
                    'wrapper' => [
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addField('fax', 'acfe_phone_number', [
                    'required' => 0,
                    'label' => 'Fax Number',
                    'default_country' => 'us',
                        'countries' => array(
                            'us',
                            'ca'
                        ),
                    'wrapper' => [
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
            ->endGroup()
            ->addRepeater('company_notes', [
                    'label' => 'Notes',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    ],
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'row',
                    'button_label' => 'Add Note',
                    'sub_fields' => [],
                ])
                ->addText('note', [
                    'label' => 'Note',
                    'wrapper' => [
                    'width' => '25%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addField('note_date', 'acfe_hidden', [
                    'label' => 'Date',
                    'instructions' => '',
                    'readonly' => 1,
                    'required' => 1,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'default_value' => $todaysDate,
                    'placeholder' => '',
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
                ])
                ->endRepeater();

        return $companies->build();
    }
}
