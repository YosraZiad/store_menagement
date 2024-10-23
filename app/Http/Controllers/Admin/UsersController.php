<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Admin\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;

use App\Models\UserProfile;
use App\Models\Country;
use App\Models\User;

use Illuminate\Database\QueryException;

class UsersController extends Controller
{
    //

    public function index () {

        $users = User::with('profile')->get();
       
        $vars = [
            'countries'=>Country::all(),
            'users'=>$users
        ];
        return view ('CP.users.all', $vars);
    }

    /**
     * <b>User Controller Create Method</b>
     * @return [User]
     */
    public function create () {
        $vars = [
            'countries'=> Country::all()];
        return view ('CP.users.create', $vars);
    }

        /**
     * <b>User Controller Invert Status Method</b>
     * @return [User]
     */
    public function status ($id) {
        $user = User::find($id);
        $user->status = !$user->status;
        try {
            $user->update();
            return redirect()->back()->with(['success','User Satus has been updated']);
        } catch(QueryException $err) {
            return redirect()->back()->with(['error','User Satus update falied due to: '.$err]);
        }
    }

        /** 
     * <b>User Controller Create Method</b>
     * @return [User]
     */
    public function store (Request $req) {
        try {
            $user = new User();
            $user->name         = $req->name;
            $user->email        = $req->email;
            $user->password     = Hash::make($req->password);
            $user->save();
            
            $profile = new UserProfile();
            $profile->first_name    = $req->first_name ? $req->first_name : '';
            $profile->last_name     = $req->last_name ? $req->last_name : '';
            $profile->phone         = $req->phone ? $req->phone : '';
            $profile->gender        = $req->gender ? $req->gender : 1;
            $profile->position      = $req->position ? $req->position : '';
            $profile->address       = $req->address ? json_encode($req->address) : json_encode([]);
            $profile->image         = $req->image ? $req->image : 'default.user.profile.png';
            $profile->user_id       = $user->id;
            $profile->save();
            
            return redirect() ->back()->with(['success'=>'User Added Successfully']);
            
        } catch(\Exception $err){   
            return redirect() ->back()->with(['error'=>'CP.users.all'. $err]);
        }
        
    }
    public function destroy (String $id) {
        $user = User::find($id);
        $user->delete();
        $profile = UserProfile::where(['user_id'=>$id])->first();
        if (null != $profile) {
            $profile->delete();
        }
        return redirect() ->back()->with(['success'=>'User Deleted Successfully']);
    }

}