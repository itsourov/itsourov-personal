<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Livewire\WithFileUploads;

class SettingController extends Controller
{
    use WithFileUploads;
    public function index()
    {
        return view('admin.settings.index');
    }


}