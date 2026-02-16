<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProfileRequest;
use App\Services\LocationService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Symfony\Component\Intl\Countries;
use Symfony\Component\Intl\Locales;

class profileController extends Controller
{
    public function edit(LocationService $locationService)
    {
        $user = Auth::user();
        $cities = $locationService->cities();
        $governorate = $locationService->governorates();
        return view('dashboard.profile.edit', [
            'user' => $user,
            'cities' => $cities,
            'governorates' => $governorate,
        ]);
    }

    public function update(ProfileRequest $request)
    {
        $user = Auth::user();

        $profile = $user->profile;

        $data = $request->validated();

        if ($request->hasFile('image')) {
            $data['image'] = $request->file('image')
                ->store('profiles', 'public');
        }

        $profile->update($data);
        if ($request->hasFile('image')) {

            if ($profile->image) {
                Storage::disk('public')->delete($profile->image);
            }

            $data['image'] = $request->file('image')
                ->store('profiles', 'public');
        }
        return redirect()
            ->route('dashboard.profile.edit')
            ->with('success', 'Profile Updated Successfully');
    }
}
