<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Students extends BaseController
{
    private $model;
    private $model_user;
    private $link = 'students';
    private $view = 'students';
    private $title = 'Students';
    public function __construct()
    {
        $this->title = temp_lang('students.students');
        $this->model = new \App\Models\StudentModel();
        $this->model_user = auth()->getProvider();
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('students.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'students' => $this->model->select('students.*, users.username as user_name')->join('users', 'users.id = students.user_id', 'left')->orderBy('students.id', 'desc')->findAll()
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
        $redirect = checkPermission('students.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'users' => $this->model_user->findAll(),
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
        $redirect = checkPermission('students.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $photo = $this->request->getFile('photo');

        $rules = [
            // 'user_id' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            'full_name' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'parent_name' => 'required',
            // 'photo' => 'required',
        ];

        // Validasi hanya jika file di-upload
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $rules['photo'] = [
                'label' => 'Photo Photo',
                'rules' => 'uploaded[photo]'
                    . '|is_image[photo]'
                    . '|mime_in[photo,image/jpg,image/jpeg,image/png,image/gif]'
                    . '|max_size[photo,800]',
                'errors' => [
                    'uploaded' => 'Silahkan pilih file gambar terlebih dahulu.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in'  => 'Format harus JPG, JPEG, PNG atau GIF.',
                    'max_size' => 'Ukuran maksimal 800 KB.',
                ]
            ];
        }

        $input = $this->request->getVar();

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }

        $this->db->transBegin();


        try {
            $data = [
                'user_id' => $this->request->getVar('user_id', FILTER_SANITIZE_NUMBER_INT),
                'nis' => $this->request->getVar('nis', FILTER_SANITIZE_STRING),
                'nisn' => $this->request->getVar('nisn', FILTER_SANITIZE_STRING),
                'full_name' => $this->request->getVar('full_name', FILTER_SANITIZE_STRING),
                'gender' => $this->request->getVar('gender', FILTER_SANITIZE_STRING),
                'birth_place' => $this->request->getVar('birth_place', FILTER_SANITIZE_STRING),
                'birth_date' => $this->request->getVar('birth_date', FILTER_SANITIZE_STRING),
                'address' => $this->request->getVar('address', FILTER_SANITIZE_STRING),
                'phone' => $this->request->getVar('phone', FILTER_SANITIZE_STRING),
                'parent_name' => $this->request->getVar('parent_name', FILTER_SANITIZE_STRING),
            ];

            // Jika ada upload file
            if ($photo && $photo->isValid() && !$photo->hasMoved()) {

                // Generate nama random
                $photoName = $photo->getRandomName();

                // Simpan ke folder writable/uploads
                $photo->move(WRITEPATH . 'uploads', $photoName);

                // Simpan nama file ke database
                $data['photo'] = $photoName;
            }


            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('students.create_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success',  temp_lang('students.create_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('students.create_error'))->withInput();
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
        $redirect = checkPermission('students.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $student = $this->model->find($id);

        if (!$student) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'student' => $student,
            'users' => $this->model_user->findAll()
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
        $redirect = checkPermission('students.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $photo = $this->request->getFile('photo');

        $student = $this->model->find($id);

        if (!$student) {
            return redirect()->to($this->link);
        }

        $rules = [
            // 'user_id' => 'required',
            'nis' => 'required',
            'nisn' => 'required',
            'full_name' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'parent_name' => 'required',
            // 'photo' => 'required',
        ];

        $input = $this->request->getVar();

        // Validasi hanya jika file di-upload
        if ($photo && $photo->isValid() && !$photo->hasMoved()) {
            $rules['photo'] = [
                'label' => 'Photo Photo',
                'rules' => 'uploaded[photo]'
                    . '|is_image[photo]'
                    . '|mime_in[photo,image/jpg,image/jpeg,image/png,image/gif]'
                    . '|max_size[photo,800]',
                'errors' => [
                    'uploaded' => 'Silahkan pilih file gambar terlebih dahulu.',
                    'is_image' => 'File harus berupa gambar.',
                    'mime_in'  => 'Format harus JPG, JPEG, PNG atau GIF.',
                    'max_size' => 'Ukuran maksimal 800 KB.',
                ]
            ];
        }

        if (!$this->validateData($input, $rules)) {
            return redirect()->back()->withInput();
        }



        $this->db->transBegin();

        try {

            $data = [
                'user_id' => $this->request->getVar('user_id', FILTER_SANITIZE_NUMBER_INT),
                'nis' => $this->request->getVar('nis', FILTER_SANITIZE_STRING),
                'nisn' => $this->request->getVar('nisn', FILTER_SANITIZE_STRING),
                'full_name' => $this->request->getVar('full_name', FILTER_SANITIZE_STRING),
                'gender' => $this->request->getVar('gender', FILTER_SANITIZE_STRING),
                'birth_place' => $this->request->getVar('birth_place', FILTER_SANITIZE_STRING),
                'birth_date' => $this->request->getVar('birth_date', FILTER_SANITIZE_STRING),
                'address' => $this->request->getVar('address', FILTER_SANITIZE_STRING),
                'phone' => $this->request->getVar('phone', FILTER_SANITIZE_STRING),
                'parent_name' => $this->request->getVar('parent_name', FILTER_SANITIZE_STRING),
            ];

            // Jika ada upload file
            if ($photo && $photo->isValid() && !$photo->hasMoved()) {

                // Generate nama random
                $photoName = $photo->getRandomName();

                // Simpan ke folder writable/uploads
                $photo->move(WRITEPATH . 'uploads', $photoName);

                // Simpan nama file ke database
                $data['photo'] = $photoName;
            }

            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error',  temp_lang('students.update_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('students.update_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('students.update_error'))->withInput();
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
        $redirect = checkPermission('students.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $student = $this->model->find($id);

        if (!$student) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('students.delete_error'))->withInput();
            }

            $this->db->transCommit();

            $oldPhoto = $student->photo;
            if (!empty($oldPhoto) && file_exists(WRITEPATH . 'uploads' . $oldPhoto)) {
                unlink(WRITEPATH . 'uploads' . $oldPhoto);
            }

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('students.delete_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('students.delete_error'))->withInput();
        }
    }
}
