<?php

namespace App\Fields;

use Log1x\AcfComposer\Field;
use StoutLogic\AcfBuilder\FieldsBuilder;

class Contacts extends Field
{
    /**
     * The field group.
     *
     * @return array
     */
    public function fields()
    {
        $contacts = new FieldsBuilder('location_contacts');
        $todaysDate = date("F j, Y, g:i a");

        $contacts
            ->setLocation('post_type', '==', 'contacts');

        $contacts
            ->addTaxonomy('company', [
                'label' => 'Companny',
                'instructions' => 'Choose a <b>company</b> for this user. If the company doesn\'t exist, add one first or choose uncategorized.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'taxonomy' => 'company',
                'field_type' => 'select',
                'allow_null' => 1,
                'add_term' => 0,
                'save_terms' => 1,
                'load_terms' => 0,
                'return_format' => 'object',
                'multiple' => 0,
            ])

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
                ->conditional('recon_center_location', '!=', '')
                    ->or('store_location', '!=', '')

                ->addText('first_name', [
                    'required' => 1,
                    'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('last_name', [
                    'required' => 1,
                    'wrapper' => [
                    'width' => '',
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
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('email', [
                    'required' => 1,
                    'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    'acfe_field_group_condition' => 1,
                    ],
                ])
            ->endGroup()

            ->addGroup('access_details', [
                'label' => 'Access Details',
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
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('password', [
                    'instructions' => 'Enter the users website password.',
                    'required' => 1,
                    'type' => 'text',
                    'wrapper' => [
                    'width' => '',
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
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'message' => '',
                    'default_value' => 0,
                    'ui' => 1,
                    'ui_on_text' => 'Yes',
                    'ui_off_text' => 'No',
                ])
            ->endGroup()

            ->addRepeater('training_dates', [
                    'label' => 'Training Dates',
                    'instructions' => 'To add a training date, click the blue "Add Training Date" button below.',
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
                    'button_label' => 'Add Training Date',
                    'sub_fields' => [],
                ])
                    ->addDatePicker('training_date', [
                        'label' => 'Training Date',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [],
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'display_format' => 'F j, Y',
                        'return_format' => 'Y-m-d',
                    ])
            ->endRepeater()
                

            ->addRepeater('notes', [
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
                        'label' => 'Add Note',
                        'instructions' => '',
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
            
            

        return $contacts->build();
            
        
    }
}
