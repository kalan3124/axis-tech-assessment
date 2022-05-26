<?php

namespace App\Http\Livewire\UserCourse;

use App\Models\CourseUser;
use App\Models\ParticipateUser;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class UserCourseView extends Component
{
    public $userCourses = [];
    protected $listeners = ['reloadUserCourseTable' => 'mount'];

    public function mount()
    {
        $this->userCourses = User::with('courses')->where('id', Auth::user()->id)->first();
    }

    public function participateUser($id)
    {
        $coursePart = CourseUser::where('user_id', Auth::user()->id)
            ->where('course_id', $id)
            ->first();
        $coursePart->update(['status' => 1]);
        $this->emit("reloadUserCourseTable");
    }

    public function render()
    {
        return view('livewire.user-course.user-course-view');
    }
}
