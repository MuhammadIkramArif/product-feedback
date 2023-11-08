<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Package;
use App\Models\TeamMember;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class CategoryController extends Controller
{
    protected $dir = 'backend.categories.';
    protected $url = 'categories.';
    protected $name = 'Categories';


    public function __construct()
    {
        $this->middleware('role:superuser');
        view()->share('url', $this->url);
        view()->share('dir', $this->dir);
        view()->share('singular', Str::singular($this->name));
        view()->share('plural', Str::plural($this->name));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view($this->dir . 'index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $model = new Category();
        return view($this->dir . 'create', compact('model'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50'],
        ]);
        $model = new Category();
        $model->name = request('name', null);
        $model->save();

        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' saved Successfully!');
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $model = Category::where('slug', $slug)->firstOrFail();

        return view($this->dir . 'show', compact('model'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $model = Category::where('slug', $slug)->firstOrFail();

        return view($this->dir . 'edit', compact('model'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $slug)
    {
        $model = Category::where('slug', $slug)->firstOrFail();
        $this->validate($request, [
            'name' => ['required', 'string', 'max:50'],
        ]);

        $model->name = request('name', null);
        $model->save();
        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Category $Category
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $model = Category::where('slug', $slug)->firstOrFail();
        $model->delete();
        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' deleted Successfully!');
    }

    public function restore(Request $request, $slug)
    {
        $model = Category::onlyTrashed()->where('slug', $slug)->firstOrFail();
        $model->restore();

        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' restored Successfully!');
    }

    public function data()
    {
        $models = Category::withTrashed();

        return DataTables::eloquent($models)
            ->editColumn('created_at', function (Category $model) {
                return $model->created_at->format('d M Y h:ia');
            })
            ->addColumn('status', function (Category $model) {
                return $model->trashed() ? 'InActive' : 'Active';
            })
            ->addColumn('action', function (Category $model) {
                return view($this->dir . 'actionCol', compact('model'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }


}
