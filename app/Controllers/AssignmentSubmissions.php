<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AssignmentSubmissions extends BaseController
{
    private $model;
    private $model_assignment;
    private $model_student;
    private $link = 'assignment-submissions';
    private $view = 'assignment-submissions';
    private $title = 'Assignment Submissions';
    public function __construct()
    {
        $this->model = new \App\Models\AssignmentSubmissionModel();
        $this->model_assignment = new \App\Models\AssignmentModel();
        $this->model_student = new \App\Models\StudentModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('assignment-submissions.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $assignment_submissions = $this->model->select('assignment_submissions.*, assignments.title as assignment_title, students.full_name as student_name')->join('assignments', 'assignments.id = assignment_submissions.assignment_id', 'left')->join('students', 'students.id = assignment_submissions.student_id', 'left')->orderBy('assignment_submissions.id', 'desc');

        if (!auth()->user()->can('assignment-submissions.access-all')) {
            $check_student = auth()->user()->inGroup('student');
            $check_teacher = auth()->user()->inGroup('teacher');

            if ($check_teacher) {
                $assignment_submissions->join('teachers', 'teachers.id  = assignments.teacher_id')->where('teachers.user_id', auth()->id());
            }

            if ($check_student) {
                $assignment_submissions->where('students.user_id', auth()->id());
            }
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'assignment_submissions' => $assignment_submissions->findAll()
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
        $redirect = checkPermission('assignment-submissions.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $students = $this->model_student;
        $assignments = $this->model_assignment->select('assignments.*')->join('assignment_submissions', 'assignment_submissions.assignment_id = assignments.id', 'left')->where('assignment_submissions.id IS NULL');

        if (!auth()->user()->can('assignment-submissions.access-all')) {

            $check_student = auth()->user()->inGroup('student');
            $check_teacher = auth()->user()->inGroup('teacher');

            if ($check_teacher) {
                $assignments->join('teachers', 'teachers.id  = assignments.teacher_id')->where('teachers.user_id', auth()->id());
            }

            if ($check_student) {
                $students->where('students.user_id', auth()->id());
                $assignments->join('student_classes', 'student_classes.class_id = assignments.class_id')->join('students', 'students.id = student_classes.student_id')->where('students.user_id', auth()->id());
            }
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'students' => $students->findAll(),
            'assignments' => $assignments->findAll(),
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
        $redirect = checkPermission('assignment-submissions.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $rules = [
            'assignment_id' => 'required',
            'student_id' => 'required',
            // 'status' => 'required',
            'description' => 'required',
            'file' => 'required',
            // 'score' => 'required'
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();

        try {
            $data = [
                'assignment_id' => $this->request->getVar('assignment_id', FILTER_SANITIZE_NUMBER_INT),
                'student_id' => $this->request->getVar('student_id', FILTER_SANITIZE_NUMBER_INT),
                // 'status' => $this->request->getVar('status', FILTER_SANITIZE_STRING),
                'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING),
                'file' => $this->request->getVar('file', FILTER_SANITIZE_STRING),
                'score' => $this->request->getVar('score', FILTER_SANITIZE_STRING),
                'feedback' => $this->request->getVar('feedback', FILTER_SANITIZE_STRING),
                'submitted_at' => date('Y-m-d H:i:s')
            ];


            $assignment = $this->model_assignment->find($data['assignment_id']);

            if (strtotime($data['submitted_at']) > strtotime($assignment->deadline)) {
                $data['status'] = 'Late';
            }

            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to create assignment submission')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Assignment Submission created successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to create assignment submission')->withInput();
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
        $redirect = checkPermission('assignment-submissions.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $assignment_submission = $this->model->select('assignment_submissions.*');

        if (!auth()->user()->can('assignment-submissions.access-all')) {
            $check_student = auth()->user()->inGroup('student');
            $check_teacher = auth()->user()->inGroup('teacher');

            if ($check_teacher) {
                $assignment_submission->join('assignments', 'assignments.id = assignment_submissions.assignment_id')->join('teachers', 'teachers.id = assignments.teacher_id')->where('teachers.user_id', auth()->id());
            }

            if ($check_student) {
                $assignment_submission->join('students', 'students.id = assignment_submissions.student_id')->where('students.user_id', auth()->id());
            }
        }

        $assignment_submission = $assignment_submission->find($id);

        $assignment = $this->model_assignment->find($assignment_submission->assignment_id);

        if (time() > strtotime($assignment->deadline)) {
            $check_student = auth()->user()->inGroup('student');

            if ($check_student) {
                return redirect()->back()->with('error', 'Time up dateline');
            }
        }

        if (!$assignment_submission) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $students = $this->model_student;
        $assignments = $this->model_assignment->select('assignments.*')->join('assignment_submissions', 'assignment_submissions.assignment_id = assignments.id', 'left');

        if (!auth()->user()->can('assignment-submissions.access-all')) {

            $check_student = auth()->user()->inGroup('student');
            $check_teacher = auth()->user()->inGroup('teacher');

            if ($check_teacher) {
                $assignments->join('teachers', 'teachers.id  = assignments.teacher_id')->where('teachers.user_id', auth()->id());
            }

            if ($check_student) {
                $students->where('students.user_id', auth()->id());
                $assignments->join('student_classes', 'student_classes.class_id = assignments.class_id')->join('students', 'students.id = student_classes.student_id')->where('students.user_id', auth()->id());
            }
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'status' => $this->model->status,
            'assignment_submission' => $assignment_submission,
            'students' => $students->findAll(),
            'assignments' => $assignments->findAll(),
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
        $redirect = checkPermission('assignment-submissions.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $assignment_submission = $this->model->select('assignment_submissions.*');

        if (!auth()->user()->can('assignment-submissions.access-all')) {
            $check_student = auth()->user()->inGroup('student');
            $check_teacher = auth()->user()->inGroup('teacher');

            if ($check_teacher) {
                $assignment_submission->join('assignments', 'assignments.id = assignment_submissions.assignment_id')->join('teachers', 'teachers.id = assignments.teacher_id')->where('teachers.user_id', auth()->id());
            }


            if ($check_student) {
                $assignment_submission->join('students', 'students.id = assignment_submissions.student_id')->where('students.user_id', auth()->id());
            }
        }


        $assignment_submission = $assignment_submission->find($id);

        $assignment = $this->model_assignment->find($assignment_submission->assignment_id);

        if (time() > strtotime($assignment->deadline)) {
            $check_student = auth()->user()->inGroup('student');

            if ($check_student) {
                return redirect()->back()->with('error', 'Time up dateline');
            }
        }

        if (!$assignment_submission) {
            return redirect()->to($this->link);
        }

        $rules = [
            'assignment_id' => 'required',
            'student_id' => 'required',
            'file' => 'required',
            'description' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }


        $this->db->transBegin();

        try {


            $data = [
                'assignment_id' => $this->request->getVar('assignment_id', FILTER_SANITIZE_NUMBER_INT),
                'student_id' => $this->request->getVar('student_id', FILTER_SANITIZE_NUMBER_INT),
                'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING),
                'file' => $this->request->getVar('file', FILTER_SANITIZE_STRING),
                'score' => $this->request->getVar('score', FILTER_SANITIZE_STRING),
                'feedback' => $this->request->getVar('feedback', FILTER_SANITIZE_STRING),
            ];

            if ($data['score'] || $data['feedback']) {
                $data['review_at'] = date('Y-m-d H:i:s');
                $data['review_id'] = auth()->id();
                $data['status'] = $this->request->getVar('status', FILTER_SANITIZE_STRING);
            }


            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to update assignment submission')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Assignment Submission updated successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to update assignment submission ')->withInput();
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
        $redirect = checkPermission('assignment-submissions.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $assignment_submission = $this->model->select('assignment_submissions.*');

        if (!auth()->user()->can('assignment-submissions.access-all')) {
            $check_student = auth()->user()->inGroup('student');
            $check_teacher = auth()->user()->inGroup('teacher');

            if ($check_teacher) {
                $assignment_submission->join('assignments', 'assignments.id = assignment_submissions.assignment_id')->join('teachers', 'teachers.id = assignments.teacher_id')->where('teachers.user_id', auth()->id());
            }


            if ($check_student) {
                $assignment_submission->join('students', 'students.id = assignment_submissions.student_id')->where('students.user_id', auth()->id());
            }
        }


        $assignment_submission = $assignment_submission->find($id);

        if (!$assignment_submission) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', 'Failed to delete assignment submission')->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', 'Assignment Submission deleted successfully.')->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', 'Failed to delete assignment submission')->withInput();
        }
    }
}
