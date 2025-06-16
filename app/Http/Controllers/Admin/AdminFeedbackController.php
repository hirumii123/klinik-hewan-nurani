<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class AdminFeedbackController extends Controller
{
    /**
     * Menampilkan daftar feedback.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View
     */
    public function index(Request $request) // Tambahkan Request sebagai parameter
    {
        $query = Feedback::orderBy('created_at', 'desc'); // Mulai query dengan pengurutan default

        // Logika filter berdasarkan rentang tanggal
        if ($request->filled('start_date')) {
            $query->whereDate('created_at', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('created_at', '<=', $request->end_date);
        }

        $feedbacks = $query->get(); // Jalankan query

        return view('feedback.index', compact('feedbacks'));
    }

    /**
     * Menghapus feedback dari database.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $feedback = Feedback::findOrFail($id);
        $feedback->delete();

        return redirect()->route('feedback-admin.index')->with('success', 'Feedback berhasil dihapus.');
    }
}
