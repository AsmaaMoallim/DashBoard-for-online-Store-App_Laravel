<?php

namespace App\Http\Controllers;

use App\Models\Permission;
use App\Models\PosInclude;
use App\Models\Position;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class positions_permissionsController extends Controller
{
    public function index(Position $position)
    {
        $this->authorize('view', $position);

        $pagename = "الصلاحيات والمنصاب";
        $formPage = "new-position-form";
        $addNew = "إضافة منصب جديد";
        $tables = 'positions_permissions';

        $qry = \DB::table('position')
            ->join('pos_include','pos_include.pos_id','=','position.pos_id')
            ->join('permission','permission.per_id','=','pos_include.per_id')
            ->select('pos_name AS اسم المنصب',\DB::raw("GROUP_CONCAT('\r\n' , permission.per_name, '\r\n' SEPARATOR ' //  ') AS الصلاحيات"),'position.state','position.fakeId')
            ->groupBy('اسم المنصب','position.state', 'position.fakeId')
            ->get();
        $columns = ['اسم المنصب','الصلاحيات','fakeId'];

        return view('master_tables_view',['pagename' => $pagename])->with('rows', $qry)->with
        ('columns', $columns)->with('tables', $tables)->with('addNew', $addNew)->with
        ('formPage', $formPage);
    }

    public function insertData(Position $position)
    {
        $this->authorize('view', $position);

        $permission = Permission::all();
        return view('new-position-form', ['permissions' => $permission]);
    }

    public function enableordisable($id,Position $position)
    {
        $this->authorize('view', $position);

        $data = Position::where("fakeId","=","$id")->first();

        if ($data->state == false) {
            $data->state = true;
            $data->save();
        } else {
            $data->state = false;
            $data->save();
        }
        return redirect()->back();

    }

    public function delete($id,Position $position)
    {
        $this->authorize('view', $position);

        $data = Position::where("fakeId","=","$id")->first();
        $data->delete();
        return redirect()->back();
    }

    public function update(Request $request, Position $position, $id)
    {
        $this->authorize('view', $position);

        $currentValues = Position::where("fakeId","=","$id")->first();
//        dd($currentValues->pos_id);
        $permissions = Permission::all();
//        dd(Permission::max("fakeId"));
        $currentPermissions = PosInclude::all()->where("pos_id", "=", "$currentValues->pos_id");
//        dd($currentPermissions);
//        $CurrentPermission = PosInclude::all("pos_id")->where($currentValues)->get("per_id");
//        dd($CurrentPermission);
//        $per = $CurrentPermission->pos_id;
//        dd($per);
        return view('new-position-form', ['permissions' => $permissions , 'currentPermissions' => $currentPermissions])->with('currentValues', $currentValues)
            ->with('id', $id);

//        $data->ManagerName=$request->ManagerName;
//        $data->ManagerPhone=$request->ManagerPhone;
//        $data->ManagerRole=$request->ManagerRole;
//        $data->ManagerEmail=$request->ManagerEmail;
//        $data->ManagerPassword=$request->ManagerPassword;
//        $data->save();
//        dd($currentValuues);

    }

    public function store(Request $request,Position $position)
    {
        $this->authorize('view', $position);

        $position = new Position();
        $position->pos_name = $request->pos_name;
        $max = Position::orderBy("fakeId", 'desc')->first(); // gets the whole row
        $maxFakeIdPos= $max? $max->fakeId + 1 : 1;
        $position->fakeId = $maxFakeIdPos;
        $position->save();

        $per_id = $request->input('per_id');
        foreach ($per_id as $per_id) {
            $maxFakeIdPosIN = 0;
            $posInclude = new PosInclude();
            $posInclude->pos_id = $position->pos_id;
            $max = PosInclude::orderBy("fakeId", 'desc')->first(); // gets the whole row
            $maxFakeIdPosIN = $max? $max->fakeId + 1 : 1;
            $posInclude->fakeId = $maxFakeIdPosIN;
            $posInclude->per_id = $per_id;
            $posInclude->save();
        }

        return redirect('/positions_permissions');
    }

    public function store_update(Request $request, $id,Position $position){

        $this->authorize('view', $position);

        $data = Position::where("fakeId","=","$id")->first();
        $per_id = $request->input('per_id');

        $all_perId = Permission::all("per_id");

        foreach($all_perId as $all_perId){

                if(PosInclude::where("pos_id", "=", "$data->pos_id")->where("per_id","=","$all_perId->per_id")->first() != null)
                {
                    PosInclude::where("pos_id", "=", "$data->pos_id")->where("per_id","=","$all_perId->per_id")->delete();
                }

        }

        $per_id2 = $request->input('per_id');
        foreach ($per_id2 as $per_id2) {
            $maxFakeIdPosIN = 0;
            $posInclude = new PosInclude();
            $posInclude->pos_id = $data->pos_id;
            $max = PosInclude::orderBy("fakeId", 'desc')->first(); // gets the whole row
            $maxFakeIdPosIN = $max? $max->fakeId + 1 : 1;
            $posInclude->fakeId = $maxFakeIdPosIN;
            $posInclude->per_id = $per_id2;
            $posInclude->save();
        }
        $data->update($request->all());

        return redirect('/positions_permissions');
    }


    public function search(Request $request,Position $position){
        $this->authorize('view', $position);

        $key = trim($request->get('search'));


        $pagename = "الصلاحيات والمنصاب";
        $formPage = "new-position-form";
        $addNew = "إضافة منصب جديد";
        $tables = 'positions_permissions';

        $qry = \DB::table('position')
            ->join('pos_include','pos_include.pos_id','=','position.pos_id')
            ->join('permission','permission.per_id','=','pos_include.per_id')
            ->select('pos_name AS اسم المنصب',\DB::raw("GROUP_CONCAT('\r\n' , permission.per_name, '\r\n' SEPARATOR ' //  ') AS الصلاحيات"),'position.state','position.fakeId')
            ->groupBy('اسم المنصب','position.state', 'position.fakeId')
            ->Where('pos_name', 'LIKE', "%{$key}%")
            ->orWhere('per_name', 'LIKE', "%{$key}%")
            ->get();
        $col = ['اسم المنصب','الصلاحيات','fakeId'];



//            dd($_GET['btnSearch']);
        if (isset($_GET['btnSearch']) && $qry->isEmpty()){
            $qry = \DB::table('position')
                ->join('pos_include','pos_include.pos_id','=','position.pos_id')
                ->join('permission','permission.per_id','=','pos_include.per_id')
                ->select('pos_name AS اسم المنصب',\DB::raw("GROUP_CONCAT('\r\n' , permission.per_name, '\r\n' SEPARATOR ' //  ') AS الصلاحيات"),'position.state','position.fakeId')
                ->groupBy('اسم المنصب','position.state', 'position.fakeId')
                ->get();
            $col = ['اسم المنصب','الصلاحيات','fakeId'];

            $placeHolder = "لا توجد نتائج";
        } elseif (isset($_GET['btnCancel'])){
            $qry = \DB::table('position')
                ->join('pos_include','pos_include.pos_id','=','position.pos_id')
                ->join('permission','permission.per_id','=','pos_include.per_id')
                ->select('pos_name AS اسم المنصب',\DB::raw("GROUP_CONCAT('\r\n' , permission.per_name, '\r\n' SEPARATOR ' //  ') AS الصلاحيات"),'position.state','position.fakeId')
                ->groupBy('اسم المنصب','position.state', 'position.fakeId')
                ->get();
            $col = ['اسم المنصب','الصلاحيات','fakeId'];

            $placeHolder = 'Search';
        }
        else{
            $placeHolder = 'Search';
        }

        return view('master_tables_view' ,['pagename' => $pagename, 'placeHolder'=> $placeHolder])->with('rows',$qry)->with
        ('columns', $col)->with('tables',$tables)->with('addNew',$addNew)->with
        ('formPage',$formPage)->with('key', $key);

    }

}
