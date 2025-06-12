<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;

class FeedbackController extends Controller
{
    /**
     * Menampilkan formulir feedback.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        return view('feedback.create');
    }

    /**
     * Menyimpan feedback baru ke database.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'suggested_disease' => 'nullable|string|max:255',
            'suggested_symptoms' => 'nullable|string',
        ]);

        Feedback::create([
            'suggested_disease' => $request->suggested_disease,
            'suggested_symptoms' => $request->suggested_symptoms,
        ]);

        return redirect()->route('feedback.create')->with('success', 'Terima kasih atas saran Anda! Kami akan meninjaunya.');
    }
}
