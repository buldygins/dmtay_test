<?php

namespace App\Http\Controllers;

use App\Http\Requests\VacancyRequest;
use App\Models\Company;
use App\Models\Vacancy;
use Illuminate\Support\Facades\Cache;

class VacancyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (Cache::has('vacancies_list')) {
            $vacancies = Cache::get('vacancies_list');
        } else {
            $vacancies = vacancy::get();
            Cache::put('vacancies_list', $vacancies, 600);
        }
        return view('vacancy.all', compact('vacancies'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('vacancy.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(VacancyRequest $request)
    {
        $company = Company::find($request->company_id);
        if ($company->canCreate()) {
            $company->vac_per_day++;
            $company->save();
            Vacancy::create($request->validated());
            return redirect()->route('vacancy.index');
        } else {
            abort(404);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param \App\Models\Vacancy $vacancy
     * @return \Illuminate\Http\Response
     */
    public function show(Vacancy $vacancy)
    {
        return view('vacancy.vacancy', compact('vacancy'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Vacancy $vacancy
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vacancy $vacancy)
    {
        $vacancy->delete();
        return redirect()->route('vacancy.index');
    }

    public function clearCache(){
        Cache::forget('vacancies_list');
        return redirect()->route('vacancy.index')->with('message', 'Кэш вакансий очищен!');
    }
}
