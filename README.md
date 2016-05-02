# ActiveDirectoryInspector module

To deploy simply clone the repository from the ```Modules``` directory of the base [L51ESK](https://github.com/sroutier/laravel-5.1-enterprise-starter-kit) install, as shown below:
```
$ cd app/Modules/
$ git clone https://<git-repo-server>/<group>/<repository>.git ActiveDirectoryInspector
```

Then make sure to optimize the master module definition, from the base directory, with:
```
$ cd ../..
$ ./artisan module:optimize
```

Once a new module is detected by the framework, a site administrator can go to the "Modules administration" page and first
 initialize the module, then enable it for all authorized users to have access.
  
  
