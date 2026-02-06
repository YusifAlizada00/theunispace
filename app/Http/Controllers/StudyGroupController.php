<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateStudyGroupRequest;
use Illuminate\Http\Request;
use App\Http\Requests\CreateStudyGroupRequest;
use App\Models\StudyGroup;
use Illuminate\Support\Facades\Auth;

class StudyGroupController extends Controller
{
    public function index()
    {
        $today = now()->toDateString();
        $time = now()->toTimeString();

        // 1. Get UPCOMING sessions
        // Logic: Date is in future OR (Date is today AND Time is not over yet)
        // Sort: ASC (So the one starting nearest to now is at the top)
        $upcoming = StudyGroup::whereRaw('(date > ?) OR (date = ? AND end_time >= ?)', [$today, $today, $time])
            ->orderBy('date', 'asc')
            ->orderBy('start_time', 'asc')
            ->get();

        // 2. Get PAST sessions
        // Logic: Date is in past OR (Date is today AND Time is already over)
        // Sort: DESC (So the one that just finished is at the top of the history list)
        $past = StudyGroup::whereRaw('(date < ?) OR (date = ? AND end_time < ?)', [$today, $today, $time])
            ->orderBy('date', 'desc')
            ->orderBy('start_time', 'desc')
            ->get();

        $studyGroups = $upcoming->concat($past);

        $myGroups = auth()->user()->joinedGroups()
            ->whereRaw('(date > ?) OR (date = ? AND end_time >= ?)', [$today, $today, $time])
            ->orderBy('date')->orderBy('start_time')
            ->get();      
              
        return view('study-groups', compact('studyGroups', 'myGroups'));
    }

    public function store(CreateStudyGroupRequest $request)
    {
        $data = $request->validated();

        // Assuming you have a StudyGroup model to handle the database operations
        StudyGroup::create([
            'leader_id' => auth()->id(),
            'group_name' => $data['group_name'],
            'subject' => $data['subject'],
            'description' => $data['description'] ?? null,
            'location' => $data['location'],
            'date' => $data['date'],
            'start_time' => $data['start_time'],
            'end_time' => $data['end_time'],
        ]);


        return redirect()
            ->route('study-groups')
            ->with('success', 'Study group was created successfully!');
    }

    public function show(StudyGroup $studyGroup)
    {
        return view('study-groups-details', compact('studyGroup'));
    }

    public function edit(StudyGroup $studyGroup)
    {
        if(Auth::user()->id != $studyGroup->leader->id)
        {
            abort(404);
        }
        return view('edit-study-groups', compact('studyGroup'));
    }

    public function displayDetails(StudyGroup $studyGroup)
    {
        return view('study-groups-details', compact('studyGroup'));
    }

    public function update(UpdateStudyGroupRequest $request, StudyGroup $studyGroup)
    {
        $studyGroup->update([
            'group_name' => $request->group_name,
            'subject' => $request->subject,
            'description' => $request->description,
            'location' => $request->location,
            'date' => $request->date,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
        ]);

        return redirect()
            ->route('study-groups')
            ->with('success', 'Study group updated successfully!');
    }


    public function userStudyGroups($name)
    {
        // Get the study groups for this profile page
        $user = \App\Models\User::where('slug', $name)->firstOrFail();

        // Allow a tab query: 'current' (member) or 'created' (leader)
        $tab = request()->get('tab', 'current');

        if ($tab === 'created') {
            $studyGroups = StudyGroup::where('leader_id', $user->id)->latest()->get();
        } else {
            $studyGroups = $user->joinedGroups()->latest()->get();
        }

        return view('profile.show', compact('studyGroups', 'user', 'tab'));
    }


    public function destroy(StudyGroup $studyGroup)
    {
        if(Auth::user()->id != $studyGroup->leader->id)
        {
            abort(404);
        }
        $studyGroup->delete();
        return redirect()->route('study-groups')->with('delete', 'Study group has been deleted!');
    }
}
