<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class CompanyController extends Controller
{

    public function index(){

        $companies = DB::table('companies')->simplePaginate(3);

        return view('company',compact('companies'));

    }


    public function store(){

        Company::create($this->validateRequest());

        return redirect(route('company.index'));

    }

    /**
     * Validating the inputs from the form
     * @return array
     */
    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|max:50|unique:App\Models\Company,name',
            'cui' => 'required|cif',
            'rc' => 'required',
            'email' => 'required|email|unique:App\Models\Company,email',
            'rl' => 'required|alpha_spaces|max:30',
            'site' => 'required|active_url',
        ]);
    }
}
