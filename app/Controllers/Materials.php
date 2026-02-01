<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Materials extends BaseController
{
    private $model;
    private $model_class;
    private $model_subject;
    private $model_teacher;
    private $model_semester;

    protected $uploadPath;


    private $link = 'materials';
    private $view = 'materials';
    private $title = 'Materials';
    public function __construct()
    {
        $this->title = temp_lang('materials.materials');
        $this->model = new \App\Models\MaterialModel();
        $this->model_class = new \App\Models\ClassModel();
        $this->model_subject = new \App\Models\SubjectModel();
        $this->model_teacher = new \App\Models\TeacherModel();
        $this->model_semester = new \App\Models\SemesterModel();

        $this->uploadPath = WRITEPATH . 'uploads/materials/';

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
        $redirect = checkPermission('materials.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $materials = $this->model->select('materials.*, classes.name as class_name, subjects.name as subject_name, teachers.full_name as teacher_name')->join('subjects', 'subjects.id = materials.subject_id', 'left')->join('classes', 'classes.id = materials.class_id', 'left')->join('teachers', 'teachers.id = materials.teacher_id', 'left')->select('semesters.name as semester_name')->join('semesters', 'semesters.id = materials.semester_id')->select('academic_years.name as academic_year_name')->join('academic_years', 'academic_years.id = semesters.academic_year_id')->orderBy('materials.id', 'desc');

        if (!auth()->user()->can('materials.access-all')) {
            $check_student = auth()->user()->inGroup('student');
            $check_teacher = auth()->user()->inGroup('teacher');

            if ($check_teacher) {
                $materials->where('teachers.user_id', auth()->id());
            }

            if ($check_student) {
                $materials->join('student_classes', 'student_classes.class_id = materials.class_id')->join('students', 'students.id = student_classes.student_id')->where('students.user_id', auth()->id());
            }
        }


        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'materials' => $materials->findAll()
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
        $redirect = checkPermission('materials.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $teachers = $this->model_teacher;
        $subjects = $this->model_subject;

        if (!auth()->user()->can('materials.access-all')) {
            $teachers = $teachers->where('user_id', auth()->id());
            $subjects =  $subjects->join('teacher_subjects', 'teacher_subjects.subject_id = subjects.id')->join('teachers', 'teachers.id = teacher_subjects.teacher_id')->where('teachers.user_id', auth()->id());
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'teachers' => $teachers->findAll(),
            'classes' => $this->model_class->findAll(),
            'subjects' => $subjects->findAll(),
            'semesters' => $this->model_semester->select('semesters.*, academic_years.name as academic_year_name')->join('academic_years', 'academic_years.id = semesters.academic_year_id')->orderBy('semesters.id', 'DESC')->findAll(),
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
        $redirect = checkPermission('materials.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $rules = [
            'class_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'title' => 'required',
            'description' => 'required',
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
            $subject = $this->request->getVar('subject_id', FILTER_SANITIZE_NUMBER_INT);
            $data = [
                'class_id' => $this->request->getVar('class_id', FILTER_SANITIZE_NUMBER_INT),
                'subject_id' => $subject,
                'teacher_id' => $this->request->getVar('teacher_id', FILTER_SANITIZE_NUMBER_INT),
                'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING),
                // 'file' => $this->request->getVar('file', FILTER_SANITIZE_STRING),
            ];

            if (!auth()->user()->can('materials.access-all')) {
                $data['semester_id'] = $this->model_semester->where('is_active', 1)->first()->id ?? 1;
            } else {
                $data['semester_id'] = $this->request->getVar('semester_id', FILTER_SANITIZE_NUMBER_INT);
            }

            if ($fileUpload && $fileUpload->isValid()) {

                $nameFile = $fileUpload->getRandomName();
                $fileUpload->move($this->uploadPath, $nameFile);
                $data['file'] = $nameFile;
            } else {
                $data['file'] = $fileLink;
            }

            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('materials.create_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success',  temp_lang('materials.create_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('materials.create_error'))->withInput();
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
        $redirect = checkPermission('materials.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $material = $this->model;


        $teachers = $this->model_teacher;
        $subjects = $this->model_subject;

        if (!auth()->user()->can('materials.access-all')) {
            $teachers = $teachers->where('user_id', auth()->id());
            $subjects =  $subjects->join('teacher_subjects', 'teacher_subjects.subject_id = subjects.id')->join('teachers', 'teachers.id = teacher_subjects.teacher_id')->where('teachers.user_id', auth()->id());
            $material = $material->join('teachers', 'teachers.id = materials.teacher_id')->where('teachers.user_id', auth()->id());
        }

        $material = $material->find($id);

        if (!$material) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'material' => $material,
            'teachers' => $teachers->findAll(),
            'classes' => $this->model_class->findAll(),
            'subjects' => $subjects->findAll(),
            'semesters' => $this->model_semester->select('semesters.*, academic_years.name as academic_year_name')->join('academic_years', 'academic_years.id = semesters.academic_year_id')->orderBy('semesters.id', 'DESC')->findAll(),
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
        $redirect = checkPermission('materials.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $material = $this->model;

        if (!auth()->user()->can('materials.access-all')) {
            $material = $material->join('teachers', 'teachers.id = materials.teacher_id')->where('teachers.user_id', auth()->id());
        }

        $material = $material->find($id);

        if (!$material) {
            return redirect()->to($this->link);
        }

        $rules = [
            'class_id' => 'required',
            'subject_id' => 'required',
            'teacher_id' => 'required',
            'title' => 'required',
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
                'class_id' => $this->request->getVar('class_id', FILTER_SANITIZE_NUMBER_INT),
                'subject_id' => $this->request->getVar('subject_id', FILTER_SANITIZE_NUMBER_INT),
                'teacher_id' => $this->request->getVar('teacher_id', FILTER_SANITIZE_NUMBER_INT),
                'title' => $this->request->getVar('title', FILTER_SANITIZE_STRING),
                'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING),
                // 'file' => $this->request->getVar('file', FILTER_SANITIZE_STRING),
                'file' => $material->file, // default pakai file lama
            ];

            if (auth()->user()->can('materials.access-all')) {
                $data['semester_id'] = $this->request->getVar('semester_id', FILTER_SANITIZE_NUMBER_INT);
            }

            // jika upload file baru
            if ($fileUpload && $fileUpload->isValid() && !$fileUpload->hasMoved()) {

                // hapus file lama jika bukan link
                if ($material->file && !filter_var($material->file, FILTER_VALIDATE_URL)) {
                    @unlink($this->uploadPath . $material->file);
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
                return redirect()->back()->with('error',  temp_lang('materials.update_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('materials.update_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('materials.update_error'))->withInput();
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
        $redirect = checkPermission('materials.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $material = $this->model;

        if (!auth()->user()->can('materials.access-all')) {
            $material = $material->join('teachers', 'teachers.id = materials.teacher_id')->where('teachers.user_id', auth()->id());
        }

        $material = $material->find($id);

        if (!$material) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($material && $material->file && !filter_var($material->file, FILTER_VALIDATE_URL)) {
                @unlink($this->uploadPath . $material->file);
            }

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('materials.delete_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('materials.delete_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('materials.delete_error'))->withInput();
        }
    }
}
