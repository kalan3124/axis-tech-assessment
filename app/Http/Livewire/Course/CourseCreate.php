<?php

namespace App\Http\Livewire\Course;

use App\Models\Course;
use Livewire\Component;

class CourseCreate extends Component
{
    public $form = [
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

    public function submitCourseData()
    {
        $this->validate();
        Course::create($this->form);
        $this->emit('refreshTable');
        $this->reset();
        $this->dispatchBrowserEvent('course-added');
    }

    public function render()
    {
        return view('livewire.course.course-create');
    }
}
