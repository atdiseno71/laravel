<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = [
            'Not categorized',
            'Basic Care and Comfort',
            'Health Promotion and Maintenance',
            'Management of Care',
            'Pharmacological and Parenteral Therapies',
            'Physiological Adaptation',
            'Reduction of Risk Potential',
            'Safety and Infection Control',
        ];

        return view('categories', compact('categories'));
    }
}
