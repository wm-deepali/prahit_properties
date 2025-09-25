<?php

namespace App\Http\Controllers\Admin;

use Auth;
use App\EmailTemplate;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;

class EmailTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index() 
    {
        $templates=EmailTemplate::get();
        return view('admin.email_template.index')->with([
            'templates'=>$templates
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.email_template.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'    =>'required|regex:/^[a-zA-Z](.*)*[a-zA-Z0-9]$/|max:255',
            'subject'  =>'required|regex:/^[a-zA-Z](.*)*[a-zA-Z0-9]$/',
            'template' =>'required',
            'image'    =>'nullable|mimes:jpg,png,jpeg|max:2000'
        ]);
        if($request->hasFile('image')){
            $image = $request->image->store('templates');
        }else {
            $image = null;
        }
        try{
            $template = EmailTemplate::create([
                'title'   => $request->title,
                'subject' => $request->subject,
                'template'=> $request->template,
                'image'   => $image
            ]);
            
            return redirect()->route('admin.email-template.index')->with('success','Add Successfull');
        } catch(\Exception $ex) {
            return redirect()->route('admin.email-template.index')->with('error',$ex->getMessage());
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $emailtemplate = EmailTemplate::where('id',1)->first();
        if(Auth::user()->email){
            $subject=$emailtemplate->subject;
            $ordertemplate = $emailtemplate->template;
            $replacetemplate = Array(
                '#CUSTOMERNAME' => 'Sachin Kumar',
            );
            foreach($replacetemplate as $agr_key => $agr_text) {
                $ordertemplate = str_replace($agr_key, $agr_text, $ordertemplate);
            }
            $finaltemplate = $ordertemplate;
            
            dd($finaltemplate);
            $data=array(
                'email'     => Auth::user()->email,
                'name'      =>Auth::user()->name,
                'subject'   =>$subject,
                'template'  =>$finaltemplate
            );
            Mail::send('emails.template',$data,function($message) use($data){
                $message->to('sachin679710@gmail.com',$data['name'])
                ->subject($data['subject'])
                ->from("printmedia@miraclesaba.xyz","Print Media");
            });
            dd('Mail Send');
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        try{
            $template=EmailTemplate::findOrFail($id);
            return view('admin.email_template.edit')->with([
                'template'=>$template
            ]);
        }catch(\Exception $ex){
            return redirect()->route('admin.email-template.index')->with('error',$ex->getMessage());
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $requestData = $request->all();
        $request->replace($requestData);
        $request->validate([
            'title'    =>'required|regex:/^[a-zA-Z](.*)*[a-zA-Z0-9]$/|max:255',
            'subject'  =>'required|regex:/^[a-zA-Z](.*)*[a-zA-Z0-9]$/',
            'template' =>'required',
            'image'    =>'nullable|mimes:jpg,png,jpeg|max:2000'
        ]);
        try{
            $template=Emailtemplate::findOrFail($id);
            $data=array(
                'title'=>$request->title,
                'subject'=>$request->subject,
                'template'=>$request->template
            );
            if($request->hasFile('image')){
                $data['image']=$request->image->store('templates');
            }
            $template->update($data);
            return redirect()->route('admin.email-template.index')->with('success', 'Template Updated Successfully');
        } catch(\Exception $ex) {
            return redirect()->route('admin.email-template.index')->with('error',$ex->getMessage());
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function changestatus(Request $request)
    {
        try{
            $template=EmailTemplate::findOrFail($request->id);
            if($template->status=='active'){
                $status='block';
                $msg   = 'Template Blocked Successfully.';
            } else {
                $status='active';
                $msg   = 'Template Activate Successfully.';
            }
            $template->update([
                'status'=>$status
            ]);
            return $msg;
        } catch(\Exception $ex) {
            return $ex->getMessage();
        }
    }
}
