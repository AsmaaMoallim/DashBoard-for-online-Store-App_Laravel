<?php

namespace App\Http\Controllers;

use App\Models\MainSection;
use App\Models\MediaLibrary;
use App\Models\SubSection;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class subSectionController extends Controller
{
    public function index(SubSection $subSection)
    {
        $this->authorize('view', $subSection);

        $pagename = "الاقسام الفرعية";
        $formPage = "new-subSection-form";
        $addNew = "إضافة قسم فرعي جديد";
        $tables = 'sub_sections';

        $qry = \DB::table('sub_section')
            ->join('media_library', 'sub_section.medl_id', '=', 'media_library.medl_id')
            ->join('main_sections','sub_section.main_id','=','main_sections.main_id')
            ->select('sub_section.medl_id','sub_name AS اسم القسم الفرعي' ,'main_name AS اسم القسم الرئيسي', 'sub_section.state','sub_section.fakeId')
            ->get();

        $columns= ['اسم القسم الفرعي','الصورة','اسم القسم الرئيسي','fakeId'];

        return view('master_tables_view',['pagename' => $pagename])->with('rows',$qry)->with
        ('columns', $columns)->with('tables',$tables)->with('addNew',$addNew)->with
        ('formPage',$formPage);
    }

    public function enableordisable($id , SubSection $subSection)
    {
        $this->authorize('view', $subSection);

        $data = SubSection::where("fakeId","=","$id")->first();
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

    public function insertData(SubSection $subSection){
        $this->authorize('view', $subSection);

        $mainSection = MainSection::all();
        $mediaLibrary = MediaLibrary::all();
        return view('new-subSection-form', ['mainSections' => $mainSection])->with( compact('mediaLibrary'));;
    }

    public function delete($id, SubSection $subSection)
    {
        $this->authorize('view', $subSection);

        $data = SubSection::where("fakeId","=","$id")->first();
        $data->delete();
        return redirect()->back();
    }
    public function fetch_image($id, $medl_id = null,SubSection $subSection)
    {
        $this->authorize('view', $subSection);

        if ($medl_id){
            $image = MediaLibrary::findOrFail($medl_id);
            $image_file = Image::make($image->medl_img_ved)->resize(60, 60);
            $response = Response::make($image_file->encode('jpeg'));
            $response->header('Content-Type', 'image/jpeg');
            return $response;
        }
        else{
            $image = MediaLibrary::findOrFail($id);
            $image_file = Image::make($image->medl_img_ved)->resize(60, 60);
            $response = Response::make($image_file->encode('jpeg'));
            $response->header('Content-Type', 'image/jpeg');
            return $response;
        }

    }

    function store(Request $request,SubSection $subSection)
    {
        $this->authorize('view', $subSection);

//        dd($request);

        $sub_section = new SubSection();
        $sub_section->sub_name = $request->sub_name;
        $sub_section->main_id = $request->main_id;
        $sub_section->medl_id = $request->medl_id;
        $max = SubSection::orderBy("fakeId", 'desc')->first(); // gets the whole row
        $maxFakeId = $max? $max->fakeId + 1 : 1;
        $sub_section->fakeId =$maxFakeId;
        $sub_section->save();
        return redirect('/sub_sections');
    }

    public function update(Request $request, SubSection $subSection, $id)
    {
        $this->authorize('view', $subSection);

        $mainSection = MainSection::all();
        $currentValues = SubSection::where("fakeId","=","$id")->first();;
        $CurrentmainSection = MainSection::find($currentValues->main_id);
//        $currentforeignValues = MediaLibrary::find($currentValues->medl_id);

        $currentforeignValues = MediaLibrary::find($currentValues->medl_id);
        $mediaLibrary = MediaLibrary::all();
        $currentMedias = MediaLibrary::all()
            ->where("medl_id","=","$currentValues->medl_id");

        return view('new-subSection-form',  ['CurrentmainSection' => $CurrentmainSection, 'mainSections' => $mainSection])->with('currentValues', $currentValues)
            ->with('id', $id)->with('currentforeignValues',$currentforeignValues)->with('mediaLibrary',$mediaLibrary)->with('currentMedias',$currentMedias);

    }

    public function store_update(Request $request, $id,SubSection $subSection){
        $this->authorize('view', $subSection);

        $data = SubSection::where("fakeId","=","$id")->first();
        $data->update($request->all());
        return redirect('/sub_sections');
    }

    public function search(Request $request,SubSection $subSection){
        $this->authorize('view', $subSection);

        $key = trim($request->get('search'));

        $pagename = "الاقسام الفرعية";
        $formPage = "new-subSection-form";
        $addNew = "إضافة قسم فرعي جديد";
        $tables = 'sub_sections';

        $qry = \DB::table('sub_section')
            ->join('media_library', 'sub_section.medl_id', '=', 'media_library.medl_id')
            ->join('main_sections','sub_section.main_id','=','main_sections.main_id')
            ->select('sub_name AS اسم القسم الفرعي' , 'medl_img_ved AS الصورة','main_name AS اسم القسم الرئيسي', 'sub_section.state','sub_section.fakeId')
            ->Where('sub_name', 'LIKE', "%{$key}%")
            ->orWhere('medl_img_ved', 'LIKE', "%{$key}%")
            ->orWhere('main_name', 'LIKE', "%{$key}%")
            ->get();

        $col= ['اسم القسم الفرعي','الصورة','اسم القسم الرئيسي','fakeId'];


        if (isset($_GET['btnSearch']) && $qry->isEmpty()){
            $qry = \DB::table('sub_section')
                ->join('media_library', 'sub_section.medl_id', '=', 'media_library.medl_id')
                ->join('main_sections','sub_section.main_id','=','main_sections.main_id')
                ->select('sub_name AS اسم القسم الفرعي' , 'medl_img_ved AS الصورة','main_name AS اسم القسم الرئيسي', 'sub_section.state','sub_section.fakeId')
                ->get();

            $col= ['اسم القسم الفرعي','الصورة','اسم القسم الرئيسي','fakeId'];

            $placeHolder = "لا توجد نتائج";
        } elseif (isset($_GET['btnCancel'])){
            $qry = \DB::table('sub_section')
                ->join('media_library', 'sub_section.medl_id', '=', 'media_library.medl_id')
                ->join('main_sections','sub_section.main_id','=','main_sections.main_id')
                ->select('sub_name AS اسم القسم الفرعي' , 'medl_img_ved AS الصورة','main_name AS اسم القسم الرئيسي', 'sub_section.state','sub_section.fakeId')
                ->get();

            $col= ['اسم القسم الفرعي','الصورة','اسم القسم الرئيسي','fakeId'];

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
