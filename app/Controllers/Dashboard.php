<?php

namespace App\Controllers;

class Dashboard extends BaseController
{
    private $model_teacher;
    private $model_student;
    private $model_student_class;
    private $model_class;
    private $model_class_subject;
    private $model_subject;
    private $model_assignment;
    private $model_assignment_submission;
    private $model_material;
    private $model_teacher_subject;
    private $link = 'dashboard';
    private $view = 'dashboard';
    private $title = 'Dashboard';
    public function __construct()
    {
        $this->model_teacher = new \App\Models\TeacherModel();
        $this->model_student = new \App\Models\StudentClassModel();
        $this->model_student_class = new \App\Models\StudentClassModel();
        $this->model_class = new \App\Models\ClassModel();
        $this->model_class_subject = new \App\Models\ClassSubjectModel();
        $this->model_subject = new \App\Models\SubjectModel();
        $this->model_assignment = new \App\Models\AssignmentModel();
        $this->model_assignment_submission = new \App\Models\AssignmentSubmissionModel();
        $this->model_material = new \App\Models\MaterialModel();
        $this->model_teacher_subject = new \App\Models\TeacherSubjectModel();
    }
    public function index()
    {
        // echo 'Login  - ' . auth()->user()->email . ' - <a href="' . base_url('logout') . '">logout</a> - ';
        $check_student = auth()->user()->inGroup('student');
        $check_teacher = auth()->user()->inGroup('teacher');
        $check_superadmin = auth()->user()->inGroup('superadmin');

        if ($check_superadmin) {
            $data = [
                'title' => $this->title,
                'link' => $this->link,
                'total_teachers' => $this->model_teacher->countAllResults(),
                'total_students' => $this->model_student->countAllResults(),
                'total_classes' => $this->model_class->countAllResults(),
                'total_subjects' => $this->model_subject->countAllResults(),
                'total_assignments' => $this->model_assignment->where('deadline >=', date('Y-m-d H:i:s'))->countAllResults(),
                'total_materials' => $this->model_material->countAllResults(),
            ];
            return view($this->view . '/index', $data);
        } else if ($check_teacher) {
            $data = [
                'title' => $this->title,
                'link' => $this->link,
                'total_teacher_subjects' => $this->model_teacher_subject->join('teachers', 'teachers.id = teacher_subjects.teacher_id')->where('teachers.user_id', auth()->id())->countAllResults(),
                'total_teacher_subject_classes' => $this->model_teacher_subject->join('teachers', 'teachers.id = teacher_subjects.teacher_id')->join('class_subjects', 'class_subjects.subject_id = teacher_subjects.subject_id')->where('teachers.user_id', auth()->id())->countAllResults(),
                'total_assignments' => $this->model_assignment->where('deadline >=', date('Y-m-d H:i:s'))->join('teachers', 'teachers.id = assignments.teacher_id')->where('teachers.user_id', auth()->id())->countAllResults(),
                'total_assignment_submissions' => $this->model_assignment_submission->join('assignments', 'assignments.id = assignment_submissions.assignment_id')->join('teachers', 'teachers.id = assignments.teacher_id')->where('teachers.user_id', auth()->id())
                    ->where('score IS NULL')->countAllResults(),
            ];

            return view($this->view . '/index_teacher', $data);
        } else if ($check_student) {
            $data = [
                'title' => $this->title,
                'link' => $this->link,
                'class_current' => $this->model_student_class->select('classes.*')->join('classes', 'classes.id = student_classes.class_id')->join('students', 'students.id = student_classes.student_id')->where('students.user_id', auth()->id())->orderBy('student_classes.created_at', 'DESC')->first(),
                'total_class_subjects' => $this->model_class_subject->join('student_classes', 'student_classes.class_id = class_subjects.class_id')->join('students', 'students.id = student_classes.student_id')->where('students.user_id', auth()->id())->countAllResults(),
                'total_assignments' => $this->model_assignment->join('class_subjects', 'class_subjects.subject_id = assignments.subject_id')->join('student_classes', 'student_classes.class_id = class_subjects.class_id')->join('students', 'students.id = student_classes.student_id')->where('students.user_id', auth()->id())->where('deadline >=', date('Y-m-d H:i:s'))->countAllResults(),
                'average_score_submission' => $this->model_assignment_submission->selectAvg('score', 'avg_score')->join('assignments', 'assignments.id = assignment_submissions.assignment_id')->join('class_subjects', 'class_subjects.subject_id = assignments.subject_id')->join('student_classes', 'student_classes.class_id = class_subjects.class_id')->join('students', 'students.id = student_classes.student_id')->where('students.user_id', auth()->id())->first(),
            ];

            return view($this->view . '/index_student', $data);
        }
    }
}
