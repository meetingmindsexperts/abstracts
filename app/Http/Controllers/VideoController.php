<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage; // Import the Storage facade
use Illuminate\Http\Request;
use App\Models\Submission;
use App\Exports\VideosExport;
use Maatwebsite\Excel\Facades\Excel;
use PDF;

class VideoController extends Controller
{
    public function index(Request $request)
    {
        $query = Submission::query();

        // Filter by email if email is provided in the request
        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        $videos = $query->paginate(10); // Adjust the number per page as needed

        return view('admin.videos', compact('videos'));
    }

    public function view($id)
    {
        $video = Submission::findOrFail($id);

        // Generate a URL to access the video file
        $videoUrl = Storage::disk('local')->url($video->video_path); // 'local' is the disk name configured in config/filesystems.php

        return view('admin.video_view', compact('video', 'videoUrl'));
    }


    public function download($id)
    {
        $video = Submission::findOrFail($id);

        // Download the video file
        return Storage::disk('local')->download($video->video_path);
    }

    public function export(Request $request)
    {
        $query = Submission::query();

        // Filter by email if email is provided in the request
        if ($request->has('email')) {
            $query->where('email', 'like', '%' . $request->input('email') . '%');
        }

        $data = $query->get();

        // Export as CSV or PDF based on user selection
        if ($request->input('export_type') == 'csv') {
            return Excel::download(new VideosExport($data), 'videos.csv');
        } elseif ($request->input('export_type') == 'pdf') {
            $pdf = PDF::loadView('admin.videos.export_pdf', compact('data'));
            return $pdf->download('videos.pdf');
        }

        return redirect()->route('admin.videos.index')->with('error', 'Invalid export type.');
    }
}
 