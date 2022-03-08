<?php
  
namespace App\Http\Controllers\Auth;
  
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Session;
use App\Models\User;
use Hash;
use App\Repository\IOrganizationRepository;
use App\Repository\IContactRepository;
use App\Repository\ISegmentRepository;
use App\Repository\ICampaignRepository;
use App\Models\Contact;
use App\Models\Campaign;
use Carbon\Carbon;

class AuthController extends Controller
{

    public function __construct( IOrganizationRepository $organization, IContactRepository $contact, 
                                 ISegmentRepository $segment, ICampaignRepository $campaign)
    {
        $this->organization = $organization;
        $this->contact      = $contact;
        $this->segment      = $segment;
        $this->campaign     = $campaign;
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {
        return view('auth.login');
    }  
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function registration()
    {
        return view('auth.registration');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postLogin(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);
   
        $credentials = $request->only('email', 'password');
        if (Auth::attempt($credentials)) {

            $collection = [];
            $organizations  = $this->organization->getAllOrganizations($collection, $pagnaition = 'all');
            $contacts       = $this->contact->getAllContacts($collection, $pagnaition = 'all');
            $segments       = $this->segment->getAllSegments($collection, $pagnaition = 'all');
            $campaigns      = $this->campaign->getAllCampaigns($collection, $pagLimit = 'all');

            return redirect()->intended('dashboard')
                        ->withSuccess('You have Successfully loggedin', compact( 'organizations', 'contacts','segments','campaigns' ));
        }
  
        return redirect("/")->withSuccess('Oppes! You have entered invalid credentials');
    }
      
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function postRegistration(Request $request)
    {  
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:6',
        ]);
           
        $data = $request->all();
        $check = $this->create($data);
         
        return redirect("dashboard")->withSuccess('Great! You have Successfully loggedin');
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function dashboard()
    {
        if(Auth::check()){

            $collection = [];
            $organizations  = $this->organization->getAllOrganizations($collection, $pagnaition = 'all');
            $contacts   = $this->contact->getAllContacts($collection, $pagnaition = 'all');
            $segments   = $this->segment->getAllSegments($collection, $pagnaition = 'all');
            $campaigns  = $this->campaign->getAllCampaigns($collection, $pagLimit = 'all');

            return view('admin.dashboard')->with(compact('organizations','contacts','segments','campaigns'));
        }
  
        return redirect("/")->withSuccess('Opps! You do not have access');
    }

    public function getMonthChart() {
        $current_year   = Carbon::now()->year;
        $result         = Contact::selectRaw('year(created_at) year, month(created_at) month, count(*) data')
                            ->whereYear('created_at', $current_year)
                            ->groupBy('year', 'month')
                            ->orderBy('year', 'desc')
                            ->get();

        $monthArray     = [];
        $resultArray    = [];
        for( $i=1; $i<=12; $i++ ) {
            
            $monthArray[$i] = 0;

            foreach( $result->toArray() as $camp ){
                $monthArray[$camp['month']] = $camp['data'];
            }

            $resultArray[] = $monthArray[$i];
        }
        
        return $resultArray;
    }

    public function getCampaignChart() {
        $current_year   = Carbon::now()->year;
        $result         = Campaign::selectRaw('year(created_at) year, month(created_at) month, count(*) data')
                            ->whereYear('created_at', $current_year)
                            ->groupBy('year', 'month')
                            ->orderBy('year', 'desc')
                            ->get();

        $monthlyArray   = [];
        $resultArray    = [];
        for( $i=1; $i<=12; $i++ ) {

            $monthlyArray[$i] = 0;

            foreach( $result->toArray() as $camp ){
                $monthlyArray[$camp['month']] = $camp['data'];
            }

            $resultArray[] = $monthlyArray[$i];
        }

        return $resultArray;
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function create(array $data)
    {
      return User::create([
        'name' => $data['name'],
        'email' => $data['email'],
        'password' => Hash::make($data['password'])
      ]);
    }
    
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function logout() {
        Session::flush();
        Auth::logout();
  
        return Redirect('/');
    }
}