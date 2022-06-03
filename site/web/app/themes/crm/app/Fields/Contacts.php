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
        $contacts = new FieldsBuilder('contacts');
        $todaysDate = date("F j, Y, g:i a");

        $contacts
            ->setLocation('post_type', '==', 'contacts');

        $contacts
            ->addSelect('existing_new', [
                'label' => 'New Location or Existing?',
                'instructions' => 'Create a new location or choose an existing one.',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'choices' => ['Choose one', 'Existing', 'New'],
                'default_value' => ['Choose one'],
                'allow_null' => 0,
                'multiple' => 0,
                'ui' => 0,
                'ajax' => 0,
                'return_format' => 'value',
                'placeholder' => '',
            ])
            ->addTaxonomy('location', [
                'label' => 'Location',
                'instructions' => 'Choose an existing location for this contact.',
                'required' => 0,
                'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                ],
                'taxonomy' => 'location',
                'field_type' => 'select',
                'allow_null' => 1,
                'add_term' => 1,
                'save_terms' => 1,
                'load_terms' => 1,
                'return_format' => 'object',
                'multiple' => 0,
            ])
            ->conditional('existing_new', '==', 'Existing')
            ->addText('new_location', [
                'label' => 'New Location Name',
                'instructions' => 'Enter the new location name for this contact',
                'required' => 0,
                'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
                ],
            ])
            ->conditional('existing_new', '==', 'New')
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
            ->conditional('location', '!=', '')
                ->or('new_location', '!=', '')

                ->addText('first_name', [
                    'required' => 0,
                    'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('last_name', [
                    'required' => 0,
                    'wrapper' => [
                    'width' => '',
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
                    ],
                ])
            ->endGroup()

            ->addTrueFalse('add_access_details', [
                'label' => 'Add Access Details?',
                'instructions' => 'Would you like to add their website access information?',
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
            ->conditional('location', '!=', '')
                ->or('new_location', '!=', '')
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
            ->conditional('add_access_details', '==', 1)
                ->addText('login', [
                    'instructions' => 'Enter the users website login.',
                    'required' => 0,
                    'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('password', [
                    'instructions' => 'Enter the users website password.',
                    'required' => 0,
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

            ->addTrueFalse('add_training_dates', [
                'label' => 'Add Training Dates?',
                'instructions' => 'Would you like to add any training dates for this contact?',
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
            ->conditional('location', '!=', '')
                ->or('new_location', '!=', '')
            ->addRepeater('training_dates', [
                    'label' => 'Training Dates',
                    'instructions' => 'To add training dates, click the button.',
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
                ->conditional('add_training_dates', '==', 1)
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
                
            ->addTrueFalse('add_notes', [
                'label' => 'Add Notes?',
                'instructions' => 'Would you like to add any notes for this contact?',
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
            ->conditional('location', '!=', '')
                ->or('new_location', '!=', '')
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
                ->conditional('add_notes', '==', 1)
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
