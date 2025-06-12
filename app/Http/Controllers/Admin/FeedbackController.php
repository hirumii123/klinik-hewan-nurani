<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Feedback; // Pastikan untuk mengimpor model Feedback
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    /**
     * Menampilkan daftar feedback.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {
        $feedbacks = Feedback::orderBy('created_at', 'desc')->get(); // Mengambil semua feedback, diurutkan dari terbaru
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

        return redirect()->route('feedback.index')->with('success', 'Feedback berhasil dihapus.');
    }
}
