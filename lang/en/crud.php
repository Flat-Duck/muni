<?php

return [
    'common' => [
        'actions' => 'Actions',
        'create' => 'Create',
        'edit' => 'Edit',
        'update' => 'Update',
        'new' => 'New',
        'cancel' => 'Cancel',
        'attach' => 'Attach',
        'detach' => 'Detach',
        'save' => 'Save',
        'delete' => 'Delete',
        'delete_selected' => 'Delete selected',
        'search' => 'Search...',
        'back' => 'Back to Index',
        'are_you_sure' => 'Are you sure?',
        'no_items_found' => 'No items found',
        'created' => 'Successfully created',
        'saved' => 'Saved successfully',
        'removed' => 'Successfully removed',
    ],

    'complaints' => [
        'name' => 'Complaints',
        'index_title' => 'Complaints List',
        'new_title' => 'New Complaint',
        'create_title' => 'Create Complaint',
        'edit_title' => 'Edit Complaint',
        'show_title' => 'Show Complaint',
        'inputs' => [
            'content' => 'Content',
            'user_id' => 'User',
            'municipality_id' => 'Municipality',
        ],
    ],

    'municipalities' => [
        'name' => 'Municipalities',
        'index_title' => 'Municipalities List',
        'new_title' => 'New Municipality',
        'create_title' => 'Create Municipality',
        'edit_title' => 'Edit Municipality',
        'show_title' => 'Show Municipality',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
        ],
    ],

    'all_news' => [
        'name' => 'All News',
        'index_title' => 'AllNews List',
        'new_title' => 'New News',
        'create_title' => 'Create News',
        'edit_title' => 'Edit News',
        'show_title' => 'Show News',
        'inputs' => [
            'title' => 'Title',
            'content' => 'Content',
            'municipality_id' => 'Municipality',
        ],
    ],

    'notifications' => [
        'name' => 'Notifications',
        'index_title' => 'Notifications List',
        'new_title' => 'New Notification',
        'create_title' => 'Create Notification',
        'edit_title' => 'Edit Notification',
        'show_title' => 'Show Notification',
        'inputs' => [
            'title' => 'Title',
            'description' => 'Description',
            'seen' => 'Seen',
            'user_id' => 'User',
        ],
    ],

    'orders' => [
        'name' => 'Orders',
        'index_title' => 'Orders List',
        'new_title' => 'New Order',
        'create_title' => 'Create Order',
        'edit_title' => 'Edit Order',
        'show_title' => 'Show Order',
        'inputs' => [
            'name' => 'Name',
            'status' => 'Status',
            'active' => 'Active',
            'order_type_id' => 'Order Type',
            'user_id' => 'User',
            'municipality_id' => 'Municipality',
        ],
    ],

    'order_types' => [
        'name' => 'Order Types',
        'index_title' => 'OrderTypes List',
        'new_title' => 'New Order type',
        'create_title' => 'Create OrderType',
        'edit_title' => 'Edit OrderType',
        'show_title' => 'Show OrderType',
        'inputs' => [
            'name' => 'Name',
            'description' => 'Description',
        ],
    ],

    'users' => [
        'name' => 'Users',
        'index_title' => 'Users List',
        'new_title' => 'New User',
        'create_title' => 'Create User',
        'edit_title' => 'Edit User',
        'show_title' => 'Show User',
        'inputs' => [
            'name' => 'Name',
            'email' => 'Email',
            'password' => 'Password',
            'municipality_id' => 'Municipality',
            'phone' => 'Phone',
            'birth_date' => 'Birth Date',
            'gender' => 'Gender',
            'nationality' => 'Nationality',
            'Identity' => 'Identity',
            'active' => 'Active',
        ],
    ],
];
