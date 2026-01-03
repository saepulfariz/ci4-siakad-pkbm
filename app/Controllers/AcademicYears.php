<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AcademicYears extends BaseController
{
    private $model;
    private $link = 'academic-years';
    private $view = 'academic-years';
    private $title = 'Academic Years';
    public function __construct()
    {
        $this->title = temp_lang('academic_years.academic_years');
        $this->model = new \App\Models\AcademicYearModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('academic-years.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'academic_years' => $this->model->orderBy('id', 'desc')->findAll()
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
        return redirect()->to($this->link);
    }

    /**
     * Return a new resource object, with default properties.
     *
     * @return ResponseInterface
     */
    public function new()
    {
        $redirect = checkPermission('academic-years.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
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
        $redirect = checkPermission('academic-years.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $rules = [
            'name' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();


        try {
            $data = [
                'name' => $this->request->getVar('name', FILTER_SANITIZE_STRING),
                'start_year' => $this->request->getVar('start_year', FILTER_SANITIZE_STRING),
                'end_year' => $this->request->getVar('end_year', FILTER_SANITIZE_STRING),
                'is_active' => 0,
            ];

            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('academic_years.create_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success',  temp_lang('academic_years.create_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('academic_years.create_error'))->withInput();
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
        $redirect = checkPermission('academic-years.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $academic_year = $this->model->find($id);

        if (!$academic_year) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'academic_year' => $academic_year,
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
        $redirect = checkPermission('academic-years.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $academic_year = $this->model->find($id);

        if (!$academic_year) {
            return redirect()->to($this->link);
        }

        $rules = [
            'name' => 'required',
            'start_year' => 'required',
            'end_year' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }


        $this->db->transBegin();

        try {


            $data = [
                'name' => $this->request->getVar('name', FILTER_SANITIZE_STRING),
                'start_year' => $this->request->getVar('start_year', FILTER_SANITIZE_STRING),
                'end_year' => $this->request->getVar('end_year', FILTER_SANITIZE_STRING),
            ];


            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error',  temp_lang('academic_years.update_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('academic_years.update_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('academic_years.update_error'))->withInput();
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
        $redirect = checkPermission('academic-years.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $academic_year = $this->model->find($id);

        if (!$academic_year) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('academic_years.delete_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('academic_years.delete_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('academic_years.delete_error'))->withInput();
        }
    }


    function activate($id = null)
    {
        $redirect = checkPermission('academic-years.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $academic_year = $this->model->find($id);

        if (!$academic_year) {
            return redirect()->to($this->link);
        }

        $this->model->update($id, ['is_active' => 1]);

        $cache = \Config\Services::cache();
        $cache->delete($this->model->cacheKey);

        return redirect()->with('success', temp_lang('academic_years.activate_success'))->to($this->link);
    }

    function deactivate($id = null)
    {
        $redirect = checkPermission('academic-years.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $academic_year = $this->model->find($id);

        if (!$academic_year) {
            return redirect()->to($this->link);
        }

        $this->model->update($id, ['is_active' => 0]);

        $cache = \Config\Services::cache();
        $cache->delete($this->model->cacheKey);

        return redirect()->with('success', temp_lang('academic_years.deactivate_success'))->to($this->link);
    }
}
