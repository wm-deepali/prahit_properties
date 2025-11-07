<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Controllers\AppController;
use App\User;
use App\LoginLogs;
use App\AgentEnquiry;
use DataTables;
use App\ContactInfo;
use App\Testimonial;
use App\SummonsReason;
use App\Complaint;
use App\EmailTemplate;
use App\SupportCenter;
use App\HomePageContent;
use App\Notifications\QueryReplyNotification;
use App\Notifications\WelcomeEmailNotification;
use App\Http\Controllers\Concern\GlobalTrait;

class EnquiriesController extends AppController
{
    use GlobalTrait;

    public function index(Request $request)
    {
        if ($request->ajax()) {
            $enquiries = AgentEnquiry::has('Interested')->has('Property')->with('Interested', 'Property')->latest()->get();

            foreach ($enquiries as $key => $value) {
                $value->verified = "Yes";
                if (isset($value->Property)) {
                    $value->property_title = $value->Property->title;
                }
                if (isset($value->Interested)) {
                    $value->interested_in = $value->Interested->interested_type;
                }
                // $value->listing_id = $value->Property->listing_id;
            }

            return DataTables::of($enquiries)
                ->addColumn('listing_id', function ($feedback) {
                    $listing_id = '<a href="#" onclick="fetchPropertyDetails(' . $feedback->property_id . ')" name="edit">' . $feedback->Property->listing_id . '</a>';
                    return $listing_id;
                })
                ->rawColumns(['listing_id'])
                ->make(true);
        }
        return view('admin.enquiries.index');

    }

    public function manageSupportQuery(Request $request)
    {
        return view('admin.enquiries.support_center');
    }

    /**
     * Display a listing of the Support Center Query.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageSupportQueryDatatable(Request $request)
    {
        if ($request->ajax()) {
            $datas = SupportCenter::orderBy('id', 'DESC')->get();
            return Datatables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->reply) {
                        return '<ul class="action">
                                <li><a style="cursor:pointer" title="Buy Lead" onclick="viewReply(' . $row->id . ')"><i class="fa fa-eye" aria-hidden="true"></i></a></li>
                                <li><a style="cursor:pointer" title="Admin Reply" onclick="adminReply(' . $row->id . ')"><i class="fa fa-reply" aria-hidden="true"></i></a></li>
                            </ul>';
                    } else {
                        return '<ul class="action">
                                <li><a style="cursor:pointer" title="Admin Reply" onclick="adminReply(' . $row->id . ')"><i class="fa fa-reply" aria-hidden="true"></i></a></li>
                            </ul>';
                    }

                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function manageComplaints()
    {
        return view('admin.enquiries.complaints');
    }

    /**
     * Display a listing of the Complaints.
     *
     * @return \Illuminate\Http\Response
     */
    public function manageComplaintsDatatable(Request $request)
    {
        if ($request->ajax()) {
            $datas = Complaint::orderBy('id', 'DESC')->get();
            return Datatables::of($datas)
                ->addIndexColumn()
                ->addColumn('action', function ($row) {
                    if ($row->file) {
                        return '<ul class="action">
                    			<li>
                    				<a href="#" title="View Reasons" onclick="fetchData(' . $row->id . ')"><i class="fa fa-eye" aria-hidden="true"></i></a>
								</li>
								<li>
									<a href="' . asset('storage') . '/' . $row->file . '" title="View Attached Document" target="_blank"><i class="fa fa-file" aria-hidden="true"></i></a>
								</li>
                                <li><a style="cursor:pointer" title="Admin Reply" onclick="adminReply(' . $row->id . ')"><i class="fa fa-reply" aria-hidden="true"></i></a></li>
							</ul>';
                    } else {
                        return '<ul class="action">
                    			<li>
                    				<a href="#" title="View Reasons" onclick="showAlert()"><i class="fa fa-eye" aria-hidden="true"></i></a>
								</li>
                                <li><a style="cursor:pointer" title="Admin Reply" onclick="adminReply(' . $row->id . ')"><i class="fa fa-reply" aria-hidden="true"></i></a></li>
							</ul>';
                    }
                })
                ->rawColumns(['action'])
                ->make(true);
        }
    }

    public function getComplaintData($id)
    {
        try {
            $picked = Complaint::find($id);
            if ($picked) {
                $data['reasons'] = SummonsReason::whereIn('id', explode(',', $picked->reasons))->get();
                $data['complaint'] = $picked;
                $this->JsonResponse(200, 'Data found successfully', ['data' => $data]);
            } else {

                $this->JsonResponse(400, 'An error occured');
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
            exit;
        }
    }

    public function getSupportCenterData(Request $request)
    {
        $picked = SupportCenter::find($request->id);
        return $picked;
    }

    public function replySupportQuery(Request $request)
    {
        $picked = SupportCenter::find($request->id);
        $picked->update(
            [
                'reply' => $request->message
            ]
        );

        $emailtemplate = EmailTemplate::where('id', 5)->first();
        $query_template = $emailtemplate->template;
        $replacetemplate = array(
            '#NAME' => $picked->name,
            '#QUESTION' => $picked->message,
            '#ANSWER' => $request->message,
        );
        foreach ($replacetemplate as $agr_key => $agr_text) {
            $query_template = str_replace($agr_key, $agr_text, $query_template);
        }
        $finaltemplate = $query_template;
        $picked->notify(new QueryReplyNotification($finaltemplate, $emailtemplate->subject, $emailtemplate->image));
        return redirect()->back()->with('success', 'Answer Successfully Send On User Email Id.');
    }

    public function replyComplaintQuery(Request $request)
    {
        $picked = Complaint::find($request->id);
        $picked->update(
            [
                'reply' => $request->message
            ]
        );

        $emailtemplate = EmailTemplate::where('id', 5)->first();
        $query_template = $emailtemplate->template;
        $replacetemplate = array(
            '#NAME' => $picked->name,
            '#QUESTION' => $picked->message,
            '#ANSWER' => $request->message,
        );
        foreach ($replacetemplate as $agr_key => $agr_text) {
            $query_template = str_replace($agr_key, $agr_text, $query_template);
        }
        $finaltemplate = $query_template;
        $picked->notify(new QueryReplyNotification($finaltemplate, $emailtemplate->subject, $emailtemplate->image));
        return redirect()->back()->with('success', 'Answer Successfully Send On User Email Id.');
    }

    public function sendEmail(Request $request)
    {
        try {
            $user = User::find($request->id);
            $emailtemplate = EmailTemplate::where('id', 7)->first();
            $ordertemplate = $emailtemplate->template;
            $replacetemplate = array(
                '#NAME' => $user->firstname . ' ' . $user->lastname,
                '#MESSAGE' => $request->email_message
            );
            foreach ($replacetemplate as $agr_key => $agr_text) {
                $ordertemplate = str_replace($agr_key, $agr_text, $ordertemplate);
            }
            $finaltemplate = $ordertemplate;
            $user->notify(new WelcomeEmailNotification($finaltemplate, $emailtemplate->subject, $emailtemplate->image));
            return redirect()->back()->with('success', 'Email Successfully Send.');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', $e->getMessage());
        }
    }

    public function sendSMS(Request $request)
    {
        $msg = $this->sendGlobalSMS($request->number, $request->message);
        return redirect()->back()->with('success', $msg);
    }

    public function destroy($id)
    {
        try {
            $enquiry = AgentEnquiry::findOrFail($id);
            $enquiry->delete();

            return response()->json([
                'status' => 200,
                'message' => 'Enquiry deleted successfully.'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => 'Error deleting enquiry: ' . $e->getMessage()
            ]);
        }
    }


}


