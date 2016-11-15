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

    'account_suffix' => env('active_directory_inspector.account_suffix', env('ldap.account_suffix', "@company.com_from_module")),

    /*
    |--------------------------------------------------------------------------
    | Base DN
    |--------------------------------------------------------------------------
    |
    | Enter the LDAP/AD "Base DN" to bind to.
    |
    */

    'base_dn' => env('active_directory_inspector.base_dn', env('ldap.base_dn', "DC=department,DC=company,DC=com")),

    /*
    |--------------------------------------------------------------------------
    | Server
    |--------------------------------------------------------------------------
    |
    | Enter the fully qualified hostname for your LDAP server or AD domain
    | controller.
    |
    */

    'server' => [ env('active_directory_inspector.server', env('ldap.server', "ldapsrv01.company.com")) ],

    /*
    |--------------------------------------------------------------------------
    | Port
    |--------------------------------------------------------------------------
    |
    | Enter the TCP port number to connect to your AD/LDAP server.
    |
    */

    'port' => env('active_directory_inspector.port', env('ldap.port', 389)),

    /*
    |--------------------------------------------------------------------------
    | User name
    |--------------------------------------------------------------------------
    |
    | Enter the name of the user that will query the AD/LDAP server.
    |
    */

    'user_name' => env('active_directory_inspector.user_name', env('ldap.user_name', "ldap_reader")),

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Enter the password of the user that will query the AD/LDAP server.
    |
    */

    'password' => env('active_directory_inspector.password', env('ldap.password', "PaSsWoRd")),

    /*
    |--------------------------------------------------------------------------
    | Return real primary group
    |--------------------------------------------------------------------------
    |
    | Fix Microsoft AD not following standards by not returning the real
    | primary group, may incur extra processing.
    |
    */

    'return_real_primary_group' => env('active_directory_inspector.return_real_primary_group', env('ldap.return_real_primary_group', true)),

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

    'secured' => env('active_directory_inspector.secured', env('ldap.secured', false)),

    /*
    |--------------------------------------------------------------------------
    | Secured port
    |--------------------------------------------------------------------------
    |
    | Enter the port number to use when using secured communications.
    |
    */

    'secured_port' => env('active_directory_inspector.secured_port', env('ldap.secured_port', 636)),

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

    'recursive_groups' => env('active_directory_inspector.recursive_groups', env('ldap.recursive_groups', false)),

    /*
    |--------------------------------------------------------------------------
    | User name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user name.
    |
    */

    'username_field' => env('active_directory_inspector.username_field', env('ldap.username_field', "samaccountname")),

    /*
    |--------------------------------------------------------------------------
    | Email field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's email address.
    |
    */

    'email_field' => env('active_directory_inspector.email_field', env('ldap.email_field', "userprincipalname")),

    /*
    |--------------------------------------------------------------------------
    | First name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's first name.
    |
    */

    'first_name_field' => env('active_directory_inspector.first_name_field', env('ldap.first_name_field', "givenname")),

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's last name.
    |
    */

    'last_name_field' => env('active_directory_inspector.last_name_field', env('ldap.last_name_field', "sn")),


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
//    'user_filter' => env('active_directory_inspector.user_filter', env('ldap_user_filter', "(&(objectcategory=person)(samaccountname=%username))")),


];

