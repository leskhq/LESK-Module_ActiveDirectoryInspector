# ActiveDirectoryInspector module

To deploy simply clone the repository into the ```Modules``` directory from the base or root [LESK](https://github.com/sroutier/laravel-enterprise-starter-kit) install, as shown below:
```
$ cd <MySuperProjectBasedOnLESK>
$ git clone https://github.com/sroutier/LESK-Module_ActiveDirectoryInspector app/Modules/ActiveDirectoryInspector
```

Then make sure to optimize the master module definition, from the base directory, with:
```
$ ./artisan module:optimize
```

# Dependencies
None. 

# Prerequisites
None.

# Installing and activating
Once a new module is detected by the framework, a site administrator can go to the "Modules administration" page 
and first initialize the module, then enable it for all authorized users to have access.
  
# Configuration
If your instance of [LESK](https://github.com/sroutier/laravel-enterprise-starter-kit) is already configured to 
authenticate against an Active Directory server, the Active Directory Inspector module may work right out of 
the box without any configuration required. This can be achieved because the module reverts to using LESK 
configuration settings when its own are not specified.
 
Should you want to configure the module to inspect a different server, or in order to inspect a server without using 
AD/LDAP authentication with [LESK](https://github.com/sroutier/laravel-enterprise-starter-kit), here is a table 
listing the various configuration settings used, with their LESK equivalent:

| Module                                               | LESK                           | Default                         | Description                           |
|------------------------------------------------------|--------------------------------|---------------------------------|---------------------------------------|
| active_directory_inspector.account_suffix            | ldap.account_suffix            | @company.com                    | Account suffix, used to build user ID |
| active_directory_inspector.base_dn                   | ldap.base_dn                   | DC=department,DC=company,DC=com | Base DN to bind to                    |
| active_directory_inspector.server                    | ldap.server                    | ldapsrv01.company.com           | The fully qualified hostname for your AD domain controller. |
| active_directory_inspector.port                      | ldap.port                      | 389                             | The TCP port number to connect to your AD server. |
| active_directory_inspector.user_name                 | ldap.user_name                 | ldap_reader                     | The name of the user that will query the AD server. |
| active_directory_inspector.password                  | ldap.password                  | PaSsWoRd                        | The password of the user that will query the AD server. |
| active_directory_inspector.return_real_primary_group | ldap.return_real_primary_group | true                            | Fix Microsoft AD not following standards by not returning the real primary group, may incur extra processing. |
| active_directory_inspector.secured                   | ldap.secured                   | false                           | Enables the use of encryption to communicate with LDAP/AD using either SSL or TLS. (Supported values: false, "ssl", "tls") |
| active_directory_inspector.secured_port              | ldap.secured_port              | 636                             | The port number to use when using secured communications. |
| active_directory_inspector.recursive_groups          | ldap.recursive_groups          | false                           | Resolve group membership recursively. When disabled only groups that a given user is a direct member of will be returned. May incur extra processing. |
| active_directory_inspector.username_field            | ldap.username_field            | samaccountname                  | The name of the field that will contain the user name. |
| active_directory_inspector.email_field               | ldap.email_field               | userprincipalname               | The name of the field that will contain the user's email address. |
| active_directory_inspector.first_name_field          | ldap.first_name_field          | givenname                       | The name of the field that will contain the user's first name. |
| active_directory_inspector.last_name_field           | ldap.last_name_field           | sn                              | The name of the field that will contain the user's last name. |

