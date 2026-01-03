<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\AreaResource;
use App\Http\Resources\CommentResource;
use App\Http\Resources\OfferResource;
use App\Http\Resources\OptionResource;
use App\Http\Resources\RatingResource;
use App\Models\Area;
use App\Models\Comment;
use App\Models\Listing;
use App\Models\Offer;
use App\Models\Option;
use App\Models\Rating;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class GeneralController extends Controller
{
    public function offers(Request $request)
    {
        $request->validate([
            'listing_id'                => 'nullable|exists:listings,id',
            'category_id'               => 'nullable|exists:categories,id',
            'search'                    => 'nullable|string',
            'is_active'                 => 'nullable|boolean',
        ]);

        $offers = Offer::with(['listing' => function ($query) {
            $query->withIsLiked();
        }])->when($request->filled('listing_id'), function ($query) use ($request) {
            $query->where('listing_id', $request->listing_id);
        })->when($request->filled('category_id'), function ($query) use ($request) {
            $query->whereHas('listing.category', function ($query) use ($request) {
                $query->where('id', $request->category_id);
            });
        })->when($request->filled('search'), function ($query) use ($request) {
            $query->where('content', 'like', '%' . $request->search . '%');
        })->when($request->boolean('is_active'), function ($query) {
            $query->whereBetween('start_date', [now(), 'end_date']);
        })->paginate(10);

        return OfferResource::collection($offers);
    }

    public function areas(Request $request)
    {
        $request->validate([
            'city_id'               => 'nullable|exists:cities,id',
            'search'                => 'nullable|string',
        ]);
        $locale = app()->getLocale();
        $areas = Area::with('city')->when($request->filled('city_id'), function ($query) use ($request) {
            $query->where('city_id', $request->city_id);
        })->when($request->filled('search'), function ($query) use ($request , $locale) {
            $query->where("name->{$locale}", 'like', '%' . $request->search . '%');
        })->paginate(10);
        return AreaResource::collection($areas);
    }

    public function showArea(Request $request)
    {
        $request->validate([
            'id'                => 'required|exists:areas,id',
        ]);
        $area = Area::findOrFail($request->query('id'));
        $area->load(['city'])
            ->withCount(['listingBranches']);
        return new AreaResource($area);
    }

    public function options(Request $request)
    {
        $request->validate([
            'category_id'           => 'nullable|exists:categories,id',
            'search'                => 'nullable|string',
        ]);
        $options = Option::with('optionValues')
            ->when($request->filled('category_id'), function ($query) use ($request) {
                $query->whereHas('categories', function ($query) use ($request) {
                    $query->where('id', $request->query('category_id'));
                });
            })
            ->when($request->filled('search'), function ($query) use ($request) {
            $locale = app()->getLocale();
            $query->where("name->{$locale}", 'like', '%' . $request->search . '%');
        })->orderBy('id','asc')
        ->paginate(10);
        return OptionResource::collection($options);
    }

    public function showOption(Request $request)
    {
        $request->validate([
            'id'                => 'required|exists:options,id',
        ]);
        $option = Option::with('optionValues')->findOrFail($request->query('id'));
        return new OptionResource($option);
    }

    public function storeComment(Request $request)
    {
        $request->validate([
            'listing_id'                => 'required|exists:listings,id',
            'comment'                   => 'required|string',
            'parent_id'                 => 'nullable|exists:comments,id',
        ]);

        $user = Auth::guard('sanctum')->user();

        $parent_comment = null;
        $listing = Listing::findOrFail($request->listing_id);
        if ($request->filled('parent_id')) {
            $parent_comment = Comment::findOrFail($request->parent_id);
            if ($parent_comment->listing_id !== $request->listing_id) {
                return response()->json(['message' => __('Parent comment not found')], 404);
            }
            if($parent_comment->parent_id){
                return response()->json(['message' => __('Cant Reply On Reply Comment')], 403);
            }
            if($user->commenter_id != $listing->id ){
                return response()->json(status:403);
            }
        }

        $comment = Comment::create([
            'listing_id'                => $request->listing_id,
            'user_id'                   =>$user->id,
            'comment'                   => $request->comment,
            'parent_id'                 => $request->parent_id,
        ]);

        return response()->json([
            'message' => __('Comment created successfully'),
            'comment'   => new CommentResource($comment),
        ]);
    }

    public function commentsIndex(Request $request , Listing $listing)
    {
        $request->validate([
            'search'                =>'nullable|string',
        ]);

        $user = Auth::guard('sanctum')->user();

        $comments = Comment::with(['user','parent.user','replies.user'])
            ->where('listing_id',$listing->id)
            ->when($request->filled('search'), function ($q) use ($request) {
                $q->where('comment','like',"%{$request->search}%");
            })
            ->latest()
            ->paginate(10);

            return CommentResource::collection($comments);
    }

    public function rate(Request $request , Listing $listing)
    {
        $request->validate([
            'rating'            =>'required|integer|min:0|max:5',
            'comment'           =>'nullable|string',
        ]);

        $user = Auth::guard('sanctum')->user();

        $rating = Rating::where('user_id',$user->id)->where('listing_id',$listing->id)->first();
        if($rating){
            return response()->json(['message' => __('You have already rated this listing')], 40);
        }

        $rating = Rating::create([
            'rating'                =>$request->rating,
            'comment'               =>$request->comment,
            'user_id'               =>$user->id,
            'listing_id'            =>$listing->id,
        ]);

        $rating->load(['user','listing']);

        return new RatingResource($rating);

    }

    public function ratesIndex(Request $request , Listing $listing)
    {
        $request->validate([
            'min'           =>'nullable|required_with:max|integer|min:1',
            'max'           =>'nullable|required_with:min|integer|max:5',
            'by_me'         =>'nullable|boolean',
        ]);

        $user = Auth::guard('sanctum')->user();

        $rates = Rating::with(['user'])
            ->when($request->boolean('by_me'),function ($q) use ($user) {
                $q->where('user_id',$user->id);
            })
            ->when($request->filled('min'),function ($q) use ($request) {
                $q->whereBetween('rating','<=',[$request->query('min'),$request->query('max')]);
            })
            ->latest()
            ->paginate(10);

        return RatingResource::collection($rates);

    }

}
