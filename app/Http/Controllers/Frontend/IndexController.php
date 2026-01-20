<?php

namespace App\Http\Controllers\Frontend;

use App\Constants\GlobalConst;
use Exception;
use App\Models\Admin\Area;
use Illuminate\Http\Request;
use App\Models\Admin\Language;
use App\Models\Admin\UsefulLink;
use App\Models\Frontend\Subscribe;
use App\Http\Controllers\Controller;
use App\Models\Admin\Blog;
use App\Models\Admin\SiteSections;
use App\Models\Admin\BlogCategory;
use App\Models\Frontend\ContactRequest;
use App\Models\Hospital\Branch;
use App\Models\Hospital\Doctor;
use App\Models\Hospital\HealthPackage;
use App\Models\Hospital\Hospital;
use App\Models\Hospital\Investigation;
use App\Models\Service;
use App\Models\ServicePrice;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Log;


class IndexController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $page_title = __("Feature Details");

        // SiteSections table se record lo
        $feature = SiteSections::find(2); // ya specific section select karo
        // dd($feature->value);

        if (!$feature) {
            abort(404, 'Feature not found');
        }

        // safe decode (agar value string hai to decode karo)
        $value = is_string($feature->value) ? json_decode($feature->value, true) : (array) $feature->value;

        // ab item nikalo
        $item_id = $id;
        $items = isset($value['items']) ? (array) $value['items'] : [];

        $item = $items[$item_id] ?? null;

        if (!$item) {
            abort(404, 'Item not found');
        }

        return view('frontend.pages.feature-detail', compact('page_title', 'item_id', 'item'));
    }


    public function index()
    {
        return view('frontend.index');
    }

    /**
     * Method for view the package page
     * @return view
     */
    public function faq()
    {
        $page_title             = __("FAQs");
        return view('frontend.pages.faq', compact(
            'page_title'
        ));
    }

    public function carePackage()
    {
        $page_title             = __("Care Packages");
        return view('frontend.pages.care-packages', compact(
            'page_title'
        ));
    }

    public function joinProvider()
    {
        $page_title             = __("Why Join Us");
        return view('frontend.pages.providers.join-us', compact(
            'page_title'
        ));
    }

    public function ourservices()
    {
        $page_title             = __("Services");
        return view('frontend.pages.services', compact(
            'page_title'
        ));
    }

    public function tutorials()
    {
        $page_title             = __("Tutorials");
        return view('frontend.pages.tutorial', compact(
            'page_title'
        ));
    }

    public function healthPackage(Request $request)
    {
        $page_title             = __("Health Package");
        $package                = HealthPackage::where('status', true)->paginate(6);
        $message                = Session::get('message');


        $validator = Validator::make($request->all(), [
            'name'            => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }

        if ($request->name) {
            $package     = HealthPackage::where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            $package     = HealthPackage::where('name', 'like', '%' . $request->name . '%')->get();
        }

        return view('frontend.pages.health-package', compact(
            'page_title',
            'message',
            'package'
        ));
    }

    /**
     * Method for search doctor
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function searchPackage(Request $request)
    {

        $page_title             = __("Health Package");
        $package                = HealthPackage::where('status', true)->paginate(6);
        $message                = Session::get('message');


        $validator = Validator::make($request->all(), [
            'name'            => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }

        if ($request->name) {

            $package     = HealthPackage::where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            $package     = HealthPackage::where('name', 'like', '%' . $request->name . '%')->get();
        }


        return view('frontend.pages.health-package', compact(
            'page_title',
            'message',
            'package'
        ));
    }

    /**
     * Method for view the package page
     * @return view
     */
    public function branch(Request $request)
    {
        $page_title             = __("Branch");
        $branch                 = Branch::where('status', true)->paginate(6);
        $message                = Session::get('message');


        $validator = Validator::make($request->all(), [
            'name'            => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }

        if ($request->name) {
            $branch     = Branch::where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            $branch     = Branch::where('name', 'like', '%' . $request->name . '%')->get();
        }

        return view('frontend.pages.branch', compact(
            'page_title',
            'message',
            'branch'
        ));
    }

    /**
     * Method for search doctor
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function searchBranch(Request $request)
    {

        $page_title             = __("Branch");
        $branch                 = Branch::where('status', true)->paginate(6);
        $message                = Session::get('message');


        $validator = Validator::make($request->all(), [
            'name'            => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }

        if ($request->name) {

            $branch     = Branch::where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            $branch     = Branch::where('name', 'like', '%' . $request->name . '%')->get();
        }


        return view('frontend.pages.branch', compact(
            'page_title',
            'message',
            'branch'
        ));
    }

    /**
     * Method for view the package page
     * @return view
     */
    public function investigation(Request $request)
    {
        $page_title             = __("Investigation");
        $investigation          = Investigation::where('status', true)->paginate(6);
        $message                = Session::get('message');


        $validator = Validator::make($request->all(), [
            'name'            => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }

        if ($request->name) {
            $investigation     = Investigation::where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            $investigation     = Investigation::where('name', 'like', '%' . $request->name . '%')->get();
        }

        return view('frontend.pages.investigation', compact(
            'page_title',
            'message',
            'investigation'
        ));
    }

    /**
     * Method for search
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function searchInvestigation(Request $request)
    {
        $page_title             = __("Investigation");
        $investigation          = Investigation::where('status', true)->paginate(6);
        $message                = Session::get('message');


        $validator = Validator::make($request->all(), [
            'name'            => 'nullable',
        ]);

        if ($validator->fails()) {
            return back()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }

        if ($request->name) {

            $investigation     = Investigation::where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            $investigation     = Investigation::where('name', 'like', '%' . $request->name . '%')->get();
        }


        return view('frontend.pages.investigation', compact(
            'page_title',
            'message',
            'investigation'
        ));
    }


    /**
     * Method for view the find  page
     * @return view
     */
    public function findDoctor(Request $request)
    {
        $page_title             = "Find Doctor";
        $hospital               = Hospital::with('branch.departments')->where('status', true)->get();
        $doctor                 = Doctor::where('status', true)->paginate(6);
        $message                = Session::get('message');

        $validator = Validator::make($request->all(), [
            'hospital'        => 'nullable',
            'branch'          => 'nullable',
            'department'      => 'nullable',
            'name'            => 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }

        if ($request->hospital && $request->branch && $request->department && $request->name) {
            $doctor    = Doctor::where('hospital_id', $request->hospital)->where('branch_id', $request->branch)->where('department_id', $request->department)->where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            $doctor    = Doctor::where('name', 'like', '%' . $request->name . '%')->get();
        }

        $hospitalString      = $request->doctor;
        $nameString          = $request->name;

        return view('frontend.pages.find-doctor', compact(
            'page_title',
            'hospitalString',
            'nameString',
            'doctor',
            'message',
            'hospital'
        ));
    }

    /**
     * Method for search doctor
     * @param string $slug
     * @param \Illuminate\Http\Request  $request
     */
    public function searchDoctor(Request $request)
    {
        $page_title             = __("Find Doctor");
        $hospital               = Hospital::with('branch.departments')->where('status', true)->get();
        $doctor                 = Doctor::where('status', true)->paginate(6);

        $message                = Session::get('message');

        $validator = Validator::make($request->all(), [
            'hospital'        => 'nullable',
            'branch'          => 'nullable',
            'department'      => 'nullable',
            'name'            => 'nullable',
        ]);
        if ($validator->fails()) {
            return back()->with(['error' => [__('Something went wrong! Please try again.')]]);
        }
        if ($request->hospital && $request->branch && $request->department && $request->name) {
            $doctor    = Doctor::where('hospital_id', $request->hospital)->where('branch_id', $request->branch)->where('department_id', $request->department)->where('name', 'like', '%' . $request->name . '%')->get();
        } else {
            $doctor    = Doctor::where('name', 'like', '%' . $request->name . '%')->get();
        }


        $hospitalString      = $request->hospital;
        $nameString          = $request->name;

        return view('frontend.pages.find-doctor', compact(
            'page_title',
            'hospitalString',
            'nameString',
            'hospital',
            'doctor',
            'message'
        ));
    }
    /**
     * Method for view the about page
     * @return view
     */
    public function hospital()
    {
        $page_title           = __("Hospital");
        return view('frontend.pages.hospital', compact(
            'page_title',
        ));
    }

    /**
     * Method for view the about page
     * @return view
     */
    public function about()
    {
        $page_title             = __("About");
        return view('frontend.pages.about', compact(
            'page_title',
        ));
    }



    /**
     * Method for view the about page
     * @return view
     */
    public function services()
    {
        $page_title             = __("Services");
        return view('frontend.pages.services', compact(
            'page_title',
        ));
    }

    /**
     * Method for view the contact page
     * @return view
     */
    public function contact()
    {
        $page_title             = __("Contact");
        return view('frontend.pages.contact', compact(
            'page_title',
        ));
    }

    /**
     * Method for view the about page
     * @return view
     */
    public function blog()
    {
        $page_title             = __("Blogs");
        $blogs                  = Blog::where('status', true)->paginate(6);
        return view('frontend.pages.blog', compact(
            'page_title',
            'blogs',
        ));
    }

    /**
     * Method for show the blog details page
     * @param string $slug
     * @param \Illuminate\Http\Request $request
     */
    public function blogDetails($slug)
    {
        $page_title             = __("Blog Details");
        $blog                   = Blog::where('slug', $slug)->first();
        if (!$blog) abort(404);
        $category               = BlogCategory::withCount('blog')->where('status', true)->get();
        $recent_posts           = Blog::where('status', true)->where('slug', '!=', $slug)->get();
        return view('frontend.pages.blog-details', compact(
            'page_title',
            'blog',
            'category',
            'recent_posts',
        ));
    }
    /**
     * Method for get the blogs using category
     * @param string $slug
     * @param \Illuminate\Http\Request $request
     */
    public function blogCategory($slug)
    {
        $page_title         = __("Blog Category");
        $blog_category      = BlogCategory::where('slug', $slug)->first();

        if (!$blog_category) abort(404);
        $blogs              = Blog::where('category_id', $blog_category->id)->get();

        return view('frontend.pages.blog-category', compact(
            'page_title',
            'blog_category',
            'blogs',
        ));
    }

    /**
     * Method for contact request
     * @param string
     * @param \Illuminate\Http\Request $request
     */
    public function contactRequest(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name'    => "required|string|max:255",
            'phone'   => "nullable",
            'subject' => "required",
            'email'   => "required|string|email|max:255",
            'message' => "required|string|max:5000",
        ]);

        if ($validator->fails()) {
            return back()->withErrors($validator)->withInput();
        }

        $validated = $validator->validated();

        try {
            ContactRequest::create($validated);
        } catch (Exception $e) {
            Log::error('Contact form submission failed:', [
                'error' => $e->getMessage(),
                'trace' => $e->getTraceAsString(),
                'input' => $request->all(),
            ]);
            return back()->with(['error' => [__('Failed to send message. Please try again later.')]]);
        }

        return back()->with(['success' => [__('Contact request successfully sent!')]]);
    }
    /**
     * Method for show useful links
     */
    public function link($slug)
    {
        $link       = UsefulLink::where('slug', $slug)->first();
        if (!$link) return back()->with(['error' => [__('Link not found.')]]);
        $page_title = ucwords(strtolower(str_replace("_", " ", $link->type)));

        return view('frontend.pages.link', compact(
            'link',
            'page_title'
        ));
    }

    public function subscribe(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'email'     => "required|string|email|max:255|unique:subscribes",
        ]);

        if ($validator->fails()) return redirect()->back()->withErrors($validator)->withInput();

        $validated = $validator->validate();
        try {
            Subscribe::create([
                'email'         => $validated['email'],
                'created_at'    => now(),
            ]);
        } catch (Exception $e) {
            return redirect()->back()->with(['error' => [__('Failed to subscribe. Try again')]]);
        }

        return redirect()->back()->with(['success' => [__('Subscription successful!')]]);
    }



    public function changeLanguage($lang = null)
    {
        $language = Language::where('code', $lang)->first();
        session()->put('local', $lang);
        return redirect()->back();
    }

    public function contactMessageSend(Request $request)
    {

        $validated = Validator::make($request->all(), [
            'name'      => "required|string|max:255",
            'email'     => "required|email|string|max:255",
            'subject'   => "required",
            'phone'     => "nullable",
            'message'   => "required|string|max:5000",
        ])->validate();

        try {
            ContactRequest::create($validated);
        } catch (Exception $e) {
            return back()->with(['error' => [__('Failed to send message. Please Try again')]]);
        }

        return back()->with(['success' => [__('Message send successfully!')]]);
    }

    public function languageSwitch(Request $request)
    {

        $code = $request->target;
        $language = Language::where("code", $code)->first();
        if (!$language) {
            return back()->with(['error' => [__('Oops! Language Not Found!')]]);
        }
        Session::put('local', $code);
        Session::put('local_dir', $language->dir);


        return back()->with(['success' => [__('Language Switch to ') . $language->name]]);
    }
    public function getserviceform(Request $request, $slug)
    {
        $serviceId = $slug;
        $service = Service::findOrFail($serviceId);
        $page_title             = "Services Appointment";

        // if ($service->category == 3 || $service->category == 4 || $service->category == 5) {
        return view('frontend.pages.services-booking.index', compact(
            'page_title',
            'service'
        ));
        // }
        // if ($service->category == 1) {
        //     $page_title             = "Ambulance Services Appointment";
        //     return view('frontend.pages.services-booking.ambulance', compact(
        //         'page_title',
        //         'service'
        //     ));
        // }
        return redirect()->back();
    }
    public function findprovider(Request $request, $uuid, $slug)
    {
        $serviceId = $slug;
        $service = Service::select('id', 'name')->findOrFail($serviceId);


        $provider = GetAvailableProviders($serviceId);

        $page_title             = "Find Services Provider";
        $hospital               = Hospital::with('branch.departments')->where('status', true)->get();
        $doctor                 = Doctor::where('status', true)->paginate(6);
        $message                = Session::get('message');


        $hospitalString      = $request->doctor;
        $nameString          = $request->name;

        return view('frontend.pages.find-provider', compact(
            'page_title',
            'uuid',
            'hospitalString',
            'nameString',
            'provider',
            'message',
            'hospital'
        ));
    }
}
