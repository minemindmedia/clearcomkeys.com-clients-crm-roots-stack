<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class LocationContacts extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $locationContacts = new FieldsBuilder('location_contacts');

        $locationContacts
            ->setLocation('post_type', '==', 'contacts');

        $locationContacts
            ->addSelect('dealer_store', [
                'label' => 'Dealership or Store?',
                'instructions' => 'Is this contact for a dealership or store?',
                'required' => 1,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '100%',
                    'class' => '',
                    'id' => '',
                ],
                'choices' => ['Dealership', 'Store'],
                'default_value' => ['Choose one'],
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 1,
                'ajax' => 1,
                'return_format' => 'value',
                'placeholder' => 'Choose One',
       
            ])
            ->addSelect('contact_type_dealership', [
                'label' => 'Dealership Contact Type',
                'instructions' => 'Please choose a contact type:',
                'required' => 1,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '100%',
                    'class' => '',
                    'id' => '',
                ],
                'choices' => ['Regional Manager', 'Operations Manager', 'Lead', 'Key Technician'],
                'default_value' => ['Choose one'],
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 1,
                'ajax' => 1,
                'return_format' => 'value',
                'placeholder' => 'Choose One',
                'acfe_field_group_condition' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'dealer_store',
                            'operator' => '==',
                            'value' => 'Dealership'
                        ),
                    ),
                ),  
            ])
            ->addSelect('contact_type_store', [
                'label' => 'Store Contact Type',
                'instructions' => 'Please choose a contact type:',
                'required' => 1,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '100%',
                    'class' => '',
                    'id' => '',
                ],
                'choices' => ['Store Manager', 'Main Key Orderer'],
                'default_value' => [],
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 1,
                'ajax' => 1,
                'return_format' => 'value',
                'placeholder' => 'Choose One',
                'acfe_field_group_condition' => 1,
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'dealer_store',
                            'operator' => '==',
                            'value' => 'Store'
                        ),
                    ),
                ),  
            ])
            ->addSelect('key_technician', [
                'label' => 'Technician Type',
                'instructions' => 'Please choose a technician type:',
                'required' => 1,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '100%',
                    'class' => '',
                    'id' => '',
                ],
                'choices' => ['Main', 'Other'],
                'default_value' => [],
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 1,
                'ajax' => 1,
                'return_format' => 'value',
                'placeholder' => 'Choose One',
                'conditional_logic' => array(
                    array(
                        array(
                            'field' => 'contact_type',
                            'operator' => '==',
                            'value' => 'Key Technician'
                        ),
                    ),
                ),  
            ])
            
            ->addTaxonomy('dealership_location', [
                'label' => 'Dealership Location',
                'instructions' => 'Choose a <b>DEALERSHIP LOCATION</b> for this user. If the location doesn\'t exist, then you must <a href="/wp/wp-admin/edit-tags.php?taxonomy=dealership&post_type=contacts" target="_blank">add one</a> first.',
                'required' => 1,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'taxonomy' => 'dealership',
                'field_type' => 'checkbox',
                'allow_null' => 0,
                'add_term' => 0,
                'save_terms' => 0,
                'load_terms' => 0,
                'return_format' => 'label',
                'multiple' => 0,
            ])
                ->conditional('dealer_store', '==', 'Dealership')
                    ->and('contact_type_dealership', '!=', '')

            ->addTaxonomy('store_location', [
                'label' => 'Store Location',
                'instructions' => 'Choose a <b>STORE LOCATION</b> for this user. If the location doesn\'t exist, then you must <a href="/wp/wp-admin/edit-tags.php?taxonomy=store&post_type=contacts" target="_blank">add one</a> first.',
                'required' => 1,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'taxonomy' => 'store',
                'field_type' => 'select',
                'allow_null' => 0,
                'add_term' => 1,
                'save_terms' => 0,
                'load_terms' => 0,
                'return_format' => 'value',
                'multiple' => 0,
            ])
                ->conditional('dealer_store', '==', 'Store')
                    ->and('contact_type_store', '!=', '')

            ->addGroup('contact_details', [
                'label' => 'Contact Details',
                'instructions' => '',
                'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
                ],
                'layout' => 'block',
                'sub_fields' => [],
            ])
                ->conditional('dealership_location', '!=', '')
                    ->or('store_location', '!=', '')

                ->addText('first_name', [
                    'required' => 1,
                    'wrapper' => [
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('last_name', [
                    'required' => 1,
                    'wrapper' => [
                    'width' => '50%',
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
                ->addText('email', [
                    'required' => 1,
                    'wrapper' => [
                    'width' => '50%',
                    'class' => '',
                    'id' => '',
                    'acfe_field_group_condition' => 1,
                    ],
                ])
                ->addTextarea('notes', [
                    'label' => 'Additonal Notes',
                    'instructions' => 'Add any notes to reference for this customer below.',
                    'required' => 0,
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'default_value' => '',
                    'placeholder' => '',
                    'maxlength' => '',
                    'rows' => '',
                    'new_lines' => '', // Possible values are 'wpautop', 'br', or ''.
                ])
            ->endGroup()

            ->addGroup('additional_details', [
                'label' => 'Additional Details',
                'instructions' => '',
                'required' => 0,
                'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
                ],
                'layout' => 'block',
                'sub_fields' => [],
            ])
            ->conditional('field_location_contacts_contact_details_email', '!=', '')
                ->and('field_location_contacts_contact_type', '!=', 'Regional Manager')

                ->addText('login', [
                    'instructions' => 'Enter the users website login.',
                    'required' => 1,
                    'wrapper' => [
                    'width' => '33.3%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('password', [
                    'instructions' => 'Enter the users website password.',
                    'required' => 1,
                    'type' => 'text',
                    'wrapper' => [
                    'width' => '33.3%',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addTrueFalse('forum_access', [
                    'label' => 'Forum Access?',
                    'instructions' => 'Has this user been granted forum access?',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '33.3%',
                        'class' => '',
                        'id' => '',
                    ],
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 1,
                    'ui_on_text' => 'Yes',
                    'ui_off_text' => 'No',
                ])
                ->addRepeater('training_dates', [
                    'label' => 'Training Dates',
                    'instructions' => 'To add a training date, click the blue "Add Training Date" button below.',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                    'width' => '100%',
                    'class' => '',
                    'id' => '',
                    ],
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'row',
                    'button_label' => 'Add Training Date',
                    'sub_fields' => [],
                ])
                    ->addDateTimePicker('training_date', [
                        'label' => 'Training Date',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [],
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'display_format' => 'F j, Y g:i a',
                        'return_format' => 'Y-m-d H:i:s',
                    ])
                ->endRepeater()
                
                
            ->endGroup();
            
            

        return $locationContacts->build();
            
        
    }
}
