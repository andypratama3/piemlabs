<?php

namespace App\Http\Controllers\dashboard\PiemTravel;

use App\Models\User;
use App\Models\Produk;
use App\Models\Passport;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Yajra\DataTables\Facades\DataTables;
use App\DataTransferObjects\PassportData;
use App\Actions\dashboard\Passport\PassportAction;

class PassportController extends Controller
{
    public function index()
    {
        $passport_count = Passport::count();
        $passport_count_pending = Passport::where('status', 'pending')->count();
        $passport_count_approved = Passport::where('status', 'approved')->count();

        return view('content.dashboard.data.piem-travel.passport.index', compact('passport_count', 'passport_count_pending', 'passport_count_approved'));
    }

    public function dataTable()
    {
        $passports = Passport::with('user','produk')->select('id', 'ktp', 'kk', 'akta_kelahiran', 'ijazah', 'surat_kawin', 'passport', 'status', 'slug');
        return DataTables::of($passports)
            ->addColumn('actiwion', function ($row) {
                return '
                        <a href="' . route('dashboard.piem-travel.passport.show', $row->slug) . '" class="btn btn-sm btn-rounded btn-warning"><i class="mdi mdi-eye"></i></a>
                        <a href="' . route('dashboard.piem-travel.passport.edit', $row->slug) . '" class="btn btn-sm btn-rounded btn-primary"><i class="mdi mdi-pen"></i></a>
                        <button data-id="' . $row['slug'] . '" class="btn btn-sm btn-rounded btn-danger" id="btn-delete"><i class="mdi mdi-delete"></i></button>
                    ';
            })
            ->addColumn('user', function ($row) {
                return $row->user->name;
            })
            ->addColumn('produk', function ($row) {
                return $row->produk->name;
            })
            ->rawColumns(['action'])
            ->make(true);
    }

    public function create()
    {
        $users = User::select('id', 'name', 'email')->orderBy('name')->get();
        $produks = Produk::where('status', 1)->select('id', 'name', 'slug')->orderBy('name')->get();
        return view('content.dashboard.data.piem-travel.passport.create', compact('users', 'produks'));
    }

    public function store(PassportData $passportData, PassportAction $passportAction)
    {
        $passportAction->execute($passportData);
        return redirect()->route('dashboard.piem-travel.passport.index')->with('success', 'Data passport Berhasil Di Tambahkan');
    }

    public function show(Passport $passport)
    {
        return view('content.dashboard.data.piem-travel.passport.show', compact('passport'));
    }

    public function edit(Passport $passport)
    {
        return view('content.dashboard.data.piem-travel.passport.show', compact('passport'));
    }

    public function update(PassportData $passportData, PassportAction $passportAction)
    {
        $passportAction->store($passportData);
        return redirect()->route('dashboard.piem-travel.passport.index')->with('success', 'Data Passport Berhasil Di Updtae');
    }

    public function destroy(Passport $passport)
    {
        $passport->delete();
        return redirect()->route('dashboard.piem-travel.passport.index')->with('success', 'Data Passport Berhasil Di Hapus');
    }
}
