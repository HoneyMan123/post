<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Inertia\Inertia;
use Inertia\Response;
use App\Models\postAmount;
use App\Models\posts;
use Illuminate\Support\Facades\DB;
use Predis\Command\Redis\AUTH as RedisAUTH;
use DataTables;
class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */







    public function edit(Request $request): Response
    {
        return Inertia::render('Profile/Edit', [
            'mustVerifyEmail' => $request->user() instanceof MustVerifyEmail,
            'status' => session('status'),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validate([
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }
    public function posts()
    {


return Inertia::render('Profile/profile');
//return posts::all();
    }

    public function postsApi(){
        $posts = DB::table('posts')->get();
        return response()->json($posts);
    }


    public function postSubmision(Request $request){
        //variables
        $lastAmountValue = postAmount::latest()->where('email', Auth::user()->email)->value('postAmount');
$userExistance = postAmount::where('email', Auth::user()->email)->exists();
        //scripts
        if($userExistance){
            postAmount::where('email', Auth::user()->email)->increment('postAmount', 1);
            $lastAmountValue = postAmount::latest()->where('email', Auth::user()->user)->value('postAmount');
            posts::create(['email', Auth::user()->email, 'postValue' =>$request->input('inputForm'), 'postAmount' =>$lastAmountValue]);
        } else {
            postAmount::create(['email'=>Auth::user()->email]);
            postAmount::where('email', Auth::user()->email)->increment('postAmount', 1);
            posts::create(['email', Auth::user()->email, 'postValue'=>$request->input('inputForm'), 'created_at'=>DB::raw('Now()'), 'postValue'=> 1 ]);
        }
//$posts = new posts();
return redirect()->to('profile');

}
}
