<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class LocationStores extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $locationStores = new FieldsBuilder('store_details');

        $locationStores
            ->setLocation('taxonomy', '==', 'store');

        $locationStores 
            ->addText('store_name', [
                'label' => 'Store Name',
                'wrapper' => [
                'width' => '100%',
                'class' => '',
                'id' => '',
                ],
            ])
            ->addTaxonomy('choose_recon_center', [
                'label' => 'Recon Center',
                'instructions' => 'Choose the recon center location this parts store is associated with.',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'taxonomy' => 'recon-center',
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
            ->endGroup();

        return $locationStores->build();
    }
}
