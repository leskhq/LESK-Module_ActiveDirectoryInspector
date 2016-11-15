<?php namespace App\Modules\ActiveDirectoryInspector\Utils;

use Adldap\Adldap;
use Illuminate\Support\Facades\Log;
use Setting;

class Utility
{

    /**
     * Logs the last LDAP error if it is not "Success".
     *
     * @param array $adldap   The instance of the adLDAP object to check for
     *                        error.
     */
    public static function handleLDAPError($adldap)
    {
        if (false != $adldap) {
            // May be helpful for finding out what and why went wrong.
            $adLDAPError = $adldap->getConnection()->getLastError();
            if ("Success" != $adLDAPError) {
                Log::error('Problem with LDAP:' . $adLDAPError);
            }
        }
    }


    /**
     * Builds the LDAP connection options from the settings.
     *
     * @return array
     */
    public static function GetLDAPConnectionOptions()
    {

        $ldapConOp = null;

        // Build basic LDAP connection configuration.
        $ldapConOp = [
            "account_suffix"     => Setting::get('active_directory_inspector.account_suffix'),
            "base_dn"            => Setting::get('active_directory_inspector.base_dn'),
            "domain_controllers" => Setting::get('active_directory_inspector.server'),
            "admin_username"     => Setting::get('active_directory_inspector.user_name'),
            "admin_password"     => Setting::get('active_directory_inspector.password'),
            "real_primarygroup"  => Setting::get('active_directory_inspector.return_real_primary_group'),
            "recursive_groups"   => Setting::get('active_directory_inspector.recursive_groups'),
            "sso"                => false, // $ldapConfig['sso'], // NOT SUPPORTED HARD CODED TO FALSE.
            "follow_referrals"   => false, // $ldapConfig['follow_referrals'], // NOT SUPPORTED HARD CODED TO FALSE.
        ];
        // Create the communication option part, add the encryption and port info.
        if ('tls' === Setting::get('active_directory_inspector.secured')) {
            $comOpt = [
                "use_ssl" => false,
                "use_tls" => true,
                "ad_port" => Setting::get('active_directory_inspector.secured_port'), // TODO: Should this be secured_port or port?!?!
            ];
        } else if ('ssl' === Setting::get('active_directory_inspector.secured')) {
            $comOpt = [
                "use_ssl" => true,
                "use_tls" => false,
                "ad_port" => Setting::get('active_directory_inspector.secured_port'),
            ];
        } else {
            $comOpt = [
                "use_ssl" => false,
                "use_tls" => false,
                "ad_port" => Setting::get('active_directory_inspector.port'),
            ];
        }
        // Merge all options together.
        $ldapConOp = array_merge($ldapConOp, $comOpt);

        return $ldapConOp;

    }

    /**
     * Return the type of the passed in AD object as a string.
     *
     * @param $adResult
     * @return String
     */
    public static function getADObjectType($adResult)
    {
        $objectType = "Unknown";
        $objCat = $adResult['objectcategory'][0];

        switch ($objCat) {
            case (preg_match('/CN=Group,CN=Schema,CN=Configuration,DC=.*/', $objCat) ? true : false) :
                $objectType = 'Group';
                break;
            case (preg_match('/CN=Person,CN=Schema,CN=Configuration,DC=.*/', $objCat) ? true : false) :
                $objectType = 'User';
                break;
            case (preg_match('/CN=Dns-Zone,CN=Schema,CN=Configuration,DC=.*/', $objCat) ? true : false) :
                $objectType = 'Zone';
                break;
            case (preg_match('/CN=Computer,CN=Schema,CN=Configuration,DC=.*/', $objCat) ? true : false) :
                $objectType = 'Computer';
                break;
            default:
                $objectType = 'Unknown';
        }

        return $objectType;
    }

}
