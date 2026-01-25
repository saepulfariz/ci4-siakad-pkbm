<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class AssignmentSubmissions extends BaseController
{
    private $model;
    private $model_assignment;
    private $model_student;

    protected $uploadPath;

    private $link = 'assignment-submissions';
    private $view = 'assignment-submissions';
    private $title = 'Assignment Submissions';
    public function __construct()
    {
        $this->title = temp_lang('assignment_submissions.assignment_submissions');

        $this->model = new \App\Models\AssignmentSubmissionModel();
        $this->model_assignment = new \App\Models\AssignmentModel();
        $this->model_student = new \App\Models\StudentModel();

        $this->uploadPath = WRITEPATH . 'uploads/assignment_submissions/';

        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0775, true);
        }
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
            // 'score' => 'required'
            'file_upload' => [
                'rules' => [
                    // 'uploaded[file_upload]',
                    'max_size[file_upload,5120]',
                    'ext_in[file_upload,pdf,doc,docx,ppt,pptx,jpg,jpeg,png]',
                    'mime_in[file_upload,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpg,image/jpeg,image/png]'
                ]
            ],
            'file_link' => 'permit_empty|valid_url'
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }


        $fileUpload = $this->request->getFile('file_upload');
        $fileLink   = $this->request->getPost('file_link', FILTER_SANITIZE_URL);

        if ($fileUpload && $fileUpload->isValid()) {

            $allowedMime = [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'image/jpeg',
                'image/png'
            ];

            if (!in_array($fileUpload->getMimeType(), $allowedMime)) {
                return redirect()->back()->withInput()->with('error', 'Tipe file tidak diizinkan');
            }
        }

        $this->db->transBegin();

        try {
            $data = [
                'assignment_id' => $this->request->getVar('assignment_id', FILTER_SANITIZE_NUMBER_INT),
                'student_id' => $this->request->getVar('student_id', FILTER_SANITIZE_NUMBER_INT),
                // 'status' => $this->request->getVar('status', FILTER_SANITIZE_STRING),
                'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING),
                // 'file' => $this->request->getVar('file', FILTER_SANITIZE_STRING),
                'score' => $this->request->getVar('score', FILTER_SANITIZE_STRING),
                'feedback' => $this->request->getVar('feedback', FILTER_SANITIZE_STRING),
                'submitted_at' => date('Y-m-d H:i:s')
            ];

            if ($fileUpload && $fileUpload->isValid()) {

                $nameFile = $fileUpload->getRandomName();
                $fileUpload->move($this->uploadPath, $nameFile);
                $data['file'] = $nameFile;
            } else {
                $data['file'] = $fileLink;
            }


            $assignment = $this->model_assignment->find($data['assignment_id']);

            if (strtotime($data['submitted_at']) > strtotime($assignment->deadline)) {
                $data['status'] = 'Late';
            }

            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('assignment_submissions.create_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success',  temp_lang('assignment_submissions.create_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('assignment_submissions.create_error'))->withInput();
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
            // 'file' => 'required',
            'description' => 'required',
            'file_upload' => [
                'rules' => [
                    'if_exist',
                    'max_size[file_upload,5120]',
                    'ext_in[file_upload,pdf,doc,docx,ppt,pptx,jpg,jpeg,png]',
                    'mime_in[file_upload,application/pdf,application/msword,application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/vnd.ms-powerpoint,application/vnd.openxmlformats-officedocument.presentationml.presentation,image/jpg,image/jpeg,image/png]'
                ]
            ],
            'file_link' => 'permit_empty|valid_url'
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $fileUpload = $this->request->getFile('file_upload');
        $fileLink   = $this->request->getPost('file_link', FILTER_SANITIZE_URL);

        if ($fileUpload && $fileUpload->isValid()) {

            $allowedMime = [
                'application/pdf',
                'application/msword',
                'application/vnd.openxmlformats-officedocument.wordprocessingml.document',
                'application/vnd.ms-powerpoint',
                'application/vnd.openxmlformats-officedocument.presentationml.presentation',
                'image/jpeg',
                'image/png'
            ];

            if (!in_array($fileUpload->getMimeType(), $allowedMime)) {
                return redirect()->back()->withInput()->with('error', 'Tipe file tidak diizinkan');
            }
        }

        $this->db->transBegin();

        try {


            $data = [
                'assignment_id' => $this->request->getVar('assignment_id', FILTER_SANITIZE_NUMBER_INT),
                'student_id' => $this->request->getVar('student_id', FILTER_SANITIZE_NUMBER_INT),
                'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING),
                // 'file' => $this->request->getVar('file', FILTER_SANITIZE_STRING),
                'score' => $this->request->getVar('score', FILTER_SANITIZE_STRING),
                'feedback' => $this->request->getVar('feedback', FILTER_SANITIZE_STRING),
            ];

            if ($data['score'] || $data['feedback']) {
                $data['review_at'] = date('Y-m-d H:i:s');
                $data['review_id'] = auth()->id();
                $data['status'] = $this->request->getVar('status', FILTER_SANITIZE_STRING);
            }

            // jika upload file baru
            if ($fileUpload && $fileUpload->isValid() && !$fileUpload->hasMoved()) {

                // hapus file lama jika bukan link
                if ($assignment->file && !filter_var($assignment->file, FILTER_VALIDATE_URL)) {
                    @unlink($this->uploadPath . $assignment->file);
                }

                $nameFile = $fileUpload->getRandomName();
                $fileUpload->move($this->uploadPath, $nameFile);
                $data['file'] = $nameFile;
            }
            // jika pakai link
            elseif (!empty($fileLink)) {
                $data['file'] = $fileLink;
            }

            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error',  temp_lang('assignment_submissions.update_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('assignment_submissions.update_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('assignment_submissions.update_error'))->withInput();
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

            if ($assignment_submission && $assignment_submission->file && !filter_var($assignment_submission->file, FILTER_VALIDATE_URL)) {
                @unlink($this->uploadPath . $assignment_submission->file);
            }


            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('assignment_submissions.delete_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('assignment_submissions.delete_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('assignment_submissions.delete_error'))->withInput();
        }
    }
}
