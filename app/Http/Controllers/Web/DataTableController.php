<?php

namespace App\Http\Controllers\Web;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use DataTables;

class DataTableController extends Controller
{
    public function deliveryPartners(Request $request)
    {
        $users = User::with('deliveryPartner')->where('role', User::$deliveryPartner)->latest()->get();
        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('profile_picture', function ($row) {
                return  $row->profile_picture;
            })
            ->addColumn('phone', function ($row) {
                return $row->phone;
            })
            ->addColumn('name', function ($row) {
                return $row->first_name . " " . $row->last_name;
            })
            ->addColumn('email', function ($row) {
                return $row->email;
            })
            ->addColumn('status', function ($row) {
                return $row->id;
            })
            ->addColumn('action', function ($row) {
                return "<button type='button' onclick='showDeliveryPartnerDetials(this)' data-user='".json_encode($row)."' class='btn btn-primary waves-effect waves-light' data-bs-toggle='modal'
                data-bs-target='.bs-example-modal-lg'><i class='las la-eye'></i></button>";
            })
            ->make(true);
    }
}
