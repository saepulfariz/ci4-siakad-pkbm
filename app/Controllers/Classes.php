<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Classes extends BaseController
{
    private $model;
    private $model_teacher;
    private $model_education;
    private $link = 'classes';
    private $view = 'classes';
    private $title = 'Classes';
    public function __construct()
    {
        $this->model = new \App\Models\ClassModel();
        $this->model_teacher = new \App\Models\TeacherModel();
        $this->model_education = new \App\Models\EducationModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('classes.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'classes' => $this->model->select('classes.*, teachers.full_name as teacher_name, educations.name as education_name, classes_parent.name as class_parent')->join('teachers', 'teachers.id = classes.teacher_id', 'left')->join('educations', 'educations.id = classes.education_id', 'left')->join('classes as classes_parent', 'classes_parent.id = classes.parent_id', 'left')->orderBy('classes.id', 'desc')->findAll()
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
        $redirect = checkPermission('classes.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'teachers' => $this->model_teacher->findAll(),
            'classes' => $this->model->findAll(),
            'educations' => $this->model_education->findAll(),
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
        $redirect = checkPermission('classes.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $rules = [
            // 'parent_id' => 'required',
            'name' => 'required',
            'teacher_id' => 'required',
            'education_id' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();


        try {
            $data = [
                'parent_id' => htmlspecialchars($this->request->getVar('parent_id'), true),
                'name' => htmlspecialchars($this->request->getVar('name'), true),
                'teacher_id' => htmlspecialchars($this->request->getVar('teacher_id'), true),
                'education_id' => htmlspecialchars($this->request->getVar('education_id'), true),
            ];

            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to create class')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Class created successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to create Class')->withInput();
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
        $redirect = checkPermission('classes.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $class = $this->model->find($id);

        if (!$class) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'class' => $class,
            'teachers' => $this->model_teacher->findAll(),
            'classes' => $this->model->findAll(),
            'educations' => $this->model_education->findAll(),
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
        $redirect = checkPermission('classes.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $class = $this->model->find($id);

        if (!$class) {
            return redirect()->to($this->link);
        }

        $rules = [
            // 'parent_id' => 'required',
            'name' => 'required',
            'teacher_id' => 'required',
            'education_id' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }


        $this->db->transBegin();

        try {


            $data = [
                'parent_id' => htmlspecialchars($this->request->getVar('parent_id'), true),
                'name' => htmlspecialchars($this->request->getVar('name'), true),
                'teacher_id' => htmlspecialchars($this->request->getVar('teacher_id'), true),
                'education_id' => htmlspecialchars($this->request->getVar('education_id'), true),
            ];


            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to update Class')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Class updated successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to update Class ')->withInput();
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
        $redirect = checkPermission('classes.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $class = $this->model->find($id);

        if (!$class) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to delete class')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Class deleted successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to delete class')->withInput();
        }
    }
}
