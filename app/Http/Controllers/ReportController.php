<?php

namespace App\Http\Controllers;

use App\Report;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Exports\MixNetAmountExport;
use App\MixNetAmount;
use Maatwebsite\Excel\Facades\Excel;


class ReportController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $reports = Report::latest()->get();

        return view('report.index',[
            'reports'=>$reports,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'filter'=>['required'],
            'name'=>['required','string','max:255'],
        ]);

        //return \Response::json($request->input('filter'),200);
        $random = Str::random(40);
        
        $nameFile = "json/".$random.".json"; 
        
        Storage::disk('public')->put($nameFile,json_encode($request->input('filter')));

        Report::create([
            'filter'=>$nameFile,
            'name'=>$request->input('name'),
        ]);

        return \Response::json("hola",200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!$report = Report::find($id)) {
            return abort(404);
        }

        Excel::store(new MixNetAmountExport(), 'tabladinamica/export.csv','public');

        $url = Storage::disk('public')->url('tabladinamica/export.csv');

        $urljson = Storage::disk('public')->url($report->filter);

        return view('report.show',[
            'urljson'=>$urljson,
            'url'=>$url,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function edit(Report $report)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Report $report)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Report  $report
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Report::find($id)->delete();

        return redirect()->route('administrator.report.index');
    }
}
