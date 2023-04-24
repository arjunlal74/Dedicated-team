<?php

namespace App\Http\Controllers;

use \Illuminate\Support\Facades\Mail;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use symfony\Component\Mailer\Exception\TransportExceptionInterface;
use App\Mail\SendReply;

class ContactController extends Controller
{

    public function index(){
        $contacts = Contact::all();
        return view('backend.contacts.contactList',compact('contacts'));
    }
    public function store(Request $request){

        $validator = Validator::make($request->all(), [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'company_name' => 'required',
            'mobile_number' => 'required|numeric',
            'comment' => 'required|min:10',
        ]);
        
        if ($validator->fails()) {
            return redirect('/#GetInTouch')->withErrors($validator)->withInput();
        }

        $result = Contact::create([
            'first_name' => $request['first_name'],
            'last_name' => $request['last_name'],
            'email' => $request['email'],
            'company_name' => $request['company_name'],
            'mobile_number' => $request['mobile_number'],
            'comment' => $request['comment']
        ]);
        

        if($result){
            return redirect('/')->with('success','Send Successful');
        } else {
            return redirect()->back()->with('error','Please try again');

        }
    }

    public function destroy($id){
        $contact = Contact::findOrFail($id);
        $result = $contact->delete();
        if($result){
            return redirect()->back()->with('success' , 'Deleted Successfully' );
        }else{
            return redirect()->back()->with('error' , 'Failed to delete' );
        }
    }

    public function sendReply(Request $request){
        $validator = Validator::make($request->all(), [
            'subject' => ' required ',
            'reply_message' => ' required ',
        ]);
        if ($validator->fails()) {
            return redirect('/admin/contact-list')->withErrors($validator)->withInput();
        }
        $subject = $request['subject'];
        $replyMessage = $request['reply_message'];
        $email = $request->email_contact;
        // $data = [
        //     'subject' => $subject,
        //     'replyMessage' => $replyMessage,
        // ];

        try{
            $issend = Mail::to($email)->send(new sendReply([$subject , $replyMessage]));
            return redirect()->back()->with('success','Send successfully');
         } catch (TransportExceptionInterface $e){
             return redirect()->back()->with('error','Failed to Send . Please check the email and try again');
         }
        
    }
}
