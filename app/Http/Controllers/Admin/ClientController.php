<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Enums\UserType;
use App\Enums\UserStatus;
use App\Traits\ProfileUpdateTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class ClientController extends Controller
{
    use ProfileUpdateTrait;

    public function index()
    {
        $clients = User::where('user_type', UserType::CLIENT)
                      ->latest()
                      ->paginate(10);

        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.clients.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'phone' => 'required|string|max:20',
            'password' => 'required|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=1920,max_height=1080',
            'status' => 'required|in:' . implode(',', array_column(UserStatus::cases(), 'value')),
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'password' => Hash::make($request->password),
            'user_type' => UserType::CLIENT,
            'status' => UserStatus::from($request->status),
        ];

        if ($request->hasFile('profile_image')) {
            $image = $request->file('profile_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('profile_images', $imageName, 'public');
            $data['profile_image'] = $imagePath;
        }

        User::create($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client created successfully.');
    }

   public function show(User $client)
    {
        // Eager load the assignedTexts relationship
        $client->load('assignedTexts');

        return view('admin.clients.show', compact('client'));
    }

    public function edit(User $client)
    {
        return view('admin.clients.edit', compact('client'));
    }

    public function update(Request $request, User $client)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'email' => ['required', 'email', Rule::unique('users')->ignore($client->id)],
            'phone' => 'required|string|max:20',
            'password' => 'nullable|min:8|confirmed',
            'profile_image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048|dimensions:max_width=1920,max_height=1080',
            'status' => 'required|in:' . implode(',', array_column(UserStatus::cases(), 'value')),
        ]);

        $data = [
            'name' => $request->name,
            'email' => $request->email,
            'phone' => $request->phone,
            'status' => UserStatus::from($request->status),
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->hasFile('profile_image')) {
            if ($client->profile_image) {
                \Storage::disk('public')->delete($client->profile_image);
            }

            $image = $request->file('profile_image');
            $imageName = time() . '_' . $image->getClientOriginalName();
            $imagePath = $image->storeAs('profile_images', $imageName, 'public');
            $data['profile_image'] = $imagePath;
        }

        $client->update($data);

        return redirect()->route('admin.clients.index')->with('success', 'Client updated successfully.');
    }

    public function destroy(User $client)
    {
        if ($client->profile_image) {
            \Storage::disk('public')->delete($client->profile_image);
        }

        $client->delete();

        return redirect()->route('admin.clients.index')->with('success', 'Client deleted successfully.');
    }
}