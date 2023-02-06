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
                return  '<div class="avatar-group">
                <a href="javascript: void(0);" class="avatar-group-item" data-img="avatar-3.jpg" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Username" data-bs-original-title="Username">
                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xxs">
                </a>
            </div>';
                // return  "<h1></h1>";
                // return  $row->profile_picture;
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
            ->escapeColumns([])
            ->make(true);
    }
    public function customers(Request $request)
    {
        $users = User::where('role', User::$customer)->latest()->get();
        return Datatables::of($users)
            ->addIndexColumn()
            ->addColumn('profile_picture', function ($row) {
                return  '<div class="avatar-group">
                <a href="javascript: void(0);" class="avatar-group-item" data-img="avatar-3.jpg" data-bs-toggle="tooltip" data-bs-trigger="hover" data-bs-placement="top" aria-label="Username" data-bs-original-title="Username">
                    <img src="assets/images/users/avatar-3.jpg" alt="" class="rounded-circle avatar-xxs">
                </a>
            </div>';
                // return  "<h1></h1>";
                // return  $row->profile_picture;
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
            ->escapeColumns([])
            ->make(true);
    }
}
