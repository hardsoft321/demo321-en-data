<?php
$userNameIsTest = "user_name LIKE 'test%'";

$db_defs['users'] = array(
    'table' => 'users',
    'module' => 'Users',
    'fields' => array(
        'user_name' => array(
            'name' => 'user_name',
        ),
        'user_hash' => array(
            'name' => 'user_hash',
        ),
        'system_generated_password' => array(
            'name' => 'system_generated_password',
        ),
        'pwd_last_changed' => array(
            'name' => 'pwd_last_changed',
        ),
        'authenticate_id' => array(
            'name' => 'authenticate_id',
        ),
        'sugar_login' => array(
            'name' => 'sugar_login',
        ),
        'first_name' => array(
            'name' => 'first_name',
        ),
        'last_name' => array(
            'name' => 'last_name',
        ),
        'is_admin' => array(
            'name' => 'is_admin',
        ),
        'external_auth_only' => array(
            'name' => 'external_auth_only',
        ),
        'receive_notifications' => array(
            'name' => 'receive_notifications',
        ),
        'description' => array(
            'name' => 'description',
        ),
        'title' => array(
            'name' => 'title',
        ),
        'photo' => array(
            'name' => 'photo',
        ),
        'department' => array(
            'name' => 'department',
        ),
        'phone_home' => array(
            'name' => 'phone_home',
        ),
        'phone_mobile' => array(
            'name' => 'phone_mobile',
        ),
        'phone_work' => array(
            'name' => 'phone_work',
        ),
        'phone_other' => array(
            'name' => 'phone_other',
        ),
        'phone_fax' => array(
            'name' => 'phone_fax',
        ),
        'status' => array(
            'name' => 'status',
        ),
        'address_street' => array(
            'name' => 'address_street',
        ),
        'address_city' => array(
            'name' => 'address_city',
        ),
        'address_state' => array(
            'name' => 'address_state',
        ),
        'address_country' => array(
            'name' => 'address_country',
        ),
        'address_postalcode' => array(
            'name' => 'address_postalcode',
        ),
        'portal_only' => array(
            'name' => 'portal_only',
        ),
        'show_on_employees' => array(
            'name' => 'show_on_employees',
        ),
        'employee_status' => array(
            'name' => 'employee_status',
        ),
        'messenger_id' => array(
            'name' => 'messenger_id',
        ),
        'messenger_type' => array(
            'name' => 'messenger_type',
        ),
        'reports_to_id' => array(
            'name' => 'reports_to_id',
            'type' => 'id',
            'table' => 'users',
            'required' => false,
        ),
        'is_group' => array(
            'name' => 'is_group',
        ),
        'factor_auth' => array(
            'name' => 'factor_auth',
        ),
        'factor_auth_interface' => array(
            'name' => 'factor_auth_interface',
        ),
    ),
    'indices' => array(
        array('fields' => array('user_name')),
    ),
    'condition' => "deleted = 0 AND $userNameIsTest",
);

$db_defs['email_addresses'] = array(
    'table' => 'email_addresses',
    'module' => 'EmailAddresses',
    'fields' => array(
        'email_address' =>array(
            'name'            => 'email_address',
        ),
        'email_address_caps' => array(
            'name'            => 'email_address_caps',
        ),
        'invalid_email' => array(
            'name'            => 'invalid_email',
        ),
        'opt_out' => array(
            'name'            => 'opt_out',
        ),
        'confirm_opt_in' => array(
            'name'            => 'confirm_opt_in',
        ),
    ),
    'indices' => array(
        array('fields' => array('email_address')),
    ),
    'condition' => "deleted = 0 AND id IN (SELECT email_address_id FROM email_addr_bean_rel AS rel, users AS u"
        ." WHERE u.$userNameIsTest AND u.deleted = 0 "
        ." AND rel.bean_module = 'Users' AND rel.bean_id = u.id AND rel.deleted = 0)",
);

$db_defs['email_addr_bean_rel'] = array(
    'table' => 'email_addr_bean_rel',
    'module' => 'relationship',
    'fields' => array(
        'email_address_id' => array(
            'name' => 'email_address_id',
            'type' => 'id',
            'required' => true,
            'table' => 'email_addresses',
        ),
        'bean_id' => array (
            'name' => 'bean_id',
            'type' => 'id',
            'table' => '',
            'relationship_role_column' => 'bean_module',
            'required' => 'true',
        ),
        'bean_module' => array(
            'name' => 'bean_module',
        ),
        'primary_address' => array(
            'name' => 'primary_address',
        ),
        'reply_to_address' => array(
            'name' => 'reply_to_address',
        ),
    ),
    'indices' => array(
        array('fields' => array('email_address_id', 'bean_id', 'bean_module')),
    ),
    'condition' => "deleted = 0 AND bean_module = 'Users' AND bean_id IN (SELECT id FROM users"
        ." WHERE $userNameIsTest AND deleted = 0)",
);

$db_defs['acl_roles_users'] = array(
    'table' => 'acl_roles_users',
    'module' => 'relationship',
    'fields' => array(
        'role_id' => array (
            'name' => 'role_id',
            'type' => 'id',
            'table' => 'acl_roles',
            'required' => true,
        ),
        'user_id' => array (
            'name' => 'user_id',
            'type' => 'id',
            'table' => 'users',
            'required' => true,
        ),
    ),
    'indices' => array(
        array('fields' => array('role_id', 'user_id')),
    ),
    'condition' => "deleted = 0 AND user_id IN (SELECT id FROM users"
        ." WHERE $userNameIsTest AND deleted = 0)",
);

$db_defs['securitygroups_users'] = array(
    'table' => 'securitygroups_users',
    'module' => 'relationship',
    'fields' => array(
        'securitygroup_id' => array (
            'name' => 'securitygroup_id',
            'type' => 'id',
            'table' => 'securitygroups',
            'required' => true,
        ),
        'user_id' => array (
            'name' => 'user_id',
            'type' => 'id',
            'table' => 'users',
            'required' => 'true',
        ),
        'primary_group' => array (
            'name' => 'primary_group',
        ),
        'noninheritable' => array (
            'name' => 'noninheritable',
        ),
    ),
    'indices' => array(
        array('fields' => array('securitygroup_id', 'user_id')),
    ),
    'condition' => "deleted = 0 AND user_id IN (SELECT id FROM users"
        ." WHERE $userNameIsTest AND deleted = 0)",
);
