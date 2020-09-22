<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Requests\CompanyRequest;
use App\Models\Company;
use Spatie\QueryBuilder\QueryBuilder;

class CompanyAjaxController extends Controller
{

  public function index()
  {
    return view('project.company.index_company')->with('companies', Company::paginate(15));
  }

  public function search()
  {
    /*
       here if id equals 1 and there are 20 companies this query will return company which contains 1
       but if you want filter with given exact id do this...
       =================================
       $compnay = Query::for(Company::class)
        ->allowedFilters(AllowedFilter::exact('id'))
        ->get();
       */
    $companies = QueryBuilder::for(Company::class)
      ->allowedFilters(['id', 'name', 'email', 'phone'])
      ->get();
    $getSection = view('project.company.search-company')
      ->with('companies', $companies)
      ->renderSections();
    return response()
      ->json(['companies' => $getSection]);
  }

  public function create()
  {
    return view('project.company.create_company');
  }

  public function store()
  {
  }

  public function edit($id)
  {
    $company = Company::findOrFail($id);
    return view('project.company.edit_company', compact('company'));
  }

  public function update(CompanyRequest $request, $id)
  {
    $company = Company::findOrFail($id);
    $company->fill($request->validated())->save();
    return response()->json(['status' => true]);
  }

  public function destroy()
  {
    Company::findOrFail(request()->get('searchCompany'))->delete();
    return response()
      ->json(['status' => true]);
  }
}
