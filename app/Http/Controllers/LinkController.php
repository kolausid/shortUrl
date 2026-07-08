<?php

namespace App\Http\Controllers;

use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Link;

class LinkController extends Controller
{
    public function index()
    {
        $urls = Link::where('user_id', auth()->id())->get();
        return view('dashboard', compact('urls'));
    }

    public function statistics($id)
    {
        $link = Link::where('id', $id)->where('user_id', auth()->id())->firstOrFail();
        $stats = $link->clicks;
        return view('linkinfo', compact('stats', 'link'));
    }

    public function delete($id): RedirectResponse
    {
            Link::where('id', $id)->where('user_id', auth()->id())->firstOrFail()->delete();
            // Link::delete($link);

            return redirect()->back()->with('deleted', 'Ссылка удалена');
    }

    private function generateShortLink(): string
    {
        do {
            $shortLink = Str::random(6);
        } while(Link::where('short_url', $shortLink)->exists());

        return $shortLink;
    }

    public function store(Request $request): RedirectResponse
    {
        $validateData = $request->validate([
            'original_url' => 'required|url|max:2048',
        ]);

        $link = Link::create([
            'user_id' => auth()->id(),
            'original_url' => $validateData['original_url'],
            'short_url' => $this->generateShortLink()
        ]);

        $shortLink = url($link->short_url);

        return redirect()->back()->with('success', 'Короткая ссылка: ' . $shortLink);
    }

    public function redirect($shortLink, Request $request): RedirectResponse
    {
        $link = Link::where('short_url', $shortLink)->firstOrFail();

        $link->clicks_count = $link->clicks_count + 1;
        // dd($link->clicks);
        $link->save();

        $ip = $request->ip();
        $userAgent = $request->userAgent();
        $link->clicks()->create([
            'ip_address' => $ip,
            'user_agent' => $userAgent,
        ]);

        return redirect()->away($link->original_url);
    }
}
