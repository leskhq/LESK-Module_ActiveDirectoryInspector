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
| ACTIVE_DIRECTORY_INSPECTOR.ACCOUNT_SUFFIX            | LDAP.ACCOUNT_SUFFIX            | @company.com                    | Account suffix, used to build user ID |
| ACTIVE_DIRECTORY_INSPECTOR.BASE_DN                   | LDAP.BASE_DN                   | DC=department,DC=company,DC=com | Base DN to bind to                    |
| ACTIVE_DIRECTORY_INSPECTOR.SERVER                    | LDAP.SERVER                    | ldapsrv01.company.com           | The fully qualified hostname for your AD domain controller. |
| ACTIVE_DIRECTORY_INSPECTOR.PORT                      | LDAP.PORT                      | 389                             | The TCP port number to connect to your AD server. |
| ACTIVE_DIRECTORY_INSPECTOR.USER_NAME                 | LDAP.USER_NAME                 | ldap_reader                     | The name of the user that will query the AD server. |
| ACTIVE_DIRECTORY_INSPECTOR.PASSWORD                  | LDAP.PASSWORD                  | PaSsWoRd                        | The password of the user that will query the AD server. |
| ACTIVE_DIRECTORY_INSPECTOR.RETURN_REAL_PRIMARY_GROUP | LDAP.RETURN_REAL_PRIMARY_GROUP | true                            | Fix Microsoft AD not following standards by not returning the real primary group, may incur extra processing. |
| ACTIVE_DIRECTORY_INSPECTOR.SECURED                   | LDAP.SECURED                   | false                           | Enables the use of encryption to communicate with LDAP/AD using either SSL or TLS. (Supported values: false, "ssl", "tls") |
| ACTIVE_DIRECTORY_INSPECTOR.SECURED_PORT              | LDAP.SECURED_PORT              | 636                             | The port number to use when using secured communications. |
| ACTIVE_DIRECTORY_INSPECTOR.RECURSIVE_GROUPS          | LDAP.RECURSIVE_GROUPS          | false                           | Resolve group membership recursively. When disabled only groups that a given user is a direct member of will be returned. May incur extra processing. |
| ACTIVE_DIRECTORY_INSPECTOR.USERNAME_FIELD            | LDAP.USERNAME_FIELD            | samaccountname                  | The name of the field that will contain the user name. |
| ACTIVE_DIRECTORY_INSPECTOR.EMAIL_FIELD               | LDAP.EMAIL_FIELD               | userprincipalname               | The name of the field that will contain the user's email address. |
| ACTIVE_DIRECTORY_INSPECTOR.FIRST_NAME_FIELD          | LDAP.FIRST_NAME_FIELD          | givenname                       | The name of the field that will contain the user's first name. |
| ACTIVE_DIRECTORY_INSPECTOR.LAST_NAME_FIELD           | LDAP.LAST_NAME_FIELD           | sn                              | The name of the field that will contain the user's last name. |

