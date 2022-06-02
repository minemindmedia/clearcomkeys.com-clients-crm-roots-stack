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

        $companies
            ->setLocation('taxonomy', '==', 'company');

        $companies 
            ->addText('company', [
                'label' => 'Company',
                'wrapper' => [
                'width' => '100%',
                'class' => '',
                'id' => '',
                ],
            ])
            ->addTaxonomy('choose_location', [
                'label' => 'Location',
                'instructions' => 'Choose the location this company is associated with.',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'taxonomy' => 'location',
                'field_type' => 'select',
                'allow_null' => 1,
                'add_term' => 0,
                'save_terms' => 1,
                'load_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
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
                    'required' => 1,
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
                    'required' => 1,
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
            ->endGroup();

        return $companies->build();
    }
}
