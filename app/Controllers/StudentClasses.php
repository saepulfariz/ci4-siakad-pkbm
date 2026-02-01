<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class StudentClasses extends BaseController
{
    private $model;
    private $model_class;
    private $model_student;
    private $model_semester;
    private $link = 'student-classes';
    private $view = 'student-classes';
    private $title = 'Student Classes';
    public function __construct()
    {
        $this->title = temp_lang('student_classes.student_classes');

        $this->model = new \App\Models\StudentClassModel();
        $this->model_class = new \App\Models\ClassModel();
        $this->model_student = new \App\Models\StudentModel();
        $this->model_semester = new \App\Models\SemesterModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('student-classes.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'student_classes' => $this->model->select('student_classes.*, classes.name as class_name, students.full_name as student_name')->select('semesters.name as semester_name')->join('semesters', 'semesters.id = student_classes.semester_id')->join('students', 'students.id = student_classes.student_id', 'left')->join('classes', 'classes.id = student_classes.class_id', 'left')->select('academic_years.name as academic_year_name')->join('academic_years', 'academic_years.id  = semesters.academic_year_id')->orderBy('student_classes.id', 'desc')->findAll()
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
        $redirect = checkPermission('student-classes.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'classes' => $this->model_class->findAll(),
            'students' => $this->model_student->findAll(),
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
        $redirect = checkPermission('student-classes.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $rules = [
            'class_id' => 'required',
            'student_id' => 'required',
            'semester_id' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();


        try {
            $data = [
                'semester_id' => $this->request->getVar('semester_id', FILTER_SANITIZE_NUMBER_INT),
                'class_id' => $this->request->getVar('class_id', FILTER_SANITIZE_NUMBER_INT),
                'student_id' => $this->request->getVar('student_id', FILTER_SANITIZE_NUMBER_INT),
            ];

            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('student_classes.create_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success',  temp_lang('student_classes.create_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('student_classes.create_error'))->withInput();
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
        $redirect = checkPermission('student-classes.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $student_class = $this->model->find($id);

        if (!$student_class) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'student_class' => $student_class,
            'classes' => $this->model_class->findAll(),
            'students' => $this->model_student->findAll(),
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
        $redirect = checkPermission('student-classes.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $student_class = $this->model->find($id);

        if (!$student_class) {
            return redirect()->to($this->link);
        }

        $rules = [
            'class_id' => 'required',
            'student_id' => 'required',
            'semester_id' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }


        $this->db->transBegin();

        try {


            $data = [
                'semester_id' => $this->request->getVar('semester_id', FILTER_SANITIZE_NUMBER_INT),
                'class_id' => $this->request->getVar('class_id', FILTER_SANITIZE_NUMBER_INT),
                'student_id' => $this->request->getVar('student_id', FILTER_SANITIZE_NUMBER_INT),
            ];


            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error',  temp_lang('student_classes.update_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('student_classes.update_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('student_classes.update_error'))->withInput();
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
        $redirect = checkPermission('student-classes.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $student_class = $this->model->find($id);

        if (!$student_class) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('student_classes.delete_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('student_classes.delete_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('student_classes.delete_error'))->withInput();
        }
    }
}
