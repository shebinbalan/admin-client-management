<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\AssignedText;
use App\Helpers\UserHelper;
use Illuminate\Http\Request;

class AssignedTextController extends Controller
{
    public function index()
    {
        $assignedTexts = AssignedText::with('creator', 'assignedUsers')
            ->latest()
            ->paginate(10);

        return view('admin.assigned-texts.index', compact('assignedTexts'));
    }

    public function create()
    {
        $clients = UserHelper::getClientUsersForSelect();
        return view('admin.assigned-texts.create', compact('clients'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'client_ids'  => 'required|array|min:1',
            'client_ids.*'=> 'exists:users,id',
            'status'      => 'nullable|string|max:50',
            'deadline'    => 'nullable|date',
            'notes'       => 'nullable|string',
            'priority'    => 'nullable|integer|min:1|max:5',
        ]);

        $assignedText = AssignedText::create([
            'title'      => $request->title,
            'content'    => $request->content,
            'created_by' => auth()->id(),
            'status'     => $request->status ?? 'pending',
            'deadline'   => $request->deadline,
            'notes'      => $request->notes,
            'priority'   => $request->priority ?? 3,
        ]);

        $assignedText->assignedUsers()->attach($request->client_ids);

        return redirect()->route('admin.assigned-texts.index')->with('success', 'Text assigned successfully.');
    }

    public function show(AssignedText $assignedText)
    {
        $assignedText->load(['creator', 'assignedUsers']);
        return view('admin.assigned-texts.show', compact('assignedText'));
    }

    public function edit(AssignedText $assignedText)
    {
        $clients = UserHelper::getClientUsersForSelect();
        $selectedClients = $assignedText->assignedUsers->pluck('id')->toArray();

        return view('admin.assigned-texts.edit', compact('assignedText', 'clients', 'selectedClients'));
    }

    public function update(Request $request, AssignedText $assignedText)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'content'     => 'required|string',
            'client_ids'  => 'required|array|min:1',
            'client_ids.*'=> 'exists:users,id',
            'status'      => 'nullable|string|max:50',
            'deadline'    => 'nullable|date',
            'notes'       => 'nullable|string',
            'priority'    => 'nullable|integer|min:1|max:5',
        ]);

        $assignedText->update([
            'title'      => $request->title,
            'content'    => $request->content,
            'status'     => $request->status ?? 'pending',
            'deadline'   => $request->deadline,
            'notes'      => $request->notes,
            'priority'   => $request->priority ?? 3,
        ]);

        $assignedText->assignedUsers()->sync($request->client_ids);

        return redirect()->route('admin.assigned-texts.index')->with('success', 'Text updated successfully.');
    }

    public function destroy(AssignedText $assignedText)
    {
        $assignedText->delete();

        return redirect()->route('admin.assigned-texts.index')->with('success', 'Text deleted successfully.');
    }
}
