<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Notifications extends BaseController
{
    private $model;
    private $model_user;
    private $link = 'notifications';
    private $view = 'notifications';
    private $title = 'Notifications';
    public function __construct()
    {
        $this->title = temp_lang('notifications.notifications');

        $this->model = new \App\Models\NotificationModel();
        $this->model_user = auth()->getProvider();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('notifications.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $notifications = $this->model->select('notifications.*, users.username as user_name')->join('users', 'users.id = notifications.user_id', 'left')->orderBy('notifications.id', 'desc');

        if (!auth()->user()->can('notifications.access-all')) {
            $notifications = $notifications->where('user_id', auth()->id());
        }

        $cache = \Config\Services::cache();
        if (auth()->user()->can('notifications.access-all')) {
            $cacheKey = 'notifications';
        } else {
            $cacheKey = 'notifications_' . auth()->id();
        }
        if (!$cache->get($cacheKey)) {
            $notifications =  $notifications->findAll();
            $cache->save($cacheKey, $notifications, CACHE_TTL);
        } {
            $notifications = $cache->get($cacheKey);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'notifications' => $notifications
        ];

        return view($this->view . '/index', $data);
    }

    /**
     * Return the properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function show($id = null)
    {
        $redirect = checkPermission('notifications.show');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $notification = $this->model->find($id);

        if (!$notification) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        if (!auth()->user()->can('notifications.access-all')) {
            // return $redirect;
            if (auth()->id() != $notification->user_id) {
                return redirect()->with('error', 'Not access this data!')->to('dashboard');
            }
        }

        // update status
        $this->model->update($id, [
            'status' => 'Read',
        ]);

        $cache = \Config\Services::cache();
        $cache->delete($this->model->cacheKey);

        $cache->delete($this->model->cacheKey . '_' . auth()->id());

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'notification' => $notification,
        ];

        return view($this->view . '/show', $data);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $redirect = checkPermission('notifications.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'users' => $this->model_user->findAll(),
        ];

        return view($this->view . '/new', $data);
    }

    /**
     * Create a new resource object, from "posted" parameters.
     *
     * @return ResponseInterface
     */
    public function create()
    {
        $redirect = checkPermission('notifications.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $rules = [
            'user_id' => 'required',
            'title' => 'required',
            'message' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();

        try {

            $users = $this->request->getVar('user_id', FILTER_SANITIZE_NUMBER_INT);
            foreach ($users as $user_id) {
                $data = [
                    'user_id' => $user_id,
                    'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                    'message' => $this->request->getVar('message', FILTER_SANITIZE_STRING),
                ];

                $this->model->insert($data);

                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                    return redirect()->back()->with('error', temp_lang('notifications.create_error'))->withInput();
                }
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success',  temp_lang('notifications.create_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('notifications.create_error'))->withInput();
        }
    }


    /**
     * Return the editable properties of a resource object.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function edit($id = null)
    {
        $redirect = checkPermission('notifications.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $notification = $this->model->find($id);

        if (!$notification) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        if (!auth()->user()->can('notifications.access-all')) {
            // return $redirect;
            if (auth()->id() != $notification->user_id) {
                return redirect()->with('error', 'Not access this data!')->to($this->link);
            }
        }


        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'notification' => $notification,
            'users' => $this->model_user->findAll(),
        ];

        return view($this->view . '/edit', $data);
    }

    /**
     * Add or update a model resource, from "posted" properties.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function update($id = null)
    {
        $redirect = checkPermission('notifications.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $notification = $this->model->find($id);

        if (!$notification) {
            return redirect()->to($this->link);
        }


        if (!auth()->user()->can('notifications.access-all')) {
            // return $redirect;
            if (auth()->id() != $notification->user_id) {
                return redirect()->with('error', 'Not access this data!')->to($this->link);
            }
        }

        $rules = [
            'user_id' => 'required',
            'title' => 'required',
            'message' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }


        $this->db->transBegin();

        try {


            $data = [
                'user_id' => $this->request->getVar('user_id', FILTER_SANITIZE_NUMBER_INT),
                'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                'message' => $this->request->getVar('message', FILTER_SANITIZE_STRING),
            ];


            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error',  temp_lang('notifications.update_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('notifications.update_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('notifications.update_error'))->withInput();
        }
    }

    /**
     * Delete the designated resource object from the model.
     *
     * @param int|string|null $id
     *
     * @return ResponseInterface
     */
    public function delete($id = null)
    {
        $redirect = checkPermission('notifications.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $notification = $this->model->find($id);

        if (!$notification) {
            return redirect()->to($this->link);
        }

        if (!auth()->user()->can('notifications.access-all')) {
            // return $redirect;
            if (auth()->id() != $notification->user_id) {
                return redirect()->with('error', 'Not access this data!')->to($this->link);
            }
        }


        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('notifications.delete_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('notifications.delete_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('notifications.delete_error'))->withInput();
        }
    }
}
