<?php
namespace App\Modules\ActiveDirectoryInspector\Http\Controllers;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Repositories\AuditRepository as Audit;
use Auth;
use Adldap\Adldap;
use Illuminate\Support\Facades\Log;
use Flash;
use App\Modules\ActiveDirectoryInspector\Utils\Utility;
use Illuminate\Contracts\Foundation\Application;

class ActiveDirectoryInspectorController extends Controller
{

    /**
     * The application instance.
     *
     * @var \Illuminate\Contracts\Foundation\Application
     */
    protected $app;

    /**
     * Shortcut to the config section.
     *
     * @var Array
     */

    protected $ldapConfig;

    /**
     * The connection options for LDAP.
     *
     * @var Array
     */

    protected $ldapConOp;

    /**
     * Costom constructor to get a handle on the Application instance.
     * @param Application $app
     */
    public function __construct(Application $app)
    {
        $this->app = $app;
        $this->ldapConfig = $this->app['config']['activedirectoryinspector'];
    }

    public function home()
    {
        Audit::log(Auth::user()->id, trans('activedirectoryinspector::general.audit-log.category'), trans('activedirectoryinspector::general.audit-log.msg-home'));

        $page_title = trans('activedirectoryinspector::general.page.home.title');
        $page_description = trans('activedirectoryinspector::general.page.home.description');

        //Blank query to start.
        $query = '';

        return view('activedirectoryinspector::home', compact('page_title', 'page_description', 'query'));
    }

    public function search(Request $request)
    {
        $adldap = false;
        $adResults = false;

        $page_title = trans('activedirectoryinspector::general.page.home.title');
        $page_description = trans('activedirectoryinspector::general.page.home.description');

        $query = $request->input('txtADQuery');

        Audit::log(Auth::user()->id, trans('activedirectoryinspector::general.audit-log.category'), trans('activedirectoryinspector::general.audit-log.msg-search', ['query' => $query]));


        try {
            // Get connection info.
            $ldapConOp = $this->GetLDAPConnectionOptions();

            // Construct new Adldap instance.
            $adldap = new Adldap($ldapConOp);

            $adResults = $adldap->search()->select(['cn', 'dn', 'samaccountname', 'objectclass', 'objectcategory'])->where('cn', 'contains', $query)->get();

            if (!$adResults) {
                Utility::handleLDAPError($adResults);
            }
            else {
                foreach($adResults as $adResult) {
                    $tmpResult['cn']=$adResult['cn'][0];
                    $tmpResult['samaccountname']=$adResult['samaccountname'][0];
                    $tmpResult['dn']=$adResult['dn'];

                    switch (Utility::getADObjectType($adResult)) {
                        case "Group":
                            $tmpResult['type-icon'] = 'users';
                            $tmpResult['type-label'] = 'Group';
                            break;
                        case "User":
                            $tmpResult['type-icon'] = 'user';
                            $tmpResult['type-label'] = 'User';
                            break;
                        case "Zone":
                            $tmpResult['type-icon'] = 'sitemap';
                            $tmpResult['type-label'] = 'Zone';
                            break;
                        case "Computer":
                            $tmpResult['type-icon'] = 'desktop';
                            $tmpResult['type-label'] = 'Computer';
                            break;
                        default:
                            $tmpResult['type-icon'] = 'question';
                            $tmpResult['type-label'] = 'Unknown';
                    }

                    $tmpResults[] = $tmpResult;
                }

                $adResults = $tmpResults;
            }

        } catch (\Exception $ex) {
            Log::error('Exception retrieving user information: ' . $ex->getMessage());
            Log::error($ex->getTraceAsString());
            Flash::warning(trans('activedirectoryinspector::general.status.no-records-found'));
        }

        // Close connection.
        if (isset($adldap)) {
            unset($adldap);
        }

        session(['crumbtrail.leaf' => 'activedirectoryinspector.home']);
        return view('activedirectoryinspector::home', compact('page_title', 'page_description', 'adResults', 'query'));

    }

    public function show($dn)
    {
        $adldap    = false;
        $adRecord  = false;
        $arrRecord = [];
        $arrMembers = [];
        $arrMemberOf = [];

        Audit::log(Auth::user()->id, trans('activedirectoryinspector::general.audit-log.category'), trans('activedirectoryinspector::general.audit-log.msg-show', ['dn' => $dn]));

        try {
            // Get connection info.
            $ldapConOp = $this->GetLDAPConnectionOptions();

            // Construct new Adldap instance.
            $adldap = new Adldap($ldapConOp);

            $adRecord = $adldap->search()->findByDn($dn);

            if (!$adRecord) {
                Utility::handleLDAPError($adRecord);
            }
            else {
                switch (Utility::getADObjectType($adRecord)) {
                    case "Group":
                        $groupName        = $adRecord['samaccountname'][0];
                        $viewName         = "activedirectoryinspector::show-group";
                        $page_title       = trans('activedirectoryinspector::general.page.show-group.title');
                        $page_description = trans('activedirectoryinspector::general.page.show-group.description', ['groupName' => $groupName]);
                        break;
                    case "User":
                        $userName         = $adRecord['samaccountname'][0];
                        $viewName         = "activedirectoryinspector::show-user";
                        $page_title       = trans('activedirectoryinspector::general.page.show-user.title');
                        $page_description = trans('activedirectoryinspector::general.page.show-user.description', ['userName' => $userName]);
                        break;
                    case "Zone":
                    default:
                        $viewName         = "activedirectoryinspector::show-misc";
                        $page_title       = trans('activedirectoryinspector::general.page.show-misc.title');
                        $page_description = trans('activedirectoryinspector::general.page.show-misc.description');
                        break;
                }

                for ($iCnt=0; ($adKey=$adRecord[$iCnt])!==null; $iCnt++) {
                    $adVal = $adRecord[$adKey];
                    if (is_array($adVal)) {
                        foreach($adVal as $arrKey => $arrVal) {
                            $arrRecord[$adKey."_".$arrKey] = $arrVal;
                            if ( ("member" == $adKey) && ("count" !== $arrKey) ) {
                                $arrMembers[] = $arrVal;
                            }
                            if ( ("memberof" == $adKey) && ("count" !== $arrKey) ) {
                                $arrMemberOf[] = $arrVal;
                            }
                        }
                    }
                    else {
                        $arrRecord[$adKey] = $adVal;
                    }
                }

            }

        } catch (\Exception $ex) {
            Log::error('Exception retrieving user information: ' . $ex->getMessage());
            Log::error($ex->getTraceAsString());
            Flash::warning(trans('activedirectoryinspector::general.status.error-retrieving-ad-record'));
        }

        // Close connection.
        if (isset($adldap)) {
            unset($adldap);
        }

        ksort($arrRecord);
        asort($arrMembers);
        asort($arrMemberOf);
        session(['crumbtrail.leaf' => 'activedirectoryinspector.home']);
        return view($viewName, compact('page_title', 'page_description', 'adRecord', 'arrRecord', 'arrMembers', 'arrMemberOf'));
    }


    ///// UTILS
    /**
     * Returns cached AD/LDAP connection options or build them from the Utility class.
     *
     * @return array
     */
    private function GetLDAPConnectionOptions()
    {

        if (!isset($this->ldapConOp) || is_null($this->ldapConOp)) {
            // Call Utility class function to get AD/LDAP connection info.
            $this->ldapConOp = Utility::GetLDAPConnectionOptions($this->ldapConfig);
        }

        return $this->ldapConOp;

    }



}
