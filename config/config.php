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

    'account_suffix' => Setting::get('active_directory_inspector.account_suffix', Setting::get('ldap.account_suffix', "@company.com")),

    /*
    |--------------------------------------------------------------------------
    | Base DN
    |--------------------------------------------------------------------------
    |
    | Enter the LDAP/AD "Base DN" to bind to.
    |
    */

    'base_dn' => Setting::get('active_directory_inspector.base_dn', Setting::get('ldap.base_dn', "DC=department,DC=company,DC=com")),

    /*
    |--------------------------------------------------------------------------
    | Server
    |--------------------------------------------------------------------------
    |
    | Enter the fully qualified hostname for your LDAP server or AD domain
    | controller.
    |
    */

    'server' => [ Setting::get('active_directory_inspector.server', Setting::get('ldap.server', "ldapsrv01.company.com")) ],

    /*
    |--------------------------------------------------------------------------
    | Port
    |--------------------------------------------------------------------------
    |
    | Enter the TCP port number to connect to your AD/LDAP server.
    |
    */

    'port' => Setting::get('active_directory_inspector.port', Setting::get('ldap.port', 389)),

    /*
    |--------------------------------------------------------------------------
    | User name
    |--------------------------------------------------------------------------
    |
    | Enter the name of the user that will query the AD/LDAP server.
    |
    */

    'user_name' => Setting::get('active_directory_inspector.user_name', Setting::get('ldap.user_name', "ldap_reader")),

    /*
    |--------------------------------------------------------------------------
    | Password
    |--------------------------------------------------------------------------
    |
    | Enter the password of the user that will query the AD/LDAP server.
    |
    */

    'password' => Setting::get('active_directory_inspector.password', Setting::get('ldap.password', "PaSsWoRd")),

    /*
    |--------------------------------------------------------------------------
    | Return real primary group
    |--------------------------------------------------------------------------
    |
    | Fix Microsoft AD not following standards by not returning the real
    | primary group, may incur extra processing.
    |
    */

    'return_real_primary_group' => Setting::get('active_directory_inspector.return_real_primary_group', Setting::get('ldap.return_real_primary_group', true)),

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

    'secured' => Setting::get('active_directory_inspector.secured', Setting::get('ldap.secured', false)),

    /*
    |--------------------------------------------------------------------------
    | Secured port
    |--------------------------------------------------------------------------
    |
    | Enter the port number to use when using secured communications.
    |
    */

    'secured_port' => Setting::get('active_directory_inspector.secured_port', Setting::get('ldap.secured_port', 636)),

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

    'recursive_groups' => Setting::get('active_directory_inspector.recursive_groups', Setting::get('ldap.recursive_groups', false)),

    /*
    |--------------------------------------------------------------------------
    | User name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user name.
    |
    */

    'username_field' => Setting::get('active_directory_inspector.username_field', Setting::get('ldap.username_field', "samaccountname")),

    /*
    |--------------------------------------------------------------------------
    | Email field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's email address.
    |
    */

    'email_field' => Setting::get('active_directory_inspector.email_field', Setting::get('ldap.email_field', "userprincipalname")),

    /*
    |--------------------------------------------------------------------------
    | First name field
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's first name.
    |
    */

    'first_name_field' => Setting::get('active_directory_inspector.first_name_field', Setting::get('ldap.first_name_field', "givenname")),

    /*
    |--------------------------------------------------------------------------
    | Title
    |--------------------------------------------------------------------------
    |
    | Enter the name of the field that will contain the user's last name.
    |
    */

    'last_name_field' => Setting::get('active_directory_inspector.last_name_field', Setting::get('ldap.last_name_field', "sn")),


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
//    'user_filter' => Setting::get('active_directory_inspector.user_filter', Setting::get('ldap_user_filter', "(&(objectcategory=person)(samaccountname=%username))")),


];

