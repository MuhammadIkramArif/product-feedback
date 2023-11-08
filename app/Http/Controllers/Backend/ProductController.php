<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Product;
use App\Models\Package;
use App\Models\TeamMember;
use App\Models\UserVote;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Yajra\DataTables\Facades\DataTables;

class ProductController extends Controller
{
    protected $dir = 'backend.products.';
    protected $url = 'products.';
    protected $name = 'Products';


    public function __construct()
    {
        $this->middleware('role:superuser|customer');
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
        $model = new Product();
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
            'category' => ['required', 'numeric', 'exists:categories,id'],
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
        ]);
        $model = new Product();
        $model->user_id = Auth::id();
        $model->category_id = request('category', null);
        $model->title = request('title', null);
        $model->description = request('description', null);
        $model->save();

        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' saved Successfully!');
    }

    public function commentStore(Request $request, $slug)
    {
        $modelP = Product::where('slug', $slug)->firstOrFail();

        $this->validate($request, [
            'comment' => ['required', 'string'],
        ]);
        $model = new Comment();
        $model->product_id = $modelP->id;
        $model->comment = request('comment', null);
        $model->save();

        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' saved Successfully!');
    }

    public function vote(Request $request)
    {
        $vote = $request->check;
        if ($vote == 1)
        {
            $model = new UserVote();
            $model->user_id = Auth::id();
            $model->comment_id  = $request->comment_id;
            $model->save();
        }
        else{
            $model = UserVote::where('comment_id', $request->comment_id)->where('user_id', Auth::id())->delete();
        }
        $count = UserVote::where('comment_id',$request->comment_id)->count();

        if ($model) {
            return response()
                ->json([
                    'data' => ['status' => 1, 'html' => $count]
                ]);
        } else {
            return response()
                ->json([
                    'data' => ['status' => 0, 'html' => '<div>no data</div>']
                ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        $model = Product::where('slug', $slug)->firstOrFail();

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
        $model = Product::where('slug', $slug)->firstOrFail();

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
        $model = Product::where('slug', $slug)->firstOrFail();
        $this->validate($request, [
            'title' => ['required', 'string', 'max:50'],
            'description' => ['required', 'string'],
        ]);
        $model->category_id = request('category', null);
        $model->title = request('title', null);
        $model->description = request('description', null);
        $model->save();
        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' updated Successfully!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param \App\Models\Product $Feedback
     * @return \Illuminate\Http\Response
     */
    public function destroy($slug)
    {
        $model = Product::where('slug', $slug)->firstOrFail();
        $model->delete();
        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' deleted Successfully!');
    }

    public function restore(Request $request, $slug)
    {
        $model = Product::onlyTrashed()->where('slug', $slug)->firstOrFail();
        $model->restore();

        return redirect()->route($this->url . 'index')->with('success', Str::singular($this->name) . ' restored Successfully!');
    }

    public function data()
    {
        $models = Product::with('category', 'user')->withTrashed();

        return DataTables::eloquent($models)
            ->editColumn('created_at', function (Product $model) {
                return $model->created_at->format('d M Y h:ia');
            })
            ->addColumn('status', function (Product $model) {
                return $model->trashed() ? 'InActive' : 'Active';
            })
            ->addColumn('action', function (Product $model) {
                return view($this->dir . 'actionCol', compact('model'));
            })
            ->rawColumns(['action'])
            ->toJson();
    }


}
