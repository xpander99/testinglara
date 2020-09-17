<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Company;

class CompanyController extends Controller
{

    public function index(){

        return view('company');

    }


    public function store(){

        Company::create($this->validateRequest());

        return redirect('/company');

    }

    /**
     * Validating the inputs from the form
     * @return array
     */
    private function validateRequest()
    {
        return request()->validate([
            'name' => 'required|max:50',
            'cui' => 'required|integer|digits_between:2,10',
            'rc' => 'required',
            'email' => 'required|email',
            'rl' => 'required|alpha_spaces|max:30',
            'site' => 'required',
        ]);
    }
}
