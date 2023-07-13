<?php

namespace App\Http\Controllers;
use App\services\MailchimpNewsletter;
use App\services\Newsletter;
use Illuminate\Validation\ValidationException;
use Exception;


class NewsletterController extends Controller
{

    public function __invoke(Newsletter $newsletter){
        request()->validate(['email'=>'required|email']);
        try {
            $newsletter->subscribe(request('email'));
        } catch (Exception $e){
            throw ValidationException::withMessages([
                'email'=>'this email could not ba added for our newsletter list.'
            ]);
        }
        return redirect('/')->with('success','You are now signed up for our newsletter');
    }
}

