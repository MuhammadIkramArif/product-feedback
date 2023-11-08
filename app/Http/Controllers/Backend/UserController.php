<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class UserController extends Controller
{
    protected $dir = 'backend.users.';
    protected $url = 'users.';
    protected $name = 'Users';


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
        $model = new User();
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
        $model = new User();
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
        $model = User::where('slug', $slug)->firstOrFail();

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
        $model = User::where('slug', $slug)->firstOrFail();

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
        $model = User::where('slug', $slug)->firstOrFail();
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
    public function destroy($id)
    {
        $model = User::where('id', $id)->firstOrFail();
        $model->delete();
        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' deleted Successfully!');
    }
    public function restore(Request $request, $id)
    {
        $model = User::onlyTrashed()->where('id', $id)->firstOrFail();
        $model->restore();

        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' restored Successfully!');
    }

    public function data()
    {
        $models = User::withTrashed();

        return DataTables::eloquent($models)
            ->editColumn('created_at', function (User $model) {
                return $model->created_at->format('d M Y h:ia');
            })
            ->addColumn('status', function (User $model) {
                return $model->trashed() ? 'InActive' : 'Active';
            })
            ->addColumn('action', function (User $model) {
                return view($this->dir . 'actionCol', compact('model'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }


}
