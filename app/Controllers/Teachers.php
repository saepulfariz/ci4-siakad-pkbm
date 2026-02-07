<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use CodeIgniter\HTTP\ResponseInterface;

class Teachers extends BaseController
{
    private $model;
    private $model_user;

    protected $uploadPath;
    protected $defaultPhoto;

    private $link = 'teachers';
    private $view = 'teachers';
    private $title = 'Teachers';
    public function __construct()
    {
        $this->title = temp_lang('teachers.teachers');
        $this->model = new \App\Models\TeacherModel();
        $this->model_user = auth()->getProvider();

        $this->uploadPath = WRITEPATH . 'uploads/teachers/';

        $defaultPhoto = FCPATH . 'assets/dist/img/user.png';

        if (!is_dir($this->uploadPath)) {
            mkdir($this->uploadPath, 0775, true);
        }

        $this->defaultPhoto =  'teacher.png';

        if (!file_exists($this->uploadPath . $this->defaultPhoto)) {
            copy($defaultPhoto, $this->uploadPath . $this->defaultPhoto);
        }
    }

    /**
     * Return an array of resource objects, themselves in array format.
     *
     * @return ResponseInterface
     */
    public function index()
    {
        $redirect = checkPermission('teachers.access');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'teachers' => $this->model->select('teachers.*, users.username as user_name')->join('users', 'users.id = teachers.user_id', 'left')->orderBy('teachers.id', 'desc')->findAll()
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
        $redirect = checkPermission('teachers.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'educations' => $this->model->educations,
            'users' => $this->model_user->select('users.*, teachers.full_name, auth_identities.name as name')->join('auth_groups_users', "auth_groups_users.user_id = users.id AND auth_groups_users.group = 'teacher'")->join('teachers', 'teachers.user_id = users.id', 'LEFT')->join('auth_identities', "auth_identities.user_id = users.id AND auth_identities.type = 'email_password'")->where('teachers.full_name IS NULL')->findAll(),
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
        $redirect = checkPermission('teachers.create');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $photo = $this->request->getFile('photo');

        $rules = [
            // 'user_id' => 'required',
            'nik' => 'required',
            'full_name' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'education_level' => 'required',
            'education_name' => 'required',
            'education_major' => 'required',
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
                'nik' => $this->request->getVar('nik', FILTER_SANITIZE_STRING),
                'full_name' => $this->request->getVar('full_name', FILTER_SANITIZE_STRING),
                'gender' => $this->request->getVar('gender', FILTER_SANITIZE_STRING),
                'birth_place' => $this->request->getVar('birth_place', FILTER_SANITIZE_STRING),
                'birth_date' => $this->request->getVar('birth_date', FILTER_SANITIZE_STRING),
                'address' => $this->request->getVar('address', FILTER_SANITIZE_STRING),
                'phone' => $this->request->getVar('phone', FILTER_SANITIZE_STRING),
                'education_level' => $this->request->getVar('education_level', FILTER_SANITIZE_STRING),
                'education_name' => $this->request->getVar('education_name', FILTER_SANITIZE_STRING),
                'education_major' => $this->request->getVar('education_major', FILTER_SANITIZE_STRING),
            ];

            // Jika ada upload file
            if ($photo && $photo->isValid() && !$photo->hasMoved()) {

                // Generate nama random
                $photoName = $photo->getRandomName();

                // Simpan ke folder writable/uploads
                $photo->move($this->uploadPath, $photoName);

                // Simpan nama file ke database
                $data['photo'] = $photoName;
            } else {
                $data['photo'] = $this->defaultPhoto;
            }


            $this->model->insert($data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('teachers.create_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success',  temp_lang('teachers.create_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('teachers.create_error'))->withInput();
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
        $redirect = checkPermission('teachers.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $teacher = $this->model->find($id);

        if (!$teacher) {
            throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound();
            // return redirect()->to($this->link);
        }

        $data = [
            'title' => $this->title,
            'link' => $this->link,
            'educations' => $this->model->educations,
            'teacher' => $teacher,
            'users' => $this->model_user->select('users.*, teachers.full_name, auth_identities.name as name')->join('auth_groups_users', "auth_groups_users.user_id = users.id AND auth_groups_users.group = 'teacher'")->join('teachers', 'teachers.user_id = users.id', 'LEFT')->join('auth_identities', "auth_identities.user_id = users.id AND auth_identities.type = 'email_password'")->findAll(),
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
        $redirect = checkPermission('teachers.edit');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $photo = $this->request->getFile('photo');

        $teacher = $this->model->find($id);

        if (!$teacher) {
            return redirect()->to($this->link);
        }

        $rules = [
            // 'user_id' => 'required',
            'nik' => 'required',
            'full_name' => 'required',
            'gender' => 'required',
            'birth_place' => 'required',
            'birth_date' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'education_level' => 'required',
            'education_name' => 'required',
            'education_major' => 'required',
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
                'nik' => $this->request->getVar('nik', FILTER_SANITIZE_STRING),
                'full_name' => $this->request->getVar('full_name', FILTER_SANITIZE_STRING),
                'gender' => $this->request->getVar('gender', FILTER_SANITIZE_STRING),
                'birth_place' => $this->request->getVar('birth_place', FILTER_SANITIZE_STRING),
                'birth_date' => $this->request->getVar('birth_date', FILTER_SANITIZE_STRING),
                'address' => $this->request->getVar('address', FILTER_SANITIZE_STRING),
                'phone' => $this->request->getVar('phone', FILTER_SANITIZE_STRING),
                'education_level' => $this->request->getVar('education_level', FILTER_SANITIZE_STRING),
                'education_name' => $this->request->getVar('education_name', FILTER_SANITIZE_STRING),
                'education_major' => $this->request->getVar('education_major', FILTER_SANITIZE_STRING),
            ];

            // Jika ada upload file
            if ($photo && $photo->isValid() && !$photo->hasMoved()) {

                $oldPhoto = $teacher->photo;

                if (!empty($oldPhoto) && $oldPhoto != $this->defaultPhoto && file_exists($this->uploadPath . $oldPhoto)) {
                    unlink($this->uploadPath . $oldPhoto);
                }

                // Generate nama random
                $photoName = $photo->getRandomName();

                // Simpan ke folder writable/uploads
                $photo->move($this->uploadPath, $photoName);

                // Simpan nama file ke database
                $data['photo'] = $photoName;
            }

            $this->model->update($id, $data);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error',  temp_lang('teachers.update_error'))->withInput();
            }

            $this->db->transCommit();

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('teachers.update_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('teachers.update_error'))->withInput();
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
        $redirect = checkPermission('teachers.delete');
        if ($redirect instanceof \CodeIgniter\HTTP\RedirectResponse) {
            return $redirect;
        }

        $teacher = $this->model->find($id);

        if (!$teacher) {
            return redirect()->to($this->link);
        }

        $this->db->transBegin();

        try {
            $this->model->delete($id);

            if ($this->db->transStatus() === false) {
                $this->db->transRollback();
                return redirect()->back()->with('error', temp_lang('teachers.delete_error'))->withInput();
            }

            $this->db->transCommit();

            $oldPhoto = $teacher->photo;
            if (!empty($oldPhoto) && $oldPhoto != $this->defaultPhoto && file_exists($this->uploadPath . $oldPhoto)) {
                unlink($this->uploadPath . $oldPhoto);
            }

            $cache = \Config\Services::cache();
            $cache->delete($this->model->cacheKey);

            return redirect()->with('success', temp_lang('teachers.delete_success'))->to($this->link);
        } catch (\Throwable $th) {
            $this->db->transRollback();
            return redirect()->back()->with('error', temp_lang('teachers.delete_error'))->withInput();
        }
    }
}
