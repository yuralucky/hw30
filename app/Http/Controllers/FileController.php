<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Storage;

class FileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $url = '';
        return view('index', compact('url'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return Response
     */
    public function store(Request $request)
    {
        Storage::disk('google')->putFileAs('/files', $request->file('file'), $request->file('file')->getClientOriginalName(), 'public');
        $url = Storage::disk('public')->url('/files/' . $request->file('file')->getClientOriginalName());
        return view('index', compact('url'));
    }


}
