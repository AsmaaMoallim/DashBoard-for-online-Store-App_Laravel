<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class sysContactInfoController extends Controller
{
    public function index()
    {
        $pagename = "بيانات التواصل";
        $recordPage = "contact_info";
        $showRecords = "إضافة أرقام التواصل";
        $tables = 'contact_information';

        $qryt = \DB::table('sys_info_phone')
            ->select('sys_info_phone.sys_phone_num AS الجوال', 'sys_info_phone.state' ,'sys_info_phone.fakeId')
            ->get();

        $columnst = ['الجوال','fakeId'];

        $qry = \DB::table('sys_info_email')
            ->select('sys_info_email.sys_email AS البريد الإلكتروني'
                ,'sys_info_email.state','sys_info_email.fakeId')
            ->get();
        $columns = ['البريد الإلكتروني','fakeId'];

        return view('master_tables_view',['pagename' => $pagename])->with('rows',$qry)->with
        ('columns', $columns)->with('tables',$tables)->with
        ('showRecords',$showRecords)->with('recordPage',$recordPage);
    }
}
