<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PictureController extends Controller
{
    public function index(Request $request)
    {
        $query = Picture::query();

        // Gestion de la recherche
        if ($request->has('search') && !empty($request->search)) {
            $searchTerm = $request->search;
            $query->where(function ($q) use ($searchTerm) {
                $q->where('title', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('location', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('category', 'LIKE', "%{$searchTerm}%")
                    ->orWhere('tags', 'LIKE', "%{$searchTerm}%");
            });
        }
        // Sinon, appliquer les filtres de catégorie/commune
        else {
            // Filtrage par commune
            if ($request->has('commune') && $request->commune !== 'all') {
                $communeMapping = [
                    'paris' => 'Paris',
                    'lyon' => 'Lyon',
                    'marseille' => 'Marseille',
                    'toulouse' => 'Toulouse',
                    'nice' => 'Nice',
                    'nantes' => 'Nantes',
                    'strasbourg' => 'Strasbourg',
                    'montpellier' => 'Montpellier',
                    'bordeaux' => 'Bordeaux',
                    'lille' => 'Lille',
                    'rennes' => 'Rennes',
                    'reims' => 'Reims',
                    'saint-etienne' => 'Saint-Étienne',
                    'toulon' => 'Toulon',
                    'grenoble' => 'Grenoble',
                    'dijon' => 'Dijon'
                ];

                $communeName = $communeMapping[$request->commune] ?? $request->commune;
                $query->where('location', $communeName);
            }
            // Filtrage par catégorie
            elseif ($request->has('category') && $request->category !== 'all' && $request->category !== 'communes') {
                $query->where('category', $request->category);
            }
        }

        // Tri
        switch ($request->get('sort', 'likes')) {
            case 'likes':
                $query->mostLiked();
                break;
            case 'recent':
                $query->recent();
                break;
            default:
                $query->mostLiked();
        }

        $pictures = $query->get();

        if (Auth::check()) {

            /** @var User|null $user */
            $user = Auth::user();

            $pictures = $pictures->map(function ($picture) use ($user) {
                $picture->is_liked_by_user = $picture->isLikedBy($user);
                return $picture;
            });
        } else {
            $pictures = $pictures->map(function ($picture) {
                $picture->is_liked_by_user = false;
                return $picture;
            });
        }

        return response()->json($pictures);
    }

    public function like(Picture $picture)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez être connecté pour liker une photo'
            ], 401);
        }

        /** @var User|null $user */
        $user = Auth::user();

        if ($user->hasLiked($picture)) {
            return response()->json([
                'success' => false,
                'message' => 'Vous avez déjà liké cette photo',
                'likes_count' => $picture->likes_count,
                'is_liked' => true
            ]);
        }

        $user->likePicture($picture);
        $picture->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Photo likée avec succès',
            'likes_count' => $picture->likes_count,
            'is_liked' => true
        ]);
    }

    public function unlike(Picture $picture)
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Vous devez être connecté pour unliker une photo'
            ], 401);
        }

        /** @var User|null $user */
        $user = Auth::user();

        if (!$user->hasLiked($picture)) {
            return response()->json([
                'success' => false,
                'message' => 'Vous n\'avez pas liké cette photo',
                'likes_count' => $picture->likes_count,
                'is_liked' => false
            ]);
        }

        $user->unlikePicture($picture);
        $picture->refresh();

        return response()->json([
            'success' => true,
            'message' => 'Like retiré avec succès',
            'likes_count' => $picture->likes_count,
            'is_liked' => false
        ]);
    }

    public function userLikes()
    {
        if (!Auth::check()) {
            return response()->json([
                'success' => false,
                'message' => 'Non autorisé'
            ], 401);
        }

        /** @var User|null $user */
        $user = Auth::user();

        $likedPictures = $user->likedPictures()->with('likedByUsers')->get();

        return response()->json([
            'success' => true,
            'liked_pictures' => $likedPictures,
            'total_likes' => $likedPictures->count()
        ]);
    }

    public function showAddPicture()
    {
        return view("pictures.index");
    }

    public function addPicture(Request $request)
    {
        // Validation des données
        $validated = $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif|max:5120',
            'title' => 'required|string|max:255',
            'category' => 'required|string|in:Hôtels,Restaurants,Bars/Cafés,Activités,Immobilier,Monuments',
            'location' => 'required|string|max:255',
            'link' => 'nullable|url|max:255',
            'tags' => 'nullable|string'
        ], [
            'image.required' => 'L’image est obligatoire.',
            'image.image' => 'Le fichier doit être une image.',
            'image.mimes' => 'L’image doit être au format : jpeg, png, jpg ou gif.',
            'image.max' => 'La taille maximale de l’image est de 5 Mo.',

            'title.required' => 'Le titre est obligatoire.',
            'title.string' => 'Le titre doit être une chaîne de caractères.',
            'title.max' => 'Le titre ne peut pas dépasser 255 caractères.',

            'category.required' => 'La catégorie est obligatoire.',
            'category.string' => 'La catégorie doit être une chaîne de caractères.',
            'category.in' => 'La catégorie sélectionnée est invalide.',

            'location.required' => 'L’emplacement est obligatoire.',
            'location.string' => 'L’emplacement doit être une chaîne de caractères.',
            'location.max' => 'L’emplacement ne peut pas dépasser 255 caractères.',

            'link.url' => 'Le lien doit être une URL valide.',
            'link.max' => 'Le lien ne peut pas dépasser 255 caractères.',

            'tags.string' => 'Les tags doivent être une chaîne de caractères.',
        ]);

        try {
            // Traitement de l'image
            $imagePath = null;
            if ($request->hasFile('image')) {
                $image = $request->file('image');
                $imageName = time() . '_' . uniqid() . '.' . $image->getClientOriginalExtension();

                // Stockage dans le dossier public/images/photos
                $image->move(public_path('images/photos'), $imageName);
                $imagePath = 'images/photos/' . $imageName;
            }

            // Traitement des tags
            $tags = [];
            if ($request->filled('tags')) {
                $tagsData = json_decode($request->tags, true);
                if (is_array($tagsData) && count($tagsData) <= 3) {
                    $tags = array_slice($tagsData, 0, 3);
                }
            }

            // Création de la photo
            Picture::create([
                'title' => $validated['title'],
                'category' => $validated['category'],
                'location' => $validated['location'],
                'link' => $validated['link'],
                'image_path' => $imagePath,
                'tags' => json_encode($tags),
                'user_id' => Auth::id(),
                'likes_count' => 0
            ]);

            // Redirection avec message de succès
            return redirect()->route('home')->with('success', 'Votre photo a été publiée avec succès !');
        } catch (\Exception $e) {
            // En cas d'erreur, supprimer l'image si elle a été uploadée
            if (isset($imagePath) && file_exists(public_path($imagePath))) {
                unlink(public_path($imagePath));
            }

            return back()->withErrors(['error' => 'Une erreur est survenue lors de la publication de votre photo'])->withInput();
        }
    }
}
