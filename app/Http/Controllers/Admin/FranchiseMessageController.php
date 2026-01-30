<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Frontend\FranchiseeApplication;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Notification;
use App\Notifications\WebsiteSubscribeNotification;
use Maatwebsite\Excel\Facades\Excel;


class FranchiseMessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = __("Franchise Messages");
        $franchisee_applications = FranchiseeApplication::orderByDesc("id")->paginate(15);
        return view('admin.sections.franchise.index', compact('page_title', 'franchisee_applications'));
    }



    /**
     * Export data to excel
     */
    public function export(Request $request)
    {
        return Excel::download(new FranchiseeApplication(), 'FranchiseeApplication-' . date('d-m-Y') . '.xlsx');
    }

    /**
     * Delete a record from database
     */
    public function delete(Request $request, $mark_delete = false)
    {

        if ($mark_delete) {
            $request->validate([
                'mark'    => 'required|array',
                'mark.*'  => 'required|integer|exists:franchisee_applications,id'
            ]);

            $id = $request->mark;
        } else {
            $request->validate([
                'target'    => 'required|integer|exists:franchisee_applications,id'
            ]);

            $id = [$request->target];
        }

        FranchiseeApplication::whereIn('id', $id)->delete();

        return back()->with(['success' => ["Message deleted successfully!"]]);
    }

    /**
     * Delete marked record
     */
    public function deleteAll(Request $request)
    {
        return $this->delete($request, true);
    }
}
