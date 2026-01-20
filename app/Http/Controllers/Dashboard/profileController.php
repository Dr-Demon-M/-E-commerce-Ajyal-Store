<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;

class profileController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        return view('dashboard.profile.edit', [
            'user' => $user,
            'countries' => Countries::getNames(),
            'locale' => Locales::getNames()
        ]);
    }

    public function update(ProfileRequest $request)
    {

        $user = Auth::user();
        $user->profile->fill($request->validated())->save();
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('profiles', 'public');
            $user->profile->image = $path;
            $user->profile->save();
        }
        if ($user->profile->wasChanged()) {
            return redirect()->route('dashboard.profile.edit')
                ->with('success', 'Profile Updated Successfully');
        }
        return redirect()->route('dashboard.profile.edit');
    }
}
