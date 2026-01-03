<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class ClassSubjects extends BaseController
{
    private $model;
    private $model_class;
    private $model_subject;
    private $link = 'class-subjects';
    private $view = 'class-subjects';
    private $title = 'Class Subjects';
    public function __construct()
    {
        $this->model = new \App\Models\ClassSubjectModel;
        $this->model_class = new \App\Models\ClassModel();
        $this->model_subject = new \App\Models\SubjectModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('class-subjects.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'class_subjects' => $this->model->select('class_subjects.*, classes.name as class_name, subjects.name as subject_name')->join('subjects', 'subjects.id = class_subjects.subject_id', 'left')->join('classes', 'Classes.id = class_subjects.class_id', 'left')->orderBy('class_subjects.id', 'desc')->findAll()
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
        $redirect = checkPermission('class-subjects.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'classes' => $this->model_class->findAll(),
            'subjects' => $this->model_subject->findAll(),
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
        $redirect = checkPermission('class-subjects.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $rules = [
            'class_id' => 'required',
            'subject_id' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();

        try {
            $subjects = $this->request->getVar('subject_id', FILTER_SANITIZE_NUMBER_INT);
            foreach ($subjects as $subject) {
                $data = [
                    'class_id' => $this->request->getVar('class_id', FILTER_SANITIZE_NUMBER_INT),
                    'subject_id' => $subject,
                ];

                $this->model->insert($data);

                if ($this->db->transStatus() === false) {
                    $this->db->transRollback();
                    return redirect()->back()->with('error', 'Failed to create class subject')->withInput();
                }
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Class subject created successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to create class subject')->withInput();
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
        $redirect = checkPermission('class-subjects.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $class_subject = $this->model->find($id);

        if (!$class_subject) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'class_subject' => $class_subject,
            'classes' => $this->model_class->findAll(),
            'subjects' => $this->model_subject->findAll(),
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
        $redirect = checkPermission('class-subjects.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $class_subject = $this->model->find($id);

        if (!$class_subject) {
            return redirect()->to($this->link);
        }

        $rules = [
            'class_id' => 'required',
            'subject_id' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }


        $this->db->transBegin();

        try {


            $data = [
                'class_id' => $this->request->getVar('class_id', FILTER_SANITIZE_NUMBER_INT),
                'subject_id' => $this->request->getVar('subject_id', FILTER_SANITIZE_NUMBER_INT),
            ];


            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to update class subject')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Class subject updated successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to update class subject ')->withInput();
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
        $redirect = checkPermission('class-subjects.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $class_subject = $this->model->find($id);

        if (!$class_subject) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to delete class subject')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Class subject deleted successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to delete class subject')->withInput();
        }
    }
}
