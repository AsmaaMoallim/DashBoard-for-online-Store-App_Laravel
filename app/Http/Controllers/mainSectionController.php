<?php

namespace App\Http\Controllers;

use App\Models\MainSection;
use App\Models\MediaLibrary;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class mainSectionController extends Controller
{
    public function index()
    {
        $pagename = "الاقسام الرئيسية";

        $formPage = "new-maninSection-form";
        $addNew = "إضافة قسم رئيسي جديد";
        $tables = 'main_sections';
        $qry = \DB::table('main_sections')
            ->join('media_library','main_sections.medl_id','=','media_library.medl_id')
            ->select('main_name AS اسم القسم الرئيسي','medl_img_ved AS الصورة','main_sections.state','main_sections.fakeId')
            ->get();
        $columns = ['اسم القسم الرئيسي','الصورة','fakeId'];

        return view('master_tables_view',['pagename' => $pagename])->with('rows',$qry)->with
        ('columns', $columns)->with('tables',$tables)->with('addNew',$addNew)->with
        ('formPage',$formPage);
    }

    public function insertData(){
        return view('new-maninSection-form');
    }

    public function enableordisable($id)
    {
        $data = MainSection::where("fakeId","=","$id")->first();
        if($data->state==false){
            $data->state=true;
            $data->save();
        }
        else{
            $data->state= false;
            $data->save();
        }
        return redirect()->back();
    }


    public function delete($id)
    {
        $data = MainSection::where("fakeId","=","$id")->first();
        $data->delete();
        return redirect()->back();
    }

    function store(Request $request)
    {
        $mainSection = new MainSection();
        $mainSection->main_name = $request->main_name;
        $mainSection->medl_id = $request->medl_id;
        $max = MainSection::orderBy("fakeId", 'desc')->first(); // gets the whole row
        $maxFakeId = $max? $max->fakeId + 1 : 1;
        $mainSection->fakeId =$maxFakeId;
        $mainSection->save();
        return redirect('/main_Sections');
    }

    public function update(Request $request, MainSection $mainSection, $id)
    {
        $currentValues = MainSection::where("fakeId","=","$id")->first();

        $currentforeignValues = MediaLibrary::find($currentValues->medl_id);
        return view('new-maninSection-form')->with('currentValues', $currentValues)
            ->with('id', $id)->with('currentforeignValues',$currentforeignValues);

    }

    public function store_update(Request $request, $id){
        $data = MainSection::where("fakeId","=","$id")->first();
        $data->update($request->all());
        return redirect('/main_Sections');
    }

}
