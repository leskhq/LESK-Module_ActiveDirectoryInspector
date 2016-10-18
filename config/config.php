<?php
return [

    /*
    |--------------------------------------------------------------------------
    | Account suffix
    |--------------------------------------------------------------------------
    |
    | Enter the right part of the email address, after and including the "@"
    | sign, configured in your domain. For Microsoft Active Directory this
    | can be your domain name, preceded by the "@" sign.
    |
    */

    'account_suffix' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.ACCOUNT_SUFFIX', env('LDAP.ACCOUNT_SUFFIX', "@company.com")),

    /*
    |--------------------------------------------------------------------------
    | Base DN
    |--------------------------------------------------------------------------
    |
    | Enter the LDAP/AD "Base DN" to bind to.
    |
    */

    'base_dn' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.BASE_DN', env('LDAP.BASE_DN', "DC=department,DC=company,DC=com")),

    /*
    |--------------------------------------------------------------------------
    | Server
    |--------------------------------------------------------------------------
    |
    | Enter the fully qualified hostname for your LDAP server or AD domain
    | controller.
    |
    */

    'server' => [ env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.SERVER', env('LDAP.SERVER', "ldapsrv01.company.com")) ],

    /*
    |--------------------------------------------------------------------------
    | Port
    |--------------------------------------------------------------------------
    |
    | Enter the TCP port number to connect to your AD/LDAP server.
    |
    */

    'port' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.PORT', env('LDAP.PORT', 389)),

    /*
    |--------------------------------------------------------------------------
    | User name
    |--------------------------------------------------------------------------
    |
    | Enter the name of the user that will query the AD/LDAP server.
    |
    */

    'user_name' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.USER_NAME', env('LDAP.USER_NAME', "ldap_reader")),

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Enter the password of the user that will query the AD/LDAP server.
    |
    */

    'password' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.PASSWORD', env('LDAP.PASSWORD', "PaSsWoRd")),

    /*
    |--------------------------------------------------------------------------
    | Return real primary group
    |--------------------------------------------------------------------------
    |
    | Fix Microsoft AD not following standards by not returning the real
    | primary group, may incur extra processing.
    |
    */

    'return_real_primary_group' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.RETURN_REAL_PRIMARY_GROUP', env('LDAP.RETURN_REAL_PRIMARY_GROUP', true)),

    /*
    |--------------------------------------------------------------------------
    | Enable encryption?
    |--------------------------------------------------------------------------
    |
    | Enables the use of encryption to communicate with LDAP/AD using either
    | SSL or TLS.
    |
    | Supported values: false, "ssl", "tls"
    |
    */

    'secured' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.SECURED', env('LDAP.SECURED', false)),

    /*
    |--------------------------------------------------------------------------
    | Secured port
    |--------------------------------------------------------------------------
    |
    | Enter the port number to use when using secured communications.
    |
    */

    'secured_port' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.SECURED_PORT', env('LDAP.SECURED_PORT', 636)),

    /*
    |--------------------------------------------------------------------------
    | Resolve all group membership?
    |--------------------------------------------------------------------------
    |
    | Resolve group membership recursively. When disabled only groups that a
    | given user is a direct member of will be returned. May incur extra
    | processing.
    |
    */

    'recursive_groups' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.RECURSIVE_GROUPS', env('LDAP.RECURSIVE_GROUPS', false)),

    /*
    |--------------------------------------------------------------------------
    | User name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user name.
    |
    */

    'username_field' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.USERNAME_FIELD', env('LDAP.USERNAME_FIELD', "samaccountname")),

    /*
    |--------------------------------------------------------------------------
    | Email field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's email address.
    |
    */

    'email_field' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.EMAIL_FIELD', env('LDAP.EMAIL_FIELD', "userprincipalname")),

    /*
    |--------------------------------------------------------------------------
    | First name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's first name.
    |
    */

    'first_name_field' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.FIRST_NAME_FIELD', env('LDAP.FIRST_NAME_FIELD', "givenname")),

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's last name.
    |
    */

    'last_name_field' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.LAST_NAME_FIELD', env('LDAP.LAST_NAME_FIELD', "sn")),


//    /*
//    |--------------------------------------------------------------------------
//    | User query filter
//    |--------------------------------------------------------------------------
//    |
//    | Enter the LDAP filter or query string to search for users.
//    |
//    | TIP: Use the command line `ldapsearch` to help you build and test your
//    | query string.
//    |
//    | NOTE: The variable `%username` must be used and will be replaced by the
//    | correct value when executed.
//    |
//    */
//
//    'user_filter' => env('MODULES.ACTIVE_DIRECTORY_INSPECTOR.USER_FILTER', env('LDAP_USER_FILTER', "(&(objectcategory=person)(samaccountname=%username))")),


];

