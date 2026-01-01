<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use App\Models\Listing;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    /**
     * Store a newly created comment.
     */
    public function store(Request $request, Listing $listing)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'listing_id' => $listing->id,
            'user_id' => auth()->id(),
            'parent_id' => null,
            'comment' => $request->comment,
        ]);

        return redirect()->route('admins.listings.comments', $listing->id)
            ->with('success', __('Comment added successfully'));
    }

    /**
     * Store a reply to a comment.
     */
    public function reply(Request $request, Listing $listing, Comment $comment)
    {
        // Ensure the comment belongs to the listing
        if ($comment->listing_id !== $listing->id) {
            abort(404);
        }

        // Prevent nested replies (only one level allowed)
        if ($comment->parent_id !== null) {
            return redirect()->back()
                ->with('error', __('You cannot reply to a reply.'));
        }

        // Check if user is a commenter for this listing
        $user = auth()->user();
        if (!$user || ($user->commenter_id !== $listing->id)) {
            return redirect()->back()
                ->with('error', __('You are not authorized to reply to comments on this listing.'));
        }

        $request->validate([
            'comment' => 'required|string|max:1000',
        ]);

        Comment::create([
            'listing_id' => $listing->id,
            'user_id' => auth()->id(),
            'parent_id' => $comment->id,
            'comment' => $request->comment,
        ]);

        return redirect()->route('admins.listings.comments', $listing->id)
            ->with('success', __('Reply added successfully'));
    }

    /**
     * Delete a comment.
     */
    public function destroy(Listing $listing, Comment $comment)
    {
        // Ensure the comment belongs to the listing
        if ($comment->listing_id !== $listing->id) {
            abort(404);
        }

        // Delete replies first (cascade will handle this, but explicit for clarity)
        $comment->replies()->delete();
        $comment->delete();

        return redirect()->back()
            ->with('success', __('Comment deleted successfully'));
    }
}
