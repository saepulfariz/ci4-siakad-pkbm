<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ReportLogins extends BaseController
{
    private $link = 'report-logins';
    private $view = 'report-logins';
    private $title = 'Report Logins';
    public function __construct()
    {
        $this->title = temp_lang('report_logins.report_login');
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('report-logins.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $logins = $this->db->table('auth_logins')->select(' auth_logins.*, auth_groups_users.group, auth_identities.name')->join('auth_groups_users', 'auth_groups_users.user_id = auth_logins.user_id')->join('auth_identities', 'auth_identities.user_id = auth_logins.user_id')->orderBy('auth_logins.date', 'DESC')->get()->getResult();

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'report_logins' => $logins
        ];

        return view($this->view . '/index', $data);
    }
}
