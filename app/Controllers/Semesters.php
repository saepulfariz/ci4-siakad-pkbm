<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Semesters extends BaseController
{
    private $model;
    private $model_academic;
    private $link = 'semesters';
    private $view = 'semesters';
    private $title = 'Semesters';
    public function __construct()
    {
        $this->model = new \App\Models\SemesterModel();
        $this->model_academic = new \App\Models\AcademicYearModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('semesters.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'semesters' => $this->model->select('semesters.*, academic_years.name as academic_name')->join('academic_years', 'academic_years.id = semesters.academic_year_id')->orderBy('semesters.id', 'desc')->findAll()
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
        $redirect = checkPermission('semesters.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'academic_years' => $this->model_academic->findAll(),
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
        $redirect = checkPermission('semesters.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $rules = [
            'academic_year_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();


        try {
            $data = [
                'academic_year_id' => htmlspecialchars($this->request->getVar('academic_year_id'), true),
                'name' => htmlspecialchars($this->request->getVar('name'), true),
                'start_date' => htmlspecialchars($this->request->getVar('start_date'), true),
                'end_date' => htmlspecialchars($this->request->getVar('end_date'), true),
                'is_active' => 0,
            ];

            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to create semester')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Semester created successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to create Semester')->withInput();
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
        $redirect = checkPermission('semesters.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $semester = $this->model->find($id);

        if (!$semester) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'semester' => $semester,
            'academic_years' => $this->model_academic->findAll()
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
        $redirect = checkPermission('semesters.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $semester = $this->model->find($id);

        if (!$semester) {
            return redirect()->to($this->link);
        }

        $rules = [
            'academic_year_id' => 'required',
            'name' => 'required',
            'start_date' => 'required',
            'end_date' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }


        $this->db->transBegin();

        try {


            $data = [
                'academic_year_id' => htmlspecialchars($this->request->getVar('academic_year_id'), true),
                'name' => htmlspecialchars($this->request->getVar('name'), true),
                'start_date' => htmlspecialchars($this->request->getVar('start_date'), true),
                'end_date' => htmlspecialchars($this->request->getVar('end_date'), true),
            ];


            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to update Semester')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Semester updated successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to update Semester ')->withInput();
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
        $redirect = checkPermission('semesters.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $semester = $this->model->find($id);

        if (!$semester) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to delete semester')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Semester deleted successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to delete semester')->withInput();
        }
    }


    function activate($id = null)
    {
        $semester = $this->model->find($id);

        if (!$semester) {
            return redirect()->to($this->link);
        }

        $this->model->update($id, ['is_active' => 1]);

        $cache = \Config\Services::cache();
        $cache->delete($this->model->cacheKey);

        return redirect()->with('success', 'Semester activated successfully.')->to($this->link);
    }

    function deactivate($id = null)
    {
        $semester = $this->model->find($id);

        if (!$semester) {
            return redirect()->to($this->link);
        }

        $this->model->update($id, ['is_active' => 0]);

        $cache = \Config\Services::cache();
        $cache->delete($this->model->cacheKey);

        return redirect()->with('success', 'Semester deactivated successfully.')->to($this->link);
    }
}
