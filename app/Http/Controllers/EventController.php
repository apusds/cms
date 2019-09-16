<?php

namespace App\Http\Controllers;

use App\{ Event, Gallery };
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\{Auth, DB, File, Validator};

class EventController extends Controller
{

    public function register(Request $request) {
        $validate = Validator::make($request->all(), [
            'title' => 'required',
            'description' => 'required',
            'expiry' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed Request, check your parameters.');

        $data = [
            'created_by' => Auth::user()->id,
            'title' => trim($request->input('title')),
            'image' => $request->input('image') === null ? null : $request->input('image'),
            'description' => trim($request->input('description')),
            'expiry' => Carbon::parse($request->input('expiry'))->format('Y-m-d H:i:s'),
            'created_at' => new \DateTime()
        ];

        $result = DB::table(env("DB_EVENTS"))
            ->insert($data);

        if (!$result) return back()->with('error', 'Unable to create new Event.');
        return redirect(route('dashboard.events'))->with('message', 'Successfully created the Event.');
    }

    public function update(Request $request, $id) {
        $validate = Validator::make($request->all(), [
            'title' => 'required|text',
            'description' => 'required',
            'expiry' => 'required'
        ]);

        if (!$validate) return back()->with('error', 'Malformed POST, please check your Input.');

        $data = [
            'title' => trim($request->input('title')),
            'description' => trim($request->input('description')),
            'image' => $request->input('image') === null ? null : $request->input('image'),
            'expiry' => Carbon::parse($request->input('expiry'))->format('Y-m-d H:i:s'),
            'updated_at' => new \DateTime(),
        ];

        $result = DB::table(env("DB_EVENTS"))
            ->where('id', $id)
            ->update($data);

        if (!$result) return back()->with('error', 'Unable to update this Event.');
        return redirect(route('dashboard.events'))->with('message', 'Successfully updated the Event.');
    }

    public function delete($id) {
        try {
            Event::all()->find($id)->delete();
            return redirect(route('dashboard.events'))->with('message', 'Event deleted!');
        } catch (\Exception $e) {
            return back()->with('error', 'Unable to Event!');
        }
    }

    public function getActiveEvents() {
        $events = DB::table(env('DB_EVENTS'))
            ->select('id', 'title')
            ->where('expiry', '>', Carbon::now()->toDateString())
            ->get();

        return $events;
    }

    public function getExpiredEvents() {
        $events = DB::table(env('DB_EVENTS'))
            ->select('id', 'title')
            ->where('expiry', '<=', Carbon::now()->toDateString())
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
