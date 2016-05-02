<?php

return [

    'audit-log'           => [
        'category'              => 'ActiveDirectoryInspector',
        'msg-method-name'       => 'Accessed method-name ActiveDirectoryInspector: :var.',
    ],

    'status'           => [
        'error-retrieving-ad-record'      => 'Error retrieving AD record.',
        'no-records-found'                => 'No record found.',
    ],

    'columns'           => [
        'type'                        => 'Type',
        'cn'                          => 'CN',
        'dn'                          => 'DN',
        'samaccountname'              => 'sAMAccountName',
        'group_name'                  => 'Group name',
        'description'                 => 'Description',
        'email'                       => 'Email',
        'first_name'                  => 'First name',
        'last_name'                   => 'Last name',
        'displayname'                 => 'Display name',
        'physicaldeliveryofficename'  => 'Office',
        'telephonenumber'             => 'Telephone number',
        'key'                         => 'Key',
        'value'                       => 'Value',
    ],

    'tabs'           => [
        'general'       => 'General',
        'members'       => 'Members',
        'member_of'     => 'Member of',
        'raw'           => 'Raw',
    ],

    'page'              => [
        'home'              => [
            'title'                     => 'AD Inspector | Search',
            'description'               => 'Search using the Active Directory Inspector.',
            'box-title'                 => 'Search: ',
        ],
        'show-group'   => [
            'title'                     => 'AD Inspector | Show group',
            'description'               => 'Displaying AD group: :groupName.',
        ],
        'show-user'   => [
            'title'                     => 'AD Inspector | Show user',
            'description'               => 'Displaying AD user: :userName.',
        ],
        'show-misc'   => [
            'title'                     => 'AD Inspector | Show misc',
            'description'               => 'Displaying misc AD entry.',
        ],
    ],

];
