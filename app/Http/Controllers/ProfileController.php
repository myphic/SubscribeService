<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Storage;
use Inertia\Inertia;
use Inertia\Response;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): Response
    {

        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $validatedRequest = $request->validated();
        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        if ($validatedRequest['avatar'] && !is_string($validatedRequest['avatar'])) {
            $path = Storage::disk('public')->putFileAs('images/' . $request->user()->id, $validatedRequest['avatar'], $request->user()->id . '.' . $validatedRequest['avatar']->getClientOriginalExtension());
            $validatedRequest['avatar'] = '/storage/' . $path;
        } else {
            unset($validatedRequest['avatar']);
        }
        $request->user()->fill($validatedRequest);
        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
}
