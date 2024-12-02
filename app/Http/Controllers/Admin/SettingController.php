<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Rules\MatchOldPassword;
use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class SettingController extends Controller
{
    public function index(): View
    {
        $user = Auth::user();

        return view('pages.admin.user.profile', [
            'user' => $user
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|unique:users',
        ]);

        User::create($validated);

        return redirect()
            ->route('users.index')
            ->with('success', 'User created successfully.');
    }

    public function show($id): View
    {
        $user = User::find($id);

        if (!$user) {
            abort(404, 'Data not found');
        }

        return view('users.show', ['user' => $user]);
    }

    public function edit($id): View
    {
        $user = User::find($id);

        if (!$user) {
            abort(404, 'Data not found');
        }

        return view('users.edit', ['user' => $user]);
    }

    public function update(Request $request, $id): RedirectResponse
    {
        $user = User::find($id);

        if (!$user) {
            return redirect()->route('users.index')->with('error', 'User not found');
        }

        $user->update($request->all());

        return redirect()->route('users.index')->with('success', 'User updated successfully');
    }

    public function destroy($id): RedirectResponse
    {
        $data = User::find($id);

        if (!$data) {
            return redirect()->route('users.index')->with('error', 'Data not found');
        }

        $data->delete();

        return redirect()->route('users.index')->with('success', 'Deleted successfully');
    }

    public function upload_profile(Request $request): RedirectResponse
    {
        $validatedData = $request->validate([
            'profile' => 'required|image|file|max:1024',
        ]);

        $id = $request->id;
        $user = User::findOrFail($id);

        if ($request->file('profile')) {
            if ($user->profile) {
                Storage::delete($user->profile);
            }
            $user->profile = $request->file('profile')->store('assets/profile-images');
        }

        $user->save();

        return redirect()
            ->route('user.index')
            ->with('success', 'Sukses! Photo Pengguna telah diperbarui');
    }

    public function change_password(): View
    {
        return view('pages.admin.user.change-password');
    }

    public function update_password(Request $request): RedirectResponse
    {
        $request->validate([
            'current_password' => ['required', new MatchOldPassword],
            'new_password' => ['required', 'min:5', 'max:255'],
            'new_confirm_password' => ['same:new_password'],
        ]);

        $user = User::find(auth()->user()->id);
        $user->update(['password' => Hash::make($request->new_password)]);

        return redirect()
            ->route('change-password')
            ->with('success', 'Sukses! Password telah diperbarui');
    }
}
