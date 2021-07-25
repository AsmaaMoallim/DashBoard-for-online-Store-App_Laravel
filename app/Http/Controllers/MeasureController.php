<?php

namespace App\Http\Controllers;

use App\Models\Measure;
use App\Models\measuresImages;
use App\Models\MediaLibrary;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class MeasureController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    static public $storeImage;
    public function index()
    {
        $pagename = "دليل المقاسات";
        $formPage = "update-measures-form";
        $addNew = "تعديل الصورة";
        $showRecords = "0";
        $tables = 'measure';

        $qry = \DB::table('measure')
            ->select('mesu_value AS المقاسات', 'measure.fakeId')->get();

        $columns = ['المقاسات', 'fakeId'];

        return view('master_tables_view', ['pagename' => $pagename])->with('rows', $qry)->with
        ('columns', $columns)->with('tables', $tables)->with('addNew', $addNew)->with
        ('showRecords', $showRecords)->with('formPage', $formPage);
    }

    public function insertData()
    {
        $mediaLibrary = MediaLibrary::all();
        return view('update-measures-form')->with( compact('mediaLibrary'));
    }

    public function fetch_image($mesu_id)
    {

        $image = Measure::findOrFail($mesu_id);
        $image_file = Image::make($image->medl_img_ved)->resize(60, 60);
        $response = Response::make($image_file->encode('jpeg'));
        $response->header('Content-Type', 'image/jpeg');
        return $response;
    }

    public function destroy($id)
    {

        $data = Measure::where("fakeId","=","$id")->first();;
        $data->delete();

        return redirect()->back();
    }

    public function enableOrdisable($id)
    {

        $data = Measure::where("fakeId","=","$id")->first();;


        if ($data->state == false) {
            $data->state = true;
            $data->save();
        } else {
            $data->state = false;
            $data->save();
        }
        return redirect()->back();

    }


    function store(Request $request)
    {
//        $image = Image::make($request->file('medl_id'))->encode('jpeg');
//        MeasureController::$storeImage = $image;
        $mesuImage = new MediaLibrary();
        $mesuImage->medl_id = $request->medl_id;

        return redirect('/measure');
    }

        public function update(Request $request, Measure $measure,$id)
    {
        $currentValues = measuresImages::where("fakeId","=","$id")->first();
        $mediaLibrary = MediaLibrary::all();
        $currentMedias = MediaLibrary::all()
            ->where("medl_id","=","$currentValues->medl_id");

        return view('update-measures-form')->with('currentValues' , $currentValues)
                ->with('mediaLibrary',$mediaLibrary)-with('currentMedias',$currentMedias)
                ->with('id', $id);
    }



    public function store_update(Request $request, $id){
        $data = Measure::where("fakeId","=","$id")->first();
        $data->update($request->all());
        return redirect('/measure');
    }

//    function addNew(Request $request)
//    {
//        $manager = new Manager;
//        $manager->ManagerName = $request->ManagerName;
//        $manager->ManagerEmail = $request->ManagerEmail;
//        $manager->ManagerPhone = $request->ManagerPhone;
//        $manager->ManagerRole = $request->ManagerRole;
//        $manager->ManagerPassword = $request->ManagerPassword;
//      $manager->save();
//        return redirect('/home');
//   }


    public function search(Request $request){
        $key = trim($request->get('search'));


        $pagename = "دليل المقاسات";
        $formPage = "update-measures-form";
        $addNew = "تعديل الصورة";
        $showRecords = "0";
        $tables = 'measure';

        $qry = \DB::table('measure')
            ->select('mesu_value AS المقاسات', 'measure.fakeId')
            ->Where('mesu_value', 'LIKE', "%{$key}%")
            ->get();

        $col = ['المقاسات', 'fakeId'];


        if (isset($_GET['btnSearch']) && $qry->isEmpty()){
            $qry = \DB::table('measure')
                ->select('mesu_value AS المقاسات', 'measure.fakeId')->get();

            $col = ['المقاسات', 'fakeId'];

            $placeHolder = "لا توجد نتائج";
        } elseif (isset($_GET['btnCancel'])){
            $qry = \DB::table('measure')
                ->select('mesu_value AS المقاسات', 'measure.fakeId')->get();

            $col = ['المقاسات', 'fakeId'];

            $placeHolder = 'Search';
        }
        else{
            $placeHolder = 'Search';
        }

        return view('master_tables_view' ,['pagename' => $pagename, 'placeHolder'=> $placeHolder])->with('rows',$qry)->with
        ('columns', $col)->with('tables',$tables)->with('addNew',$addNew)->with
        ('showRecords',$showRecords)->with('formPage',$formPage)->with('key', $key);

    }


}
