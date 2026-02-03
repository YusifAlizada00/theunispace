<?php

namespace App\Livewire;

use App\Models\StudyGroup;
use Livewire\Component;
use Mail;

class JoinStudyGroup extends Component
{
    public StudyGroup $studyGroup;
    public bool $isJoined = false;
    public function mount(StudyGroup $studyGroup)
    {
        $this->studyGroup = $studyGroup;
        $this->isJoined = $studyGroup
            ->members()
            ->where('user_id', auth()->id())
            ->exists();
    }

    public function joinGroup()
    {
        $this->studyGroup->members()->attach(auth()->id());
        $this->isJoined = true;
        Mail::to($this->studyGroup->leader->email)->send(new \App\Mail\NewMemberJoinedStudyGroupMail(auth()->user(), $this->studyGroup));
    }
    public function leaveGroup()
    {
        $this->studyGroup->members()->detach(auth()->id());
        $this->isJoined = false;
        Mail::to($this->studyGroup->leader->email)->send(new \App\Mail\MemberLeftStudyGroupMail(auth()->user(), $this->studyGroup));
    }
    public function render()
    {
        return view('livewire.join-study-group');
    }
}
