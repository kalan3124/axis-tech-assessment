<?php

namespace App\Http\Livewire\Users;

use App\Models\Course;
use App\Models\CourseUser;
use App\Models\User;
use Livewire\Component;

class UserDetails extends Component
{
    public $paramId;
    public $courses;
    public $userCourses;
    public $userName;
    public $open = false;
    public $coursesArray = [];
    public $checks = [];
    protected $listeners = ['refreshAssigedTable' => 'render'];

    public function mount($id)
    {
        $this->paramId = $id;
        $couseIds = CourseUser::where('user_id', $id)->get()->pluck('course_id');
        $this->courses = Course::whereNotIn('id', $couseIds)->get();
        $this->userCourses = User::with('courses')->where('id', $id)->first();
        $this->user = User::find($id);
    }

    public function openTable()
    {
        if (!$this->open)
            $this->open = true;
        else
            $this->open = false;
    }


    public function reloadCourses()
    {
        $couseIds = CourseUser::where('user_id', $this->paramId)->get()->pluck('course_id');
        $this->courses = Course::whereNotIn('id', $couseIds)->get();
    }

    public function collectId($id)
    {
        $course = Course::find($id);
        if ($this->checks[$id]) {
            array_push($this->coursesArray, $course);
        } else {
            $this->coursesArray = collect($this->coursesArray)->reject(function ($val) use ($id) {
                return $val['id'] == $id;
            })->values();
        }
    }

    public function submit()
    {
        foreach ($this->coursesArray as $key => $val) {
            CourseUser::create([
                'user_id' => $this->user->id,
                'course_id' => $val['id']
            ]);
        }

        $this->reloadCourses();
        $this->emit('refreshAssigedTable','refreshCourseTable');
    }

    public function render()
    {
        return view('livewire.users.user-details');
    }
}
