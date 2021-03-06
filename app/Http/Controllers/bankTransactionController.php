<?php

namespace App\Http\Controllers;

use App\Models\BankTransaction;
use App\Models\Client;
use App\Models\MediaLibrary;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Intervention\Image\Facades\Image;

class bankTransactionController extends Controller
{
    public function index(BankTransaction $bankTransaction)
    {
        $this->authorize('view', $bankTransaction);

        $pagename = "التحويلات البنكية";

        $tables = 'bank_transaction';

        $noUpdateBtn = 1;
        $noDeleteBtn = 1;

        $qry = \DB::table('bank_transaction')
            ->join('orders', 'bank_transaction.ord_id', '=', 'orders.ord_id')
            ->join('clients', 'clients.cla_id', '=', 'bank_transaction.cla_id')
            ->join('sys_bank_account', 'sys_bank_account.sys_bank_id', '=', 'bank_transaction.sys_bank_id')
            ->select('trans_id', 'bank_transaction.ord_id AS رقم الطلب',
                \DB::raw("CONCAT(cla_frist_name, ' ', cla_last_name) AS الاسم"),
                'bank_transaction.banktran_amount AS قيمة التحويل',
                'bank_transaction.banktran_img AS صورة التحويل',
                'bank_transaction.fakeId')
            ->get();
        $columns = ['رقم الطلب', 'الاسم', 'قيمة التحويل', 'صورة التحويل', 'fakeId'];

        return view('master_tables_view', ['pagename' => $pagename])->with('rows', $qry)->with
        ('columns', $columns)->with('tables', $tables)->with
        ('noDeleteBtn', $noDeleteBtn)->with('noUpdateBtn', $noUpdateBtn);
    }

    public function search(Request $request, BankTransaction $bankTransaction)
    {
        $this->authorize('view', $bankTransaction);

        $key = trim($request->get('search'));


        $pagename = "التحويلات البنكية";

        $tables = 'bank_transaction';


        $qry = \DB::table('bank_transaction')
            ->join('orders', 'bank_transaction.ord_id', '=', 'orders.ord_id')
            ->join('clients', 'clients.cla_id', '=', 'bank_transaction.cla_id')
            ->join('sys_bank_account', 'sys_bank_account.sys_bank_id', '=', 'bank_transaction.sys_bank_id')
            ->select('bank_transaction.trans_id', 'bank_transaction.ord_id AS رقم الطلب',
                \DB::raw("CONCAT(cla_frist_name, ' ', cla_last_name) AS الاسم"),
                'bank_transaction.banktran_amount AS قيمة التحويل',
                'bank_transaction.banktran_img AS صورة التحويل',
                'bank_transaction.fakeId')
            ->orWhere('bank_transaction.ord_id', 'LIKE', "%{$key}%")
            ->orWhere('cla_frist_name', 'LIKE', "%{$key}%")
            ->orWhere('cla_last_name', 'LIKE', "%{$key}%")
            ->orWhere('bank_transaction.banktran_amount', 'LIKE', "%{$key}%")
            ->orWhere('bank_transaction.banktran_img', 'LIKE', "%{$key}%")
            ->get();

        $col = ['رقم الطلب', 'الاسم', 'قيمة التحويل', 'صورة التحويل', 'fakeId'];


        if (isset($_GET['btnSearch']) && $qry->isEmpty()) {
            $qry = \DB::table('bank_transaction')
                ->join('orders', 'bank_transaction.ord_id', '=', 'orders.ord_id')
                ->join('clients', 'clients.cla_id', '=', 'bank_transaction.cla_id')
                ->join('sys_bank_account', 'sys_bank_account.sys_bank_id', '=', 'bank_transaction.sys_bank_id')
                ->select('bank_transaction.ord_id AS رقم الطلب',
                    \DB::raw("CONCAT(cla_frist_name, ' ', cla_last_name) AS الاسم"),
                    'bank_transaction.banktran_amount AS قيمة التحويل',
                    'bank_transaction.banktran_img AS صورة التحويل',
                    'bank_transaction.fakeId')
                ->get();

            $col = ['رقم الطلب', 'الاسم', 'قيمة التحويل', 'صورة التحويل', 'fakeId'];

            $placeHolder = "لا توجد نتائج";
        } elseif (isset($_GET['btnCancel'])) {
            $qry = \DB::table('bank_transaction')
                ->join('orders', 'bank_transaction.ord_id', '=', 'orders.ord_id')
                ->join('clients', 'clients.cla_id', '=', 'bank_transaction.cla_id')
                ->join('sys_bank_account', 'sys_bank_account.sys_bank_id', '=', 'bank_transaction.sys_bank_id')
                ->select('bank_transaction.ord_id AS رقم الطلب',
                    \DB::raw("CONCAT(cla_frist_name, ' ', cla_last_name) AS الاسم"),
                    'bank_transaction.banktran_amount AS قيمة التحويل',
                    'bank_transaction.banktran_img AS صورة التحويل',
                    'bank_transaction.fakeId')
                ->get();

            $col = ['رقم الطلب', 'الاسم', 'قيمة التحويل', 'صورة التحويل', 'fakeId'];

            $placeHolder = 'Search';
        } else {
            $placeHolder = 'Search';
        }

        return view('master_tables_view', ['pagename' => $pagename, 'placeHolder' => $placeHolder])->with
        ('rows', $qry)->with('columns', $col)->with('tables', $tables)->with('key', $key);

    }

        public
        function fetch_image($trans_id,BankTransaction $bankTransaction)
        {
            $this->authorize('view', $bankTransaction);

            $image = BankTransaction::findOrFail($trans_id);
            $image_file = Image::make($image->banktran_img);
            $response = Response::make($image_file->encode('jpeg'));
            $response->header('Content-Type', 'image/jpeg');
            return $response;
        }
}
