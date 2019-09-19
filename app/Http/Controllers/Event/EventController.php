<?php

namespace App\Http\Controllers\Event;

use App\{Event, Gallery, Http\Controllers\Controller};
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Auth, DB, File, Validator};

class EventController extends Controller
{

    public function register(Request $request) {
        $validate = Validator::make($request->all(), [
            'organisation' => 'required',
            'title' => 'required',
            'file' => 'required',
            'description' => 'required',
            'expiry' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request!');
        if (!$request->hasFile('file')) return back()->with('error', 'Malformed Request!');

        $fileNameWithExt = $request->file('file')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $ext = $request->file('file')->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $ext;

        // Finally store them
        $request->file('file')->storeAs('public/posters', $fileNameToStore);

        $result = DB::table(env('DB_EVENTS'))
            ->insert([
                'created_by' => Auth::user()->id,
                'organisation' => trim($request->input('organisation')),
                'title' => trim($request->input('title')),
                'identifier' => str_replace(' ', '-', trim(strtolower($request->input('title')))),
                'file' => $fileNameToStore,
                'description' => trim($request->input('description')),
                'form' => trim($request->input('form')) == "" ? '0' : trim($request->input('form')),
                'expiry' => Carbon::make($request->input('expiry'))->format('Y-m-d H:i:s'),
                'created_at' => new \DateTime()
            ]);

        return $result ? back()->with('message', 'Done! Event created') : back()->with('error', 'Unable to create Event');
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'organisation' => 'required',
            'title' => 'required|text',
            'description' => 'required',
            'expiry' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed POST, please check your Input.');

        $result = DB::table(env('DB_EVENTS'))
            ->where('id', $id)
            ->update([
                'organisation' => trim($request->input('organisation')),
                'title' => trim($request->input('title')),
                'identifier' => str_replace(' ', '-', trim(strtolower($request->input('title')))),
                'description' => trim($request->input('description')),
                'form' => trim($request->input('form')) == "" ? '0' : trim($request->input('form')),
                'expiry' => Carbon::make($request->input('expiry'))->format('Y-m-d H:i:s'),
                'updated_at' => new \DateTime()
            ]);

        return $result ? back()->with('message', 'Done! Event updated') : back()->with('error', 'Unable to update Event');
    }

    public function delete($id) {
        $result = Event::all()->find($id);
        if (!$result) return view('errors.500');

        $path = $result->file;
        File::delete(env('PUBLIC_PATH') . '/posters/' . $path);

        try {
            $result->delete();
            return redirect(route('dashboard.events'))->with('message', 'Done! Event deleted!');
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to delete Event!');
        }
    }

    public function getActiveEvents() {
        $events = DB::table(env('DB_EVENTS'))
            ->select('id', 'title')
            ->where('organisation', 'sds')
            ->where('expiry', '>', Carbon::now()->toDateString())
            ->get();

        return $events;
    }

    public function getExpiredEvents() {
        $events = DB::table(env('DB_EVENTS'))
            ->select('id', 'title', 'organisation')
            ->where('expiry', '<=', Carbon::now()->toDateString())
            ->get();

        return $events;
    }

    public function getDSCEvents() {
        $events = DB::table(env('DB_EVENTS'))
            ->select('id', 'title')
            ->where('organisation', 'dsc')
            ->where('expiry', '>', Carbon::now()->toDateString())
            ->get();

        return $events;
    }

    public function addToGallery(Request $request) {
        $validate = Validator::make($request->all(), [
            'event' => 'required',
            'title' => 'required',
            'file' => 'image|required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed request');
        if (!$request->hasFile('file')) return back()->with('error', 'Malformed request');

        $fileNameWithExt = $request->file('file')->getClientOriginalName();
        $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
        $ext = $request->file('file')->getClientOriginalExtension();
        $fileNameToStore = $fileName . '_' . time() . '.' . $ext;

        // Finally store the Image
        $request->file('file')->storeAs('public/gallery', $fileNameToStore);

        // Now to DB
        $result = DB::table(env('DB_GALLERY'))
            ->insert([
                'event' => $request->input('event'),
                'title' => trim($request->input('title')),
                'file' => $fileNameToStore,
                'created_at' => new \DateTime()
            ]);

        return $result ? back()->with('message', 'Done! Image uploaded') : back()->with('error', 'Unable to upload Image, contact InspectorGadget.');
    }

    public function removeFromGallery($id) {
        $result = Gallery::all()->find($id);
        if (!$result) return view('errors.500');

        $path = $result->file;
        File::delete(env('PUBLIC_PATH') . '/gallery/' . $path);

        try {
            $result->delete();
            return back()->with('message', 'Done! Image deleted from Gallery');
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to delete Image from Gallery');
        }
    }

}
