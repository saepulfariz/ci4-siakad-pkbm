<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Assignments extends BaseController
{
    private $model;
    private $model_class;
    private $model_subject;
    private $model_teacher;
    private $link = 'assignments';
    private $view = 'assignments';
    private $title = 'Assignments';
    public function __construct()
    {
        $this->model = new \App\Models\AssignmentModel();
        $this->model_class = new \App\Models\ClassModel();
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
        $redirect = checkPermission('assignments.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $assignments = $this->model->select('assignments.*, classes.name as class_name, subjects.name as subject_name, teachers.full_name as teacher_name')->join('subjects', 'subjects.id = assignments.subject_id', 'left')->join('classes', 'classes.id = assignments.class_id', 'left')->join('teachers', 'teachers.id = assignments.teacher_id', 'left')->orderBy('assignments.id', 'desc');

        if (!auth()->user()->can('assignments.access-all')) {
            $check_student = auth()->user()->inGroup('student');
            $check_teacher = auth()->user()->inGroup('teacher');

            if ($check_teacher) {
                $assignments->where('teachers.user_id', auth()->id());
            }

            if ($check_student) {
                $assignments->join('student_classes', 'student_classes.class_id = assignments.class_id')->join('students', 'students.id = student_classes.student_id')->where('students.user_id', auth()->id());
            }
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'assignments' => $assignments->findAll()
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
        $redirect = checkPermission('assignments.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $teachers = $this->model_teacher;
        $subjects = $this->model_subject;

        if (!auth()->user()->can('materials.access-all')) {
            $teachers = $this->model_teacher->where('user_id', auth()->id());
            $subjects =  $this->model_subject->join('teacher_subjects', 'teacher_subjects.subject_id = subjects.id')->join('teachers', 'teachers.id = teacher_subjects.teacher_id')->where('teachers.user_id', auth()->id());
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'teachers' => $teachers->findAll(),
            'classes' => $this->model_class->findAll(),
            'subjects' => $subjects->findAll(),
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
        $redirect = checkPermission('assignments.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $rules = [
            'class_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required'
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();

        try {
            $subject = $this->request->getVar('subject_id', FILTER_SANITIZE_NUMBER_INT);
            $data = [
                'class_id' => $this->request->getVar('class_id', FILTER_SANITIZE_NUMBER_INT),
                'subject_id' => $subject,
                'teacher_id' => $this->request->getVar('teacher_id', FILTER_SANITIZE_NUMBER_INT),
                'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING),
                'file' => $this->request->getVar('file', FILTER_SANITIZE_STRING),
                'deadline' => $this->request->getVar('deadline', FILTER_SANITIZE_STRING),
            ];

            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to create assignment')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Assignment created successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to create assignment')->withInput();
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
        $redirect = checkPermission('assignments.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $assignment = $this->model;
        $teachers = $this->model_teacher;
        $subjects = $this->model_subject;

        if (!auth()->user()->can('assignments.access-all')) {
            $teachers = $this->model_teacher->where('user_id', auth()->id());
            $subjects =  $this->model_subject->join('teacher_subjects', 'teacher_subjects.subject_id = subjects.id')->join('teachers', 'teachers.id = teacher_subjects.teacher_id')->where('teachers.user_id', auth()->id())->findAll();
            $assignment = $assignment->join('teachers', 'teachers.id = assignments.teacher_id')->where('teachers.user_id', auth()->id());
        }

        $assignment = $assignment->find($id);

        if (!$assignment) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'assignment' => $assignment,
            'teachers' => $teachers->findAll(),
            'classes' => $this->model_class->findAll(),
            'subjects' => $subjects->findAll(),
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
        $redirect = checkPermission('assignments.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $assignment = $this->model;

        if (!auth()->user()->can('assignments.access-all')) {
            $assignment = $assignment->join('teachers', 'teachers.id = assignments.teacher_id')->where('teachers.user_id', auth()->id());
        }

        $assignment = $assignment->find($id);

        if (!$assignment) {
            return redirect()->to($this->link);
        }

        $rules = [
            'class_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'title' => 'required',
            'description' => 'required',
            'deadline' => 'required'
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
                'teacher_id' => $this->request->getVar('teacher_id', FILTER_SANITIZE_NUMBER_INT),
                'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING),
                'file' => $this->request->getVar('file', FILTER_SANITIZE_STRING),
                'deadline' => $this->request->getVar('deadline', FILTER_SANITIZE_STRING),
            ];


            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to update assignment')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Assignment updated successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to update assignment ')->withInput();
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
        $redirect = checkPermission('assignments.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $assignment = $this->model;

        if (!auth()->user()->can('assignments.access-all')) {
            $assignment = $assignment->join('teachers', 'teachers.id = assignments.teacher_id')->where('teachers.user_id', auth()->id());
        }

        $assignment = $assignment->find($id);

        if (!$assignment) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to delete assignment')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Assignment deleted successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to delete assignment')->withInput();
        }
    }
}
