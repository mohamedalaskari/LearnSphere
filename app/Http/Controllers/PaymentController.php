<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCourseRequest;
use App\Models\Payment;
use App\Http\Requests\StorePaymentRequest;
use App\Http\Requests\StoreWhereCourseIdRequest;
use App\Http\Requests\StoreWhereCourseRequest;
use App\Http\Requests\UpdatePaymentRequest;
use App\Models\Course;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;
use Stripe\Stripe;

class PaymentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public $stripe;
    public function index(Payment $payment)
    {
        Gate::authorize('viewany', $payment);
        $payment = Payment::get();
        return $this->response(code: 200, data: $payment);
    }
    public function __construct()
    {
        $this->stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', 'sk_test_51Q7zvlAKd03pxsFrF39kPa8qKdtfqRTZgVgdqsDKsZBkX8ue2YBTN951t8DOeoWhOd0658fI1S3v7BXqSrYTT0RN00RZnk4hEG'));
        \Stripe\Stripe::setApiKey(env('STRIPE_SECRET', 'sk_test_51Q7zvlAKd03pxsFrF39kPa8qKdtfqRTZgVgdqsDKsZBkX8ue2YBTN951t8DOeoWhOd0658fI1S3v7BXqSrYTT0RN00RZnk4hEG'));
    }
    public function pay(StoreWhereCourseIdRequest $request)
    {
        $request = $request->validated();
        $course = Course::all()->where('id', $request['course_id'])->first();
        $user = Auth::user();
        $User = $this->stripe->customers->create([
            'name' => $user['first_name'] . $user['last_name'],
            'email' => $user['email'],
            'phone' => $user['phone'],
        ]);
        $checkout_session = $this->stripe->checkout->sessions->create([
            'line_items' => [[
                'price_data' => [
                    'currency' => 'usd',
                    'product_data' => [
                        'name' => $course['name'],
                        'description' => $course['bio'],
                    ],
                    'unit_amount' => $course['price'] * 100,
                ],
                'quantity' => 1,
            ]],
            'customer_email' => $user['email'],
            'mode' => 'payment',
            //course_id
            'client_reference_id' => $course['id'],
            'success_url' => route('success') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url' => route('cancel'),
        ]);
        return $checkout_session->url;
    }
    public function cancel()
    {
        return "Payment is canceled.";
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePaymentRequest $request, Payment $payment)
    {
        if (isset($request->session_id)) {

            $stripe = new \Stripe\StripeClient(env('STRIPE_SECRET', 'sk_test_51Q7zvlAKd03pxsFrF39kPa8qKdtfqRTZgVgdqsDKsZBkX8ue2YBTN951t8DOeoWhOd0658fI1S3v7BXqSrYTT0RN00RZnk4hEG'));
            $response = $stripe->checkout->sessions->retrieve($request->session_id);
            // //user_id
            $user_id = Auth::user()->id;
            $request['user_id'] = $user_id;
            //course_id
            $request['course_id'] = $response->client_reference_id;

            //amount
            $request['amount'] = $response->amount_total / 100;
            //insert_data
            $insert_data = Payment::create([
                'amount' => $request['amount'],
                'user_id' => $request['user_id'],
                'course_id' => $request['course_id'],
            ]);
            return $this->response(code: 201, msg: "Payment is successful");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(Payment $payment)
    {
        Gate::authorize('view', $payment);

        $id = $payment->id;
        $payment = Payment::with('course', 'user')->find($id);
        return $this->response(code: 200, data: $payment);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Payment $payment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePaymentRequest $request, Payment $payment, StoreWhereCourseRequest $course)
    {
        Gate::authorize('update', $payment);

        //amount
        //  $request=$request->validated();
        //  //user_id
        //  $user_id=Auth::user()->id;
        //  //coures_id
        //  $course=$course->validated();
        //  $course_id=Course::all()->where('name',$course['name'])->first()->id;
        //  //update
        //  $update=DB::table('payments')->where
        //  return $this->response(code:201,data:$course_id);
    }

    /**
     * Remove the specified resource from storage.
     */

    public function destroy(Payment $payment)
    {
        //
    }
    public function delete(Payment $payment)
    {
        Gate::authorize('delete', $payment);

        $delete  = $payment->delete();
        return $this->response(code: 202, data: $delete);
    }
    public function deleted(Payment $payment)
    {
        Gate::authorize('deleted', $payment);

        $deleted = $payment->onlyTrashed()->get();
        return $this->response(code: 302, data: $deleted);
    }
    public function restore($payment, Payment $Payment)
    {
        Gate::authorize('restore', $Payment);
        $payment = Payment::where('id', $payment)->restore();
        return $this->response(code: 202, data: $payment);
    }
    public function delete_from_trash($payment, Payment $Payment)
    {
        Gate::authorize('forceDelete', $Payment);
        $payment  = Payment::where('id', $payment)->forceDelete();
        return $this->response(code: 202, data: $payment);
    }
}
