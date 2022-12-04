<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Setting;
use App\UseCases\FileService;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    private $service;
    public function __construct(FileService $service)
    {
        $this->service = $service;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function index()
    {
        $settings=Setting::paginate(30);
        return view('admin.setting.index',compact('settings'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function create()
    {
        return view('admin.setting.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
       $request->validate([
          'name'=>'required|string',
            'link'=>'required|string',
        ]);
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:JPG,jpeg, jpg, svg, png|required|max:10000'
            ]);
            $file = $this->service->uploads($request);
            $request['file_id'] = $file->id;
        }
       Setting::create($request->only('name','link','file_id','type'));
       return redirect(route('setting.index'));
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Http\RedirectResponse
     */
    public function show(Setting $setting)
    {
        return redirect()->back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Http\Response|\Illuminate\View\View
     */
    public function edit(Setting $setting)
    {
        return view('admin.setting.edit',compact('setting'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, Setting $setting)
    {
        $request->validate([
            'name'=>'string',
            'link'=>'string',
        ]);
        if ($request->hasFile('file')) {
            $request->validate([
                'file' => 'mimes:JPG,jpeg, jpg, svg, png|required|max:10000'
            ]);
            $this->service->delete($setting->file_id);
            $file = $this->service->uploads($request);
            $request['file_id'] = $file->id;
            $messages = [
                'required'  => 'File is not uploaded successfully',
            ];
            $request->validate([
                'file_id' => 'required', $messages
            ]);
        }
        $setting->update($request->only('name','link','file_id','type'));

        return redirect(route('setting.index'));

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Setting  $setting
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Http\RedirectResponse|\Illuminate\Http\Response|\Illuminate\Routing\Redirector
     */
    public function destroy(Setting $setting)
    {
        if($setting->file_id){
            $this->service->delete($setting->file_id);
        }
        $setting->delete();
        return redirect(route('setting.index'));

    }
}
