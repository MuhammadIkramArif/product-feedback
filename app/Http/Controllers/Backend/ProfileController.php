<?php

namespace App\Http\Controllers\Backend;
use App\Http\Controllers\Controller;

use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Illuminate\View\View;

class ProfileController extends Controller
{
    //protected $url = 'profile-update.';
    protected $dir = 'backend.profile.';
    protected $name = 'Profile';
    public function __construct()
    {
        $this->middleware('role:superuser|customer');
        //view()->share('url', $this->url);
        view()->share('dir', $this->dir);
        view()->share('singular', Str::singular($this->name));
        view()->share('plural', Str::plural($this->name));
    }

    public function index(): View
    {
        return view($this->dir . 'profile');
    }

    public function update(Request $request) : RedirectResponse
    {
        $model = User::find(auth()->user()->id);

        if ($request->hasFile('picture')) {
            $dims = getimagesize($request->picture);
            $width = $dims[0];
            $height = $dims[1];
            $name = time() . '-' . $width . '-' . $height . '.' . $request->file('picture')->extension();
            $path = public_path('uploads/users/');
            $file = $request->file('picture');
            if ($file->move($path, $name)) {
                $model->picture = $name;
            }
        }
        $model->name = request('name', 'null');
        $model->email = request('email', 'null');
        $model->save();

        return redirect()->route('profile')->with('success', Str::singular($this->name) . ' updated Successfully!');
    }
    public function change_password(Request $request)
    {
        $this->validate($request,[
            'old_password' => ['required'],
            'password' => ['required'],
            'password_confirmation' => ['same:password'],
        ]);
        //$data = $request->all();
        $user = User::find(auth()->user()->id);
        if (!(Hash::check($request->get('old_password'), $user->password))) {
            return redirect()->back()->with('error', 'You have entered wrong old password!');
        }

        else
        {
            User::find(auth()->user()->id)->update(['password' => Hash::make($request->password)]);
            return redirect()->route('profile')->with('success', Str::singular($this->name) . 'Password updated Successfully!');
        }
        //dd('Password change successfully.');

    }




}
