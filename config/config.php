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

    'account_suffix' => env('ADINSPECTOR_ACCOUNT_SUFFIX', env('LDAP_ACCOUNT_SUFFIX', "@company.com")),

    /*
    |--------------------------------------------------------------------------
    | Base DN
    |--------------------------------------------------------------------------
    |
    | Enter the LDAP/AD "Base DN" to bind to.
    |
    */

    'base_dn' => env('ADINSPECTOR_BASE_DN', env('LDAP_BASE_DN', "DC=department,DC=company,DC=com")),

    /*
    |--------------------------------------------------------------------------
    | Server
    |--------------------------------------------------------------------------
    |
    | Enter the fully qualified hostname for your LDAP server or AD domain
    | controller.
    |
    */

    'server' => [ env('ADINSPECTOR_SERVER', env('LDAP_SERVER', "ldapsrv01.company.com")) ],

    /*
    |--------------------------------------------------------------------------
    | Port
    |--------------------------------------------------------------------------
    |
    | Enter the TCP port number to connect to your AD/LDAP server.
    |
    */

    'port' => env('ADINSPECTOR_PORT', env('LDAP_PORT', 389)),

    /*
    |--------------------------------------------------------------------------
    | User name
    |--------------------------------------------------------------------------
    |
    | Enter the name of the user that will query the AD/LDAP server.
    |
    */

    'user_name' => env('ADINSPECTOR_USER_NAME', env('LDAP_USER_NAME', "ldap_reader")),

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Enter the password of the user that will query the AD/LDAP server.
    |
    */

    'password' => env('ADINSPECTOR_PASSWORD', env('LDAP_PASSWORD', "PaSsWoRd")),

    /*
    |--------------------------------------------------------------------------
    | Return real primary group
    |--------------------------------------------------------------------------
    |
    | Fix Microsoft AD not following standards by not returning the real
    | primary group, may incur extra processing.
    |
    */

    'return_real_primary_group' => env('ADINSPECTOR_RETURN_REAL_PRIMARY_GROUP', env('LDAP_RETURN_REAL_PRIMARY_GROUP', true)),

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

    'secured' => env('ADINSPECTOR_SECURED', env('LDAP_SECURED', false)),

    /*
    |--------------------------------------------------------------------------
    | Secured port
    |--------------------------------------------------------------------------
    |
    | Enter the port number to use when using secured communications.
    |
    */

    'secured_port' => env('ADINSPECTOR_SECURED_PORT', env('LDAP_SECURED_PORT', 636)),

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

    'recursive_groups' => env('ADINSPECTOR_RECURSIVE_GROUPS', env('LDAP_RECURSIVE_GROUPS', false)),

    /*
    |--------------------------------------------------------------------------
    | User name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user name.
    |
    */

    'username_field' => env('ADINSPECTOR_USERNAME_FIELD', env('LDAP_USERNAME_FIELD', "samaccountname")),

    /*
    |--------------------------------------------------------------------------
    | Email field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's email address.
    |
    */

    'email_field' => env('ADINSPECTOR_EMAIL_FIELD', env('LDAP_EMAIL_FIELD', "userprincipalname")),

    /*
    |--------------------------------------------------------------------------
    | First name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's first name.
    |
    */

    'first_name_field' => env('ADINSPECTOR_FIRST_NAME_FIELD', env('LDAP_FIRST_NAME_FIELD', "givenname")),

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's last name.
    |
    */

    'last_name_field' => env('ADINSPECTOR_LAST_NAME_FIELD', env('LDAP_LAST_NAME_FIELD', "sn")),


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
//    'user_filter' => env('ADINSPECTOR_USER_FILTER', env('LDAP_USER_FILTER', "(&(objectcategory=person)(samaccountname=%username))")),


];

