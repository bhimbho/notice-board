<?php

namespace App\Http\Controllers;

use App\Http\Requests\NoticeStoreRequest;
use App\Models\Notice;
use App\Models\User;
use App\Notifications\NoticeBoardNotification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Notification;

class NoticeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('notice-manager.index', [
            'notices' => Notice::all(),
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        // dd('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(NoticeStoreRequest $request)
    {
        $notice = Notice::create([
            'title' => $request->title,
            'description' => $request->description,
            'admin_id' => auth()->id(),
        ]);
        
        $admins = User::all();
        Notification::send($admins, new NoticeBoardNotification($notice));
        return redirect()->route('notice-manager.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Notice  $notice_manager
     * @return \Illuminate\Http\Response
     */
    public function show(Notice $notice_manager)
    {
        // dd('show');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Notice  $notice_manager
     * @return \Illuminate\Http\Response
     */
    public function edit(Notice $notice_manager)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Notice  $notice_manager
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Notice $notice_manager)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Notice  $notice_manager
     * @return \Illuminate\Http\Response
     */
    public function destroy(Notice $notice_manager)
    {
        $notice_manager->delete();
        redirect()->route('notice-manager.index');
    }

    public function approve(Notice $notice)
    {
        if ($notice->is_approved()) {
            return "Notice Already Approved Successfully";
        }

        $notice->status = 1;
        $notice->update();
        return "Updated Successfully";
    }
}
