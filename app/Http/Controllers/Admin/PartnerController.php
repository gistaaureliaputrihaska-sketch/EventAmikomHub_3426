<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Partner;
use Illuminate\Http\Request;

class PartnerController extends Controller
{
    // READ + SEARCH
    public function index(Request $request)
    {
        $query = Partner::query();

        if ($request->filled('search')) {
            $query->where('name', 'LIKE', '%' . $request->search . '%');
        }

        $partners = $query->latest()->paginate(10)->withQueryString();

        return view('admin.partners.index', compact('partners'));
    }

    // SHOW CREATE FORM
    public function create()
    {
        return view('admin.partners.create');
    }

    // STORE (CREATE)
    public function store(Request $request)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'logo_url' => 'required|url|max:500',
        ]);

        Partner::create($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil ditambahkan.');
    }

    // SHOW EDIT FORM
    public function edit(Partner $partner)
    {
        return view('admin.partners.edit', compact('partner'));
    }

    // UPDATE
    public function update(Request $request, Partner $partner)
    {
        $data = $request->validate([
            'name'     => 'required|string|max:255',
            'logo_url' => 'required|url|max:500',
        ]);

        $partner->update($data);

        return redirect()->route('admin.partners.index')
            ->with('success', 'Data partner berhasil diperbarui.');
    }

    // DELETE
    public function destroy(Partner $partner)
    {
        $partner->delete();

        return redirect()->route('admin.partners.index')
            ->with('success', 'Partner berhasil dihapus.');
    }
}
