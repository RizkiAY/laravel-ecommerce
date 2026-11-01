<?php

namespace App\Http\Controllers;

use App\Models\BankAccount;
use Illuminate\Http\Request;

class BankAccountController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'bank_name' => ['required', 'string', 'max:100'],
            'account_name' => ['required', 'string', 'max:150'],
            'account_number' => ['required', 'string', 'max:50'],
        ]);

        BankAccount::create([
            ...$validated,
            'user_id' => auth()->id(),
        ]);

        return redirect('/profile?tab=bank')
            ->with('success', 'Rekening bank berhasil ditambahkan.');
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'bank_name' => ['required', 'string', 'max:100'],
            'account_name' => ['required', 'string', 'max:150'],
            'account_number' => ['required', 'string', 'max:50'],
        ]);

        $bank = BankAccount::where('user_id', auth()->id())
            ->findOrFail($id);

        $bank->update($validated);

        return redirect('/profile?tab=bank')
            ->with('success', 'Rekening bank berhasil diperbarui.');
    }
}