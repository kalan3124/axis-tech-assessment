<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class CourseView extends Component
{
    public $courses = [];
    public $usersCourse = [];
    public $search;
    protected $listeners = ['refreshTable' => 'mount'];

    public $form = [
        'id' => '',
        'title' => '',
        'description' => '',
    ];
    protected $rules = [
        'form.title' => 'required',
        'form.description' => 'required',
    ];

    protected $messages = [
        'form.title.required' => 'The title cannot be empty',
        'form.description.required' => 'The description cannot be empty',
    ];

    public function mount()
    {
        $this->courses =  $this->searchQuery();
    }

    public function deleteCourse($id)
    {
        Course::whereId($id)->delete();
        $this->emit('refreshTable');
    }

    public function getPartUsers($data)
    {
        $this->usersCourse = $data;
        $this->dispatchBrowserEvent('show-users-course-modal');
    }

    public function editCourse(Course $course)
    {
        $this->form = [
            'id' => $course->id,
            'title' => $course->title,
            'description' => $course->description,
        ];
        $this->dispatchBrowserEvent('show-edit-modal');
    }

    public function updateCourse()
    {
        $this->validate();
        $courseUpdate = Course::whereId($this->form['id'])->first();
        $courseUpdate->update([
            'title' => $this->form['title'],
            'description' => $this->form['description']
        ]);
        $this->dispatchBrowserEvent('reload-page');
    }

    public function searchQuery()
    {
        $query = Course::with('users', 'filterUsers');
        if (isset($this->search)) {
            $query->where(function ($query) {
                $query->where('title', 'like', '%' . $this->search . '%')
                    ->orWhere('description', 'like', '%' . $this->search . '%');
            });
        }

        return $query->get();
    }

    public function render()
    {
        return view('livewire.course.course-view');
    }

    public function updatedSearch()
    {
        $this->courses =  $this->searchQuery();
    }
}
