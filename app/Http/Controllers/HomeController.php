<?php

namespace App\Http\Controllers;

use App\Exports\MixNetAmountExport;
use App\MixNetAmount;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        Excel::store(new MixNetAmountExport(), 'tabladinamica/export.csv','public');

        $url = Storage::disk('public')->url('tabladinamica/export.csv');

        return view('home',[
            'url'=>$url,
        ]);
    }
}
