<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use App\Models\Address;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class ProfileController extends Controller
{
    public function index()
    {
        $user = auth()->user();

        return view('user.account', [
            'user' => $user,
            'bankAccounts' => BankAccount::where('user_id', $user->id)
                ->latest()
                ->get(),
            'addresses' => Address::where('user_id', $user->id)
                ->latest()
                ->get(),
        ]);
    }

    public function update(Request $request)
    {
        $user = auth()->user();

        $validated = $request->validate([
            'name' => ['sometimes', 'required', 'string', 'max:255'],
            'date_of_birth' => ['sometimes', 'nullable', 'date'],
            'gender' => [
                'sometimes',
                'nullable',
                Rule::in(['laki-laki', 'perempuan']),
            ],

            'email' => [
                'sometimes',
                'required',
                'email',
                'max:255',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'phone' => ['sometimes', 'nullable', 'string', 'max:20'],
        ]);

        $user->update($validated);

        return redirect()
            ->route('profile', ['tab' => 'profile'])
            ->with('success', 'Data profil berhasil diperbarui.');
    }
}
