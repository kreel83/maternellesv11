<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Request;

class SubscriptionController extends Controller
{
    /**
     * Write code on Method
     *
     * @return response()
     */
    public function index()
    {        
        return view('subscription.index');
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cardform()
    {
        //dd(Auth::user()->subscriptions()->first());
        $intent = auth()->user()->createSetupIntent();
        return view('subscription.cardform', compact("intent"));
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function subscribe(Request $request)
    {
        $subscription = $request->user()->newSubscription('default', 'price_1NEXRRF73qwd826kHYATzqgl')
                        ->create($request->token);

        return view("subscription.success");
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cancel()
    {
        $finsouscription = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
        return view("subscription.cancel")
            ->with('onGracePeriode', false)
            ->with('finsouscription', $finsouscription);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function cancelsubscription()
    {
        Auth::user()->subscription('default')->cancel();
        $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
        $finsouscription = Auth::user()->subscription('default')->asStripeSubscription()->current_period_end;
        return view("subscription.cancel")
            ->with('onGracePeriode', $onGracePeriode)
            ->with('finsouscription', $finsouscription);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function resume()
    {

        $onGracePeriode = Auth::user()->subscription('default')->onGracePeriod();
        if ($onGracePeriode) {
            Auth::user()->subscription('default')->resume();
        }
        return view("subscription.resume")
            ->with('onGracePeriode', $onGracePeriode);
    }

    /**
     * Write code on Method
     *
     * @return response()
     */
    public function invoice()
    {
        $invoices = Auth::user()->invoices();
        //dd($invoices);
        return view("subscription.invoice")
            ->with('invoices', $invoices);
    }

}
