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

                ->addText('first_name', [
                    'label' => 'First Name',
                    'required' => 0,
                    'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addText('last_name', [
                    'label' => 'Last Name',
                    'required' => 0,
                    'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addRepeater('phone_numbers', [
                    'label' => 'Phone Numbers',
                    'instructions' => 'Add phone numbers.',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    ],
                    'min' => 0,
                    'max' => 0,
                    'layout' => 'block',
                    'button_label' => 'Add Phone Number',
                    'sub_fields' => [],
                ])
                    ->addSelect('phone_type', [
                        'label' => 'Phone Type',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [],
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'choices' => ['Cell', 'Home', 'Office'],
                        'default_value' => [],
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'return_format' => 'value',
                        'placeholder' => '',
                    ])
                    ->addField('phone', 'phone_number', [
                        'national' => 1,
                        'return_format' => 'array',
                    ])
                        ->setConfig('default_country', 'us')
                ->endRepeater()
                ->addText('email', [
                    'label' => 'Email Address',
                    'required' => 0,
                    'wrapper' => [
                    'width' => '',
                    'class' => '',
                    'id' => '',
                    ],
                ])
                ->addSelect('position_title', [
                    'label' => 'Position / Title',
                    'instructions' => '',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'choices' => ['Store Manager', 'Key Tech'],
                    'default_value' => [],
                    'allow_null' => 1,
                    'multiple' => 0,
                    'ui' => 1,
                    'ajax' => 1,
                    'return_format' => 'value',
                    'placeholder' => '',
                ])
                ->addTrueFalse('main_key_tech', [
                    'label' => 'Main Key Tech?',
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
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ])
                    ->conditional('position_title', '==', 'Key Tech')
            ->endGroup()
            ->addGroup('location_relationship', [
                'label' => 'Location',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
                ],
                'layout' => 'block',
                'sub_fields' => [],
            ])
                ->addTrueFalse('assign_location', [
                    'label' => 'Assign Location?',
                    'instructions' => 'Would you like to assign a location to this contact?',
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
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ])
                ->addRelationship('location', [
                    'label' => 'Location',
                    'instructions' => 'Choose a location for this contact.',
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
                ->conditional('assign_location', '==', 1)
            ->endGroup()
            ->addGroup('company_relationship', [
                'label' => 'Company',
                'instructions' => '',
                'required' => 0,
                'conditional_logic' => [],
                'wrapper' => [
                'width' => '',
                'class' => '',
                'id' => '',
                ],
                'layout' => 'block',
                'sub_fields' => [],
            ])
                ->addTrueFalse('assign_company', [
                    'label' => 'Assign Company?',
                    'instructions' => 'Would you like to assign a company to this contact?',
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
                    'ui_on_text' => '',
                    'ui_off_text' => '',
                ])
                ->addRelationship('company', [
                    'label' => 'Company',
                    'instructions' => 'Choose a company for this contact.',
                    'required' => 0,
                    'conditional_logic' => [],
                    'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                    ],
                    'post_type' => ['companies'],
                    'taxonomy' => [],
                    'filters' => [
                        0 => 'search',
                    ],
                    'elements' => '',
                    'min' => '0',
                    'max' => '1',
                    'return_format' => 'object',
                ])
                ->conditional('assign_company', '==', 1)
            ->endGroup()
            

            
            
            ->addGroup('access_details', [
                'label' => 'Forum Access',
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
            

            ->addTrueFalse('forum_access', [
                'label' => 'Add Forum Access?',
                'instructions' => 'Would you like to add their forum access information?',
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
                ->conditional('forum_access', '==', 1)
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
                    'layout' => 'table',
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
                    ->addTimePicker('training_time', [
                        'label' => 'Training Time',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => [],
                        'wrapper' => [
                            'width' => '',
                            'class' => '',
                            'id' => '',
                        ],
                        'display_format' => 'g:i a',
                        'return_format' => 'g:i a',
                        'default_value' => '',
                    ])
                    ->addText('training_note', [
                        'instructions' => 'Enter a note for this training date.',
                        'required' => 0,
                        'type' => 'text',
                        'wrapper' => [
                        'width' => '',
                        'class' => '',
                        'id' => '',
                        ],
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
