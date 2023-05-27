<?php

namespace App\Http\Controllers;

use App\Models\Lead;
use Illuminate\Http\Request;

class LeadController extends Controller
{
    public function index(){
        $leads = Lead::all();
        return view('leads.index', compact('leads'));
    }
}