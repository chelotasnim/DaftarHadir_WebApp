<?php

namespace App\Http\Controllers;

use App\Models\DashboardSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardSettings extends Controller
{
    public function ui() {
        $quickSetting = request()->validate([
            'quick_setting' => 'required',
            'theme' => 'required'
        ]);

        $ui_data = [];
        $ui_data['user_id'] = Auth::user()->id;
        $ui_data['quick_setting'] = $quickSetting['quick_setting'];
        $ui_data['theme'] = $quickSetting['theme'];

        if($quickSetting['quick_setting'] === 'Custom') {
            if(empty(request()->input('blob'))) {
                $ui_data['blob'] = false;
            } else {
                $ui_data['blob'] = true;
            };

            if(empty(request()->input('shadow'))) {
                $ui_data['shadow'] = false;
            } else {
                $ui_data['shadow'] = true;
            };

            if(empty(request()->input('filter'))) {
                $ui_data['filter'] = false;
            } else {
                $ui_data['filter'] = true;
            };

            if(empty(request()->input('transition'))) {
                $ui_data['transition'] = false;
            } else {
                $ui_data['transition'] = true;
            };
        } else if($quickSetting['quick_setting'] === 'HighBlob') {
            $ui_data['blob'] = true;
            $ui_data['shadow'] = true;
            $ui_data['filter'] = true;
            $ui_data['transition'] = true;
        } else if($quickSetting['quick_setting'] === 'HighSharp') {
            $ui_data['blob'] = false;
            $ui_data['shadow'] = true;
            $ui_data['filter'] = true;
            $ui_data['transition'] = true;
        } else if($quickSetting['quick_setting'] === 'Medium') {
            $ui_data['blob'] = false;
            $ui_data['shadow'] = false;
            $ui_data['filter'] = false;
            $ui_data['transition'] = true;
        } else if($quickSetting['quick_setting'] === 'Low') {
            $ui_data['blob'] = false;
            $ui_data['shadow'] = false;
            $ui_data['filter'] = false;
            $ui_data['transition'] = false;
        };

        DashboardSetting::where('user_id', $ui_data['user_id'])->update($ui_data);

        return back()->with('success', 'Pengaturan Tampilan Ditambahkan!');
    }
}
