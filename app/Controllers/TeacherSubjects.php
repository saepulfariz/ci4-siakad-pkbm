<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class TeacherSubjects extends BaseController
{
    private $model;
    private $model_subject;
    private $model_teacher;
    private $link = 'teacher-subjects';
    private $view = 'teacher-subjects';
    private $title = 'Teacher Subjects';
    public function __construct()
    {
        $this->model = new \App\Models\TeacherSubjectModel();
        $this->model_subject = new \App\Models\SubjectModel();
        $this->model_teacher = new \App\Models\TeacherModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('teacher-subjects.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'teacher_subjects' => $this->model->select('teacher_subjects.*, subjects.name as subject_name, teachers.full_name as teacher_name')->join('teachers', 'teachers.id = teacher_subjects.teacher_id', 'left')->join('subjects', 'subjects.id = teacher_subjects.subject_id', 'left')->orderBy('teacher_subjects.id', 'desc')->findAll()
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
        $redirect = checkPermission('teacher-subjects.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'subjects' => $this->model_subject->findAll(),
            'teachers' => $this->model_teacher->findAll(),
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
        $redirect = checkPermission('teacher-subjects.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $rules = [
            'subject_id' => 'required',
            'teacher_id' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();


        try {
            $data = [
                'subject_id' => htmlspecialchars($this->request->getVar('subject_id'), true),
                'teacher_id' => htmlspecialchars($this->request->getVar('teacher_id'), true),
            ];

            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to create Teacher subject')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Teacher subject created successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to create Teacher subject')->withInput();
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
        $redirect = checkPermission('teacher-subjects.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $teacher_subject = $this->model->find($id);

        if (!$teacher_subject) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'teacher_subject' => $teacher_subject,
            'subjects' => $this->model_subject->findAll(),
            'teachers' => $this->model_teacher->findAll(),
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
        $redirect = checkPermission('teacher-subjects.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $teacher_subject = $this->model->find($id);

        if (!$teacher_subject) {
            return redirect()->to($this->link);
        }

        $rules = [
            'subject_id' => 'required',
            'teacher_id' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }


        $this->db->transBegin();

        try {


            $data = [
                'subject_id' => htmlspecialchars($this->request->getVar('subject_id'), true),
                'teacher_id' => htmlspecialchars($this->request->getVar('teacher_id'), true),
            ];


            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to update Teacher subject')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Teacher subject updated successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to update Teacher subject ')->withInput();
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
        $redirect = checkPermission('teacher-subjects.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $teacher_subject = $this->model->find($id);

        if (!$teacher_subject) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to delete Teacher subject')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Teacher subject deleted successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to delete Teacher subject')->withInput();
        }
    }
}
