<?php

namespace App\Http\Controllers\Admin;

use Exception;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Frontend\KnowledgeCenter;
use Illuminate\Support\Facades\Validator;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Arr;
use Illuminate\Support\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\File;

class KnowledgeCenterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $page_title = __("Knowledge Center");
        $knowledge_center = KnowledgeCenter::orderByDesc("id")->paginate(10);
        return view('admin.sections.knowledge_center.index', compact('page_title', 'knowledge_center'));
    }


    public function add()
    {
        $page_title = __("Knowledge Center");
        return view('admin.sections.knowledge_center.add', compact('page_title'));
    }

    public function store(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'title'      => 'required|string',
            'doc' => 'required|file|mimes:pdf,doc,docx,jpg,jpeg,png|max:5120',
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }

        $validated = $validator->validate();

        $KnowledgeCenter = new KnowledgeCenter();
        $KnowledgeCenter->title = $request->title;
        // Upload File
        try {
            if ($request->hasFile('doc')) {
                $file_name = 'Doc-' . Carbon::parse(now())->format("Y-m-d") . "." . $validated['doc']->getClientOriginalExtension();
                $file_link = get_files_path('documents') . '/' . $file_name;
                // (new Filesystem)->cleanDirectory(get_files_path('documents'));
                File::move($validated['doc'], $file_link);
                $KnowledgeCenter->doc = $file_name;
            }
            $KnowledgeCenter->save();
        } catch (Exception $e) {
            return back()->with(['warning' => [__('Failed to store new file.' + $e->getMessage())]]);
        }



        return redirect()->back()->with('success', 'Document uploaded successfully!');
    }



    /**
     * Delete a record from database
     */
    public function delete(Request $request, $mark_delete = false)
    {


        $request->validate([
            'target'    => 'required|integer|exists:knowledge_center,id'
        ]);

        $id = [$request->target];


        KnowledgeCenter::whereIn('id', $id)->delete();

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
