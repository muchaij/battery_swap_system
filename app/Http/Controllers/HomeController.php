<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use DataTables;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        if(\Auth::user()->role == 1){
            return redirect()->to('/admin/home');
        }
        return view('users.home');
    }

    public function getAssignments(Request $request){
        return Datatables::of(\DB::table('assignments')->select("assignments.*", 'batteries.name as bname',
        'batteries.model', 'stations.name', 'stations.location')->join("batteries", "batteries.id",
        "assignments.battery_id")->join("stations", "stations.id","assignments.station_id")
        )->filter(function($query) use ($request){
            $query->where(function($q) use($request){
                $q->where('batteries.name', 'LIKE', '%'.$request->search.'%')
                ->where('batteries.model', 'LIKE', '%'.$request->search.'%')
                ->where('stations.name', 'LIKE', '%'.$request->search.'%')
                ->where('stations.location', 'LIKE', '%'.$request->search.'%');
            })->where('user_id', \Auth::user()->id);
        })->addColumn('battery', function($item){
            return $item->bname." (".$item->model.")";
        })->addColumn('station', function($item){
            return $item->name." (".$item->location.")";
        })->addColumn('status', function($item){
            return $item->status?"Returned":"In Use";
        })->addColumn('created_at', function($item){
            return \Carbon\Carbon::parse($item->created_at)->diffForHumans();
        })->escapeColumns([])->make();
    }

    public function profile(){
        return view('users.profile');
    }

    public function changeProfile(Request $request){
        $request->validate([
            "password"=>"required",
            "firstname"=>"required|string",
            "lastname"=>"required|string",
            "email"=>"required|email",
            "phone"=>"required",
        ]);
        if(User::where("id", \Auth::user()->id)->where("password", \Hash::make($request->password))){
            if(strlen($request->new_password) > 0){
                //change password
                if($request->new_password == $request->confirm_password){
                    //password match
                    if(User::where("id", \Auth::user()->id)->update(["firstname"=>$request->firstname,"lastname"=>$request->lastname, "password"=>\Hash::make($request->new_password)])){
                        $id = \Auth::user()->id;
                        \Auth::loginUsingId($id);
                        return back()->with("success", "Profile updated successfully!");
                    }else{
                        return back()->with("error", "Unable to update profile!");
                    }

                }else{
                    return back()->with("error", "Your new passwords do not match");
                }
            }else{
                //just update name
                if(User::where("id", \Auth::user()->id)->update(["firstname"=>$request->firstname,"lastname"=>$request->lastname])){
                    $id = \Auth::user()->id;
                    \Auth::loginUsingId($id);
                    return back()->with("success", "Profile updated successfully!");
                }else{
                    return back()->with("error", "Unable to update profile!");
                }
            }
        }else{
            return back()->with("error", "The current password is incorrect!");
        }
    }
}
