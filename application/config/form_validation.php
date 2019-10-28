<?php
$config = array(
    'page_add' => array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'required|is_unique[pages.slug]'
        ),
    ),
    'page_edit' => array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'required'
        ),
    ),
    'post_add' => array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'required|is_unique[posts.slug]'
        ),
    ),
    'post_edit' => array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'required'
        ),
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'required'
        ),
    ),
    'post_category_add' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'required|is_unique[categories.slug]'
        ),
    ),
    'post_category_edit' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'required'
        ),
    ),
    'contact' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'required'
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'required|valid_email'
        ),
        array(
            'field' => 'message',
            'label' => 'Message',
            'rules' => 'required'
        )
    ),

    'change_password' => array(
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Password is required'
            )
        ),
        array(
            'field' => 'new_password',
            'label' => 'New Password',
            'rules' => 'trim|required|min_length[7]|max_length[25]|matches[conf_password]',
            'errors' => array(
                'required' => 'New password is required',
                'matches' => 'Password not match'
            )
        ),

        array(
            'field' => 'conf_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required',
            'errors' => array(
                'required' => 'Password confirmation is required',

            )
        )
    ),
    'add_user' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|max_length[16]',
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|max_length[25]|matches[confirm_password]',
            'errors' => array(
                'matches' => 'The Password field does not match the Confirm Password field.'
            ),
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'role',
            'label' => 'Role',
            'rules' => 'trim|required',
        ),
    ),
    'edit_user' => array(
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|max_length[16]',
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|max_length[25]|matches[confirm_password]',
            'errors' => array(
                'matches' => 'The Password field does not match the Confirm Password field.'
            ),
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'trim',
        ),
        array(
            'field' => 'role',
            'label' => 'Role',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'id',
            'label' => 'Id',
            'rules' => 'trim|required',
        ),
    ),

    'sermon' => array(
        array(
            'field' => 'title',
            'label' => 'Title   ',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Title is required'
            )
        ),
        array(
            'field' => 'date',
            'label' => 'Date',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Date is required'
            )
        ),

        array(
            'field' => 'pastor',
            'label' => 'Speaker',
            'rules' => 'required',
            'errors' => array(
                'required' => 'Speaker is required'
            )
        ),
    ),
    'register' => array(
        array(
            'field' => 'first_name',
            'label' => 'First Name',
            'rules' => 'trim|required|max_length[100]',
        ),
        array(
            'field' => 'last_name',
            'label' => 'Last Name',
            'rules' => 'trim|required|max_length[100]',
        ),
        array(
            'field' => 'username',
            'label' => 'Username',
            'rules' => 'trim|required|min_length[6]|max_length[16]|is_unique[users.username]',
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
        ),
        array(
            'field' => 'password',
            'label' => 'Password',
            'rules' => 'trim|required|min_length[6]|max_length[25]|matches[confirm_password]',
            'errors' => array(
                'matches' => 'The Password field does not match the Confirm Password field.'
            ),
        ),
        array(
            'field' => 'confirm_password',
            'label' => 'Confirm Password',
            'rules' => 'trim|required|matches[password]',
        ),
    ),
    'add_plan' => array(
        array(
            'field' => 'name',
            'label' => 'ID',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'nice_name',
            'label' => 'Name',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'amount',
            'label' => 'Amount',
            'rules' => 'trim|required',
        ),

    ),
    'edit_plan' => array(
        array(
            'field' => 'nice_name',
            'label' => 'Name',
            'rules' => 'trim|required',
        ),
    ),
    'add_event' => array(
        array(
            'field' => 'title',
            'label' => 'Title',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'date',
            'label' => 'Date',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'time',
            'label' => 'Time',
            'rules' => 'trim',
        ),
        array(
            'field' => 'location',
            'label' => 'Location',
            'rules' => 'trim',
        ),
        array(
            'field' => 'details',
            'label' => 'Details',
            'rules' => 'trim',
        ),
    ),
    'add_volunteer_schedule' => array(
        array(
            'field' => 'persons',
            'label' => 'Persons',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'date',
            'label' => 'Date',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'time',
            'label' => 'Time',
            'rules' => 'trim',
        ),
        array(
            'field' => 'location',
            'label' => 'Location',
            'rules' => 'trim',
        ),
        array(
            'field' => 'details',
            'label' => 'Details',
            'rules' => 'trim',
        ),
    ),
    'add_volunteer_schedule_file' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'file',
            'label' => 'File',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'is_active',
            'label' => 'IsActive',
            'rules' => 'trim',
        ),
    ),
    'add_email' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|required|is_unique[emails.slug]',
        ),
        array(
            'field' => 'template',
            'label' => 'template',
            'rules' => 'trim|required',
        ),
    ),
    'edit_email' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'slug',
            'label' => 'Slug',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'template',
            'label' => 'template',
            'rules' => 'trim|required',
        ),
    ),
    'add_subscriber' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'email',
            'label' => 'Email',
            'rules' => 'trim|required|valid_email',
        ),
    ),
    'widget_edit' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'is_enabled',
            'label' => 'Is Active',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'ordering',
            'label' => 'Ordering',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'location',
            'label' => 'Location',
            'rules' => 'trim|required',
        ),
        array(
            'field' => 'function_name',
            'label' => 'Function Name',
            'rules' => 'trim|required',
        ),
    ),
    'add_setting' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required|is_unique[settings.name]',
        ),
    ),
    'edit_setting' => array(
        array(
            'field' => 'name',
            'label' => 'Name',
            'rules' => 'trim|required',
        ),
    ),
);
