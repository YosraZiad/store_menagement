<?php

namespace App\Http\Controllers\Admin;

use App\Models\ProviderProfile;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Provider;
use App\Models\User;

use App\Http\Requests\ProviderRequest;
use Illuminate\Database\QueryException;

class ProvidersController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $providers = Provider::all();

        $vars = [
            'fields' => Provider::getFields(),
            'providers' => $providers,
        ];
        return view('CP.providers.all', $vars);
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
    public function store(ProviderRequest $request)
    {

        try {
            $provider = Provider::create([
                'full_name'             => $request->full_name,
                'short_name'            => $request->short_name,
                'field'                 => $request->field,
                'created_by'            => auth()->user()->id,
                'updated_by'            => auth()->user()->id,
            ]);
            if ($provider) {
                $profile = ProviderProfile::create([
                    'provider'          => $provider->id,
                    'about'             => $request->brief,
                    'cr_number'         => $request->cr_number,
                    'vat_number'        => $request->vat_number,
                    'phone'             => $request->phone,
                    'email'             => $request->email,

                ]);
                if ($profile) {
                    return redirect()->back()->with('success', 'New Provider Has Been Added Successfuly');
                }
            }
        } catch (QueryException $err) {
            return redirect()->back()->with('error', 'Provider Insertion Failed Because Of: ' . $err);
        }
    }

    /**
     * Display the specified resource.
     */
    public function view(string $id)
    {
        $provider = Provider::where(['id' => $id])->with('profile')->with('creator')->with('editor')->first();
        return view('CP.providers.ajax.view', ['item' => $provider, 'fields' => Provider::getFields()]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $provider = Provider::where(['id' => $id])->with('profile')->with('creator')->with('editor')->first();
        return view('CP.providers.ajax.edit', ['item' => $provider, 'fields' => Provider::getFields()]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $provider = Provider::find($request->id);
        if (null == $provider) {
            return redirect()->back()->with('error', 'provider doesn\'t exists.');
        }
        $provider->name              = $request->name;
        $provider->description      = $request->description;
        $provider->short_name        = $request->short_name;
        $provider->updated_by        = auth()->user()->id;
        try {
            $provider->update();
            return redirect()->back()->with('success', 'provider has been updated successfuly.');
        } catch (QueryException $err) {
            return redirect()->back()->with('error', 'provider update failed because of: ' . $err);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $provider = Provider::find($id);
        $profile = ProviderProfile::where(['provider' => $id])->first();
        try {
            $provider->delete();
            $profile->delete();
            return redirect()->back()->with(['success' => 'Provider has been Removed Successfully']);
        } catch (QueryException $err) {
            return redirect()->back()->with('error', 'Provider deletion process failed because of: ' . $err);
        }
    }
}
