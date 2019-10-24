<?php

namespace App\Http\Controllers\Event;

use App\{Event, Gallery, Http\Controllers\Controller};
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Auth, DB, File, Validator};

class EventController extends Controller
{

    public function getActiveEvents() {
        $events = DB::table(env('DB_EVENTS'))
            ->select('id', 'title', 'identifier')
            ->where('organisation', 'sds')
            ->where('expiry', '>', Carbon::now()->toDateString())
            ->get();

        return $events;
    }

    public function getExpiredEvents() {
        $events = DB::table(env('DB_EVENTS'))
            ->select('id', 'title', 'organisation', 'identifier')
            ->where('expiry', '<=', Carbon::now()->toDateString())
            ->get();

        return $events;
    }

    public function getDSCEvents() {
        $events = DB::table(env('DB_EVENTS'))
            ->select('id', 'title', 'identifier')
            ->where('organisation', 'dsc')
            ->where('expiry', '>', Carbon::now()->toDateString())
            ->get();

        return $events;
    }

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

        $result = new Event;
        $result->created_by = Auth::user()->id;
        $result->organisation = trim($request->input('organisation'));
        $result->title = trim($request->input('title'));
        $result->identifier = str_replace(' ', '-', trim(strtolower($request->input('title'))));
        $result->file = $fileNameToStore;
        $result->description = trim($request->input('description'));
        $result->form = trim($request->input('form')) == "" ? '0' : trim($request->input('form'));
        $result->expiry = Carbon::make($request->input('expiry'))->format('Y-m-d H:i:s');
        $result->save();

        return $result
            ? back()->with('message', 'Done! Event created')
            : back()->with('error', 'Unable to create Event');
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'organisation' => 'required',
            'title' => 'required|text',
            'description' => 'required',
            'expiry' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed POST, please check your Input.');

        $result = Event::all()->find($id);
        $result->organisation = trim($request->input('organisation'));
        $result->title = trim($request->input('title'));
        $result->identifier = str_replace(' ', '-', trim(strtolower($request->input('title'))));
        $result->description = trim($request->input('description'));
        $result->form = trim($request->input('form')) == "" ? '0' : trim($request->input('form'));
        $result->expiry = Carbon::make($request->input('expiry'))->format('Y-m-d H:i:s');
        $result->update();

        return $result
            ? back()->with('message', 'Done! Event updated')
            : back()->with('error', 'Unable to update Event');
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

    public function addToGallery(Request $request) {
        $validate = Validator::make($request->all(), [
            'event' => 'required',
            'file' => 'image|required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed request');
        if (!$request->hasFile('file')) return back()->with('error', 'Malformed request');

        try {
            foreach ($request->file('file') as $file) {
                $fileNameWithExt = $file->getClientOriginalName();
                $fileName = pathinfo($fileNameWithExt, PATHINFO_FILENAME);
                $ext = $file->getClientOriginalExtension();
                $fileNameToStore = $fileName . '_' . time() . '.' . $ext;

                // Finally store the Image
                $file->storeAs('public/gallery', $fileNameToStore);

                // Write to  DB
                $result = new Gallery;
                $result->event = $request->input('event');
                $result->file = $fileNameToStore;
                $result->save();
            }

            return back()->with('message', 'Done! Image uploaded');
        } catch (\Exception $e) {
            dd($e->getMessage());
            return back()->with('error', 'Unable to upload Image, contact InspectorGadget.');
        }
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
