<?php

namespace App\Http\Controllers;

use App\Models\Picture;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class AdminController extends Controller
{
    private function checkAdminAccess()
    {
        // Vérifier si l'utilisateur est connecté
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vous devez être connecté pour accéder à cette page.');
        }

        // Vérifier si le firstname est "administrateur" (insensible à la casse)
        if (strtolower(Auth::user()->firstname) !== 'administrateur') {
            abort(403, 'Accès non autorisé - Seuls les administrateurs peuvent accéder à cette page.');
        }
    }

    public function index()
    {
        $this->checkAdminAccess();
        
        // Récupérer toutes les images avec pagination
        $pictures = Picture::with('likedByUsers')
            ->orderBy('created_at', 'desc')
            ->paginate(20);

        // Calculer les statistiques
        $totalPictures = Picture::count();
        $totalLikes = Picture::sum('likes_count');
        // Supprimer le calcul des contributeurs car pas de user_id
        $totalContributors = 0; // Ou vous pouvez le calculer différemment si nécessaire
        $todayPictures = Picture::whereDate('created_at', today())->count();

        return view('admin.index', compact('pictures', 'totalPictures', 'totalLikes', 'totalContributors', 'todayPictures'));
    }

    public function deletePicture(Picture $picture)
    {
        $this->checkAdminAccess();
        
        try {
            // Supprimer le fichier image du serveur
            if ($picture->image_path && File::exists(public_path($picture->image_path))) {
                File::delete(public_path($picture->image_path));
            }

            // Supprimer les likes associés (la cascade delete s'en charge automatiquement)
            // Mais on peut aussi le faire manuellement si nécessaire
            $picture->likedByUsers()->detach();

            // Supprimer l'enregistrement de la base de données
            $picture->delete();

            return redirect()->route('admin.index')
                ->with('success', 'La photo "' . $picture->title . '" a été supprimée avec succès.');

        } catch (\Exception $e) {
            return redirect()->route('admin.index')
                ->with('error', 'Une erreur est survenue lors de la suppression de la photo : ' . $e->getMessage());
        }
    }

    public function bulkDelete(Request $request)
    {
        $this->checkAdminAccess();
        
        try {
            $pictureIds = $request->input('picture_ids', []);
            
            if (empty($pictureIds)) {
                return redirect()->route('admin.index')
                    ->with('error', 'Aucune photo sélectionnée.');
            }

            $pictures = Picture::whereIn('id', $pictureIds)->get();
            $deletedCount = 0;

            foreach ($pictures as $picture) {
                try {
                    // Supprimer le fichier image
                    if ($picture->image_path && File::exists(public_path($picture->image_path))) {
                        File::delete(public_path($picture->image_path));
                    }

                    // Supprimer les likes associés
                    $picture->likedByUsers()->detach();

                    // Supprimer l'enregistrement
                    $picture->delete();
                    $deletedCount++;

                } catch (\Exception $e) {
                    // Continuer avec les autres photos même si une échoue
                    continue;
                }
            }

            if ($deletedCount > 0) {
                return redirect()->route('admin.index')
                    ->with('success', $deletedCount . ' photo(s) supprimée(s) avec succès.');
            } else {
                return redirect()->route('admin.index')
                    ->with('error', 'Aucune photo n\'a pu être supprimée.');
            }

        } catch (\Exception $e) {
            return redirect()->route('admin.index')
                ->with('error', 'Une erreur est survenue lors de la suppression des photos : ' . $e->getMessage());
        }
    }

    /**
     * Obtenir les statistiques pour le dashboard
     */
    public function getStats()
    {
        $this->checkAdminAccess();

        return response()->json([
            'total_pictures' => Picture::count(),
            'total_likes' => Picture::sum('likes_count'),
            'total_contributors' => 0, // Pas de user_id dans votre table
            'today_pictures' => Picture::whereDate('created_at', today())->count(),
            'categories' => Picture::select('category')
                ->selectRaw('COUNT(*) as count')
                ->groupBy('category')
                ->get(),
            'recent_pictures' => Picture::latest()->take(5)->get(['id', 'title', 'image_path', 'created_at'])
        ]);
    }
}