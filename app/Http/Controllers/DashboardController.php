<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Route;
use Minishlink\WebPush\Subscription;
use Minishlink\WebPush\WebPush;

use App\Models\User;
use App\Models\Role;
use App\Models\Attendance;
// use App\Models\Announcement;
// use App\Models\BookingModel;

use App\Events\MyEvent;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use Illuminate\Support\Facades\Cookie;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display all the static pages when authenticated
     *
     * @param string $page
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $totals = [
            'usercount' => User::count()
        ];


        // $announcement = Announcement::where('when','<=',Carbon::now()->format('Y-m-d H:m'))
        // ->get();

        // foreach($announcement as $announcements){
        //     $announcement_ = Announcement::find($announcements->id);
        //     $announcement_->delete();
        // }

       $attendances = Attendance::where('created_date', today())
        ->latest('id')
        ->paginate(10);

        if (view()->exists("pages.dashboard")) {
            return view("pages.dashboard", [
                'totals'        => $totals,
                'attendances'   => $attendances,
                'showUserImage' => session('show_user_image', true),
                //'subscriptions' => PushSubscription::all(),
                //'bookings'       => BookingModel::getBookingByEmail(Auth::user()->email)
                // 'announcement' => Announcement::orderBy('created_at','DESC')->get()
            ]);
        }

        return abort(404);
    }

        /**
     * Toggle user image visibility on login page.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function toggleUserImage(Request $request)
    {
        $current = Cookie::get('showUserImage', true);

        $newState = $current ? false : true;

        session(['show_user_image' => $newState]);
        Cookie::queue('showUserImage', $newState, 60 * 24 * 30);

        // If you want AJAX toggle:
        if ($request->ajax()) {
            return response()->json(['show_user_image' => $newState]);
        }

        return back()->withSuccess('User image visibility updated.');
    }
}
