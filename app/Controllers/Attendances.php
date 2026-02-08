<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Attendances extends BaseController
{
    private $model;
    private $model_student;
    private $model_teacher;
    private $link = 'attendances';
    private $view = 'attendances';
    private $title = 'Attendances';
    public function __construct()
    {
        $this->title = temp_lang('attendances.attendance');

        $this->model = new \App\Models\AttendanceModel();
        $this->model_student = new \App\Models\StudentModel();
        $this->model_teacher = new \App\Models\TeacherModel();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('attendances.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $attendances = $this->model->select('attendances.*')->select("  CASE 
        WHEN attendances.type = 'student' THEN students.full_name
        WHEN attendances.type = 'teacher' THEN teachers.full_name
    END AS full_name")->join('students', 'students.id = attendances.user_id')->join('teachers', 'teachers.id = attendances.user_id')->orderBy('attendances.id', 'desc');

        if (!auth()->user()->can('attendances.access-all')) {
            if (auth()->user()->inGroup('student')) {
                $user_id = $this->model_student->where('user_id', auth()->id())->first()->id ?? null;
                $attendances = $attendances->where('type', 'student')->where('attendances.user_id', $user_id);
            } else {
                $user_id = $this->model_teacher->where('user_id', auth()->id())->first()->id ?? null;
                $attendances = $attendances->where('type', 'teacher')->where('attendances.user_id', $user_id);
            }
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'attendances' => $attendances->findAll()
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
        $redirect = checkPermission('attendances.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        if (!auth()->user()->can('attendances.access-all')) {
            $checkTheDay  = checkTheDay();
            if ($checkTheDay == false) {
                return redirect()->to($this->link);
            }
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'status' => $this->model->status,
            'types' => $this->model->types,
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
        $redirect = checkPermission('attendances.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        if (!auth()->user()->can('attendances.access-all')) {
            $checkTheDay  = checkTheDay();
            if ($checkTheDay == false) {
                return redirect()->to($this->link);
            }
        }

        $rules = [
            // 'user_id' => 'required',
            // 'type' => 'required',
            'status' => 'required',
            // 'date' => 'required',
            // 'date' => 'required|valid_date[Y-m-d]',
            // 'description' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();

        try {
            $data = [
                'status' => $this->request->getVar('status', FILTER_SANITIZE_STRING),
                'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING),
            ];

            if (auth()->user()->can('attendances.access-all')) {
                $data['user_id'] = $this->request->getVar('user_id', FILTER_SANITIZE_NUMBER_INT);
                $data['date'] = $this->request->getVar('date');
                $data['type'] = $this->request->getVar('type', FILTER_SANITIZE_STRING);
            } else {
                if (auth()->user()->inGroup('student')) {
                    $data['type'] = 'student';
                    $user_id = $this->model_student->where('user_id', auth()->id())->first()->id ?? null;
                    $data['user_id'] = $user_id;
                } else {
                    $data['type'] = 'teacher';
                    $user_id = $this->model_teacher->where('user_id', auth()->id())->first()->id ?? null;
                    $data['user_id'] = $user_id;
                }
                $data['date'] = date('Y-m-d');
            }

            if ($this->model->where('user_id', $data['user_id'])->where('date', $data['date'])->where('type', $data['type'])->first()) {
                return redirect()->back()->with('error', temp_lang('attendances.already_attendance'))->withInput();
            }

            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('attendances.create_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success',  temp_lang('attendances.create_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('attendances.create_error'))->withInput();
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
        $redirect = checkPermission('attendances.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $attendance = $this->model->find($id);

        if (!$attendance) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'status' => $this->model->status,
            'types' => $this->model->types,
            'attendance' => $attendance,
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
        $redirect = checkPermission('attendances.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $attendance = $this->model->find($id);

        if (!$attendance) {
            return redirect()->to($this->link);
        }

        $rules = [
            'user_id' => 'required',
            'type' => 'required',
            'status' => 'required',
            'date' => 'required',
        ];

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }


        $this->db->transBegin();

        try {

            $data = [
                'user_id' => $this->request->getVar('user_id', FILTER_SANITIZE_NUMBER_INT),
                'date' => $this->request->getVar('date', FILTER_SANITIZE_STRING),
                'type' => $this->request->getVar('type', FILTER_SANITIZE_STRING),
                'status' => $this->request->getVar('status', FILTER_SANITIZE_STRING),
                'description' => $this->request->getVar('description', FILTER_SANITIZE_STRING),
            ];


            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error',  temp_lang('attendances.update_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('attendances.update_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('attendances.update_error'))->withInput();
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
        $redirect = checkPermission('attendances.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $attendance = $this->model->find($id);

        if (!$attendance) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('attendances.delete_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('attendances.delete_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('attendances.delete_error'))->withInput();
        }
    }

    public function ajax_users()
    {
        $redirect = checkPermission('attendances.access-all');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $type = $this->request->getVar('type', FILTER_SANITIZE_STRING);

        if ($type == 'student') {
            $users = $this->model_student->findAll();
        } else   if ($type == 'teacher') {
            $users = $this->model_teacher->findAll();
        } else {
            $users = $this->model_teacher->findAll();
        }


        return $this->response->setJSON([
            'success' => true,
            'data' => $users,
            'message' => 'Success get data'
        ]);
    }
}
