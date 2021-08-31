<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DataTables;

class AdminController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin');
    }

    public function index(){
        $batteries = \DB::table("batteries")->sum("number");
        $batteries_in_use = \DB::table("batteries")->sum("in_use");
        $users = \DB::table("users")->where("role", 0)->count();
        return view('admin.home', ["batteries"=>$batteries, "batteries_in_use"=>$batteries_in_use,
            "users"=>$users]);
    }

    public function assignments(){
        return view('admin.assignments');
    }

    public function searchUsers(Request $request){
        return json_encode(\DB::table("users")->select("users.id", "users.firstname", "users.lastname", "users.email")
        ->where("firstname", "LIKE", "%".$request->search."%")->orWhere("lastname", "LIKE", "%".$request->search."%")
        ->orWhere("email", "LIKE", "%".$request->search."%")
        ->skip(0)->take(5)->get());
    }

    public function searchModel(Request $request){
        return json_encode(\DB::table("batteries")->where("name", "LIKE", "%".$request->search."%")
        ->orWhere("model", "LIKE", "%".$request->search."%")
        ->skip(0)->take(5)->get());
    }
    public function searchStations(Request $request){
        return json_encode(\DB::table("stations")->where("name", "LIKE", "%".$request->search."%")
        ->orWhere("location", "LIKE", "%".$request->search."%")
        ->skip(0)->take(5)->get());
    }

    public function getAssignments(Request $request){
        return Datatables::of(\DB::table('assignments')->select("assignments.*", 'users.firstname', 'users.lastname',
        'users.email', 'batteries.name as bname', 'batteries.model', 'stations.name', 'stations.location')->join("users", "users.id", "assignments.user_id")
        ->join("batteries", "batteries.id", "assignments.battery_id")->join("stations", "stations.id",
        "assignments.station_id")
        )->filter(function($query) use ($request){
            $query->where('batteries.name', 'LIKE', '%'.$request->search.'%')
            ->where('batteries.model', 'LIKE', '%'.$request->search.'%')
            ->where('stations.name', 'LIKE', '%'.$request->search.'%')
            ->where('stations.location', 'LIKE', '%'.$request->search.'%')
            ->where('users.firstname', 'LIKE', '%'.$request->search.'%')
            ->where('users.lastname', 'LIKE', '%'.$request->search.'%')
            ->where('users.email', 'LIKE', '%'.$request->search.'%');
        })->addColumn('user', function($item){
            return $item->firstname." ".$item->lastname;
        })->addColumn('battery', function($item){
            return $item->bname." (".$item->model.")";
        })->addColumn('station', function($item){
            return $item->name." (".$item->location.")";
        })->addColumn('status', function($item){
            return $item->status?"Returned":"In Use";
        })->addColumn('created_at', function($item){
            return \Carbon\Carbon::parse($item->created_at)->diffForHumans();
        })->addColumn('action', function($item){
            return "<div class='text-right'>
                <span class='d-none id'>".$item->id."</span>
                <span class='d-none user_id'>".$item->user_id."</span>
                <span class='d-none battery_id'>".$item->battery_id."</span>
                <span class='d-none station_id'>".$item->station_id."</span>
                <span class='d-none status'>".$item->status."</span>
                <button class='btn btn-primary btn-sm btn-edit'><i class='fas fa-edit pr-1'></i> <span>Edit</span></button>
            </div>";
        })->escapeColumns([])->make();
    }

    public function addAssignment(Request $request){
        $request->validate([
            'id'=>'required|min:0|integer',
            'battery_id'=>'required|integer|min:1',
            'station_id'=>'required|integer|min:1',
            'user_id'=>'required|integer|min:1',
            'r_level'=>'required|integer|min:0|max:100',
            'p_level'=>'required|integer|min:1|max:100',
            'status'=>'required|integer|min:0|max:1',
        ]);
        if(\DB::table('assignments')->where('status', 0)->where('id', '<>', $request->id)->where('user_id', $request->user_id)
        ->count() > 0){
            return back()->with('error', 'User has a non-returned battery!');
        }else{
            if($request->id >0){
                if(\DB::table('assignments')->where('id', $request->id)->update(['user_id'=>$request->user_id,
                'station_id'=>$request->station_id, 'status'=>$request->status, 'pickup_level'=>$request->p_level,
                "battery_id"=>$request->battery_id, 'return_level'=>$request->r_level, 'updated_at'=>\Carbon\Carbon::now()])){
                    return back()->with('success', 'Battery assignment Updated');
                }else{
                    return back()->with('error', 'Unable to update battery assignment');
                }
            }else{
                if(\DB::table('assignments')->insert(['user_id'=>$request->user_id,'station_id'=>$request->station_id,
                'status'=>$request->status, 'pickup_level'=>$request->p_level,'return_level'=>$request->r_level,
                "battery_id"=>$request->battery_id, 'created_at'=>\Carbon\Carbon::now()])){
                    return back()->with('success', 'Battery Assigned');
                }else{
                    return back()->with('error', 'Unable to assign battery');
                }
            }
        }
    }
    public function batteries(){
        return view('admin.batteries');
    }

    public function getBatteries(Request $request){
        return Datatables::of(\DB::table('batteries'))
        ->filter(function($query) use ($request){
            $query->where('batteries.name', 'LIKE', '%'.$request->search.'%')
            ->where('batteries.model', 'LIKE', '%'.$request->search.'%');
        })->addColumn('created_at', function($item){
            return \Carbon\Carbon::parse($item->created_at)->diffForHumans();
        })->addColumn('action', function($item){
            return "<div class='text-right'>
                <span class='d-none id'>".$item->id."</span>
                <button class='btn btn-primary btn-sm btn-edit'><i class='fas fa-edit pr-1'></i> <span>Edit</span></button>
                <a href='".url("admin/batteries/remove/".$item->id)."' class='btn btn-danger btn-sm'><i class='fas fa-trash pr-1'></i> <span>Delete</span></a>
            </div>";
        })->escapeColumns([])->make();
    }

    public function addBattery(Request $request){
        $request->validate([
            'id'=>'required|min:0|integer',
            'name'=>'required|string',
            'model'=>'required|string',
            'totals'=>'required|integer|min:1',
        ]);
        if(\DB::table('batteries')->where('model', $request->model)->where('id', '<>', $request->id)->count() > 0){
            return back()->with('error', 'Model already exists!');
        }else{
            if($request->id >0){
                if(\DB::table('batteries')->where('id', $request->id)->update(['name'=>$request->name,
                'model'=>$request->model, 'number'=>$request->totals, 'updated_at'=>\Carbon\Carbon::now()])){
                    return back()->with('success', 'Battery updated');
                }else{
                    return back()->with('error', 'Unable to update battery');
                }
            }else{
                if(\DB::table('batteries')->insert(['name'=>$request->name, 'model'=>$request->model,
                'number'=>$request->totals, 'in_use'=>0, 'created_at'=>\Carbon\Carbon::now()])){
                    return back()->with('success', 'Battery added');
                }else{
                    return back()->with('error', 'Unable to add battery');
                }
            }
        }
    }

    public function removeBattery(Request $request){
        if(\DB::table("assignments")->where("battery_id", $request->id)->count() == 0){
            if(\DB::table("batteries")->where("id", $request->id)->delete()){
                return back()->with("success", "Battery removed successfully!");
            }else{
                return back()->with("error", "Unable tot remove battery!");
            }
        }else{
            return back()->with("error", "Battery already in use!");
        }
    }

    public function users(){
        return view('admin.users');
    }

    public function getUsers(Request $request){
        return Datatables::of(\DB::table('users'))
        ->filter(function($query)use($request){
            $query->where('firstname', 'LIKE', '%'.$request->search.'%')
            ->orWhere('lastname', 'LIKE', '%'.$request->search.'%')
            ->orWhere('users.email', 'LIKE', '%'.$request->search.'%');
        })->addColumn('created_at', function($item){
            return \Carbon\Carbon::parse($item->created_at)->diffForHumans();
        })->addColumn('user', function($item){
            return $item->firstname.' '.$item->lastname;
        })->addColumn('role', function($item){
            return $item->role==1?'ADMIN':'USER';
        })->addColumn('status', function($item){
            return $item->status?'<span class="badge badge-success">Active</strong>':'<strong class="badge badge-danger">In-Active</strong>';
        })/*->addColumn('action', function($item){
            $div = "<div class='text-right'>";
            if($item->role == 1)
                $div .="<button class='btn btn-primary btn-sm btn-assign' data-id='".$item->id."' data-toggle='modal' data-target='#vehicleModal'><i class='fas fa-plus pr-1'></i> <span>Assign</span></button>";
            return $div."</div>";
        })*/->escapeColumns([])->make();
    }

    public function stations(){
        return view('admin.stations');
    }

    public function getStations(Request $request){
        return Datatables::of(\DB::table('stations')->orderBy('name', 'ASC'))
        ->filter(function($query) use ($request){
            $query->where('name', "LIKE", "%".$request->search."%")
            ->orWhere("location", "LIKE", "%".$request->search."%");
        })->addColumn('created_at', function($item){
            return \Carbon\Carbon::parse($item->created_at)->diffForHumans();
        })->addColumn('action', function($item){
            return "<div class='text-right'>
                        <span class='d-none id'>".$item->id."</span>
                        <button class='btn btn-primary btn-sm btn-edit'>
                            <i class='fas fa-edit pr-1'></i> <span>Edit</span>
                        </button>
                        <a href='".url("admin/stations/remove/".$item->id)."' class='btn btn-danger btn-sm'>
                            <i class='fas fa-trash pr-1'></i> <span>Delete</span>
                        </a>
                    </div>";
        })->escapeColumns([])->make();
    }

    public function addStation(Request $request){
        $request->validate([
            'id'=>'required|min:0|integer',
            'name'=>'required|string',
            'location'=>'required|string',
        ]);
        if(\DB::table('stations')->where('name', $request->name)->where('id', '<>', $request->id)->count() > 0){
            return back()->with('error', 'Station already exists!');
        }else{
            if($request->id >0){
                if(\DB::table('stations')->where('id', $request->id)->update(['name'=>$request->name,
                'location'=>$request->location, 'updated_at'=>\Carbon\Carbon::now()])){
                    return back()->with('success', 'Station Updated successfully');
                }else{
                    return back()->with('error', 'Unable to update station');
                }
            }else{
                if(\DB::table('stations')->insert(['name'=>$request->name,
                'location'=>$request->location, 'created_at'=>\Carbon\Carbon::now()])){
                    return back()->with('success', 'Station added successfully');
                }else{
                    return back()->with('error', 'Unable to add station');
                }
            }
        }
    }

    public function removeStation(Request $request){
        if(\DB::table("assignments")->where("station_id", $request->id)->count() == 0){
            if(\DB::table("stations")->where("id", $request->id)->delete()){
                return back()->with("success", "Station removed successfully!");
            }else{
                return back()->with("error", "Unable to remove Station!");
            }
        }else{
            return back()->with("error", "Station already in use!");
        }
    }
    public function pricing(){
        return view('admin.pricing');
    }
    public function profile(){
        return view('admin.profile');
    }
}
