<?php

namespace Database\Seeders;

use App\Models\Picture;
use Illuminate\Database\Seeder;

class PictureSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $pictures = [
            // PARIS - Monuments
            [
                'title' => 'Tour Eiffel illuminée au coucher du soleil',
                'image_path' => 'https://images.unsplash.com/photo-1502602898536-47ad22581b52?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Paris',
                'link' => 'https://fr.wikipedia.org/wiki/Tour_Eiffel',
                'tags' => json_encode(['#paris', '#toureiffel', '#monument']),
                'likes_count' => 1247
            ],
            [
                'title' => 'Basilique du Sacré-Cœur de Montmartre',
                'image_path' => 'https://images.unsplash.com/photo-1499856871958-5b9627545d1a?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Paris',
                'link' => 'https://fr.wikipedia.org/wiki/Basilique_du_Sacr%C3%A9-C%C5%93ur_de_Montmartre',
                'tags' => json_encode(['#paris', '#montmartre', '#basilique']),
                'likes_count' => 892
            ],
            [
                'title' => 'Arc de Triomphe sur les Champs-Élysées',
                'image_path' => 'https://images.unsplash.com/photo-1549144511-f099e773c147?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Paris',
                'link' => 'https://fr.wikipedia.org/wiki/Arc_de_triomphe',
                'tags' => json_encode(['#paris', '#arcdetriomphe', '#champselysees']),
                'likes_count' => 756
            ],
            [
                'title' => 'Cathédrale Notre-Dame de Paris',
                'image_path' => 'https://images.unsplash.com/photo-1543832923-44667a44c804?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Paris',
                'link' => 'https://fr.wikipedia.org/wiki/Cath%C3%A9drale_Notre-Dame_de_Paris',
                'tags' => json_encode(['#paris', '#notredame', '#cathédrale']),
                'likes_count' => 1089
            ],

            // PARIS - Restaurants
            [
                'title' => 'Bistrot parisien traditionnel',
                'image_path' => 'https://images.unsplash.com/photo-1517248135467-4c7edcad34c4?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Paris',
                'link' => null,
                'tags' => json_encode(['#bistrot', '#paris', '#gastronomie']),
                'likes_count' => 423
            ],
            [
                'title' => 'Restaurant gastronomique étoilé',
                'image_path' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Paris',
                'link' => null,
                'tags' => json_encode(['#gastronomie', '#paris', '#étoilé']),
                'likes_count' => 687
            ],

            // PARIS - Hôtels
            [
                'title' => 'Hôtel de luxe parisien',
                'image_path' => 'https://images.unsplash.com/photo-1566073771259-6a8506099945?w=800&h=600&fit=crop&q=80',
                'category' => 'Hôtels',
                'location' => 'Paris',
                'link' => null,
                'tags' => json_encode(['#hôtel', '#luxe', '#paris']),
                'likes_count' => 678
            ],
            [
                'title' => 'Palace parisien historique',
                'image_path' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&h=600&fit=crop&q=80',
                'category' => 'Hôtels',
                'location' => 'Paris',
                'link' => null,
                'tags' => json_encode(['#palace', '#paris', '#historique']),
                'likes_count' => 834
            ],

            // PARIS - Bars/Cafés
            [
                'title' => 'Café de quartier parisien',
                'image_path' => 'https://images.unsplash.com/photo-1559925393-8be0ec4767c8?w=800&h=600&fit=crop&q=80',
                'category' => 'Bars/Cafés',
                'location' => 'Paris',
                'link' => null,
                'tags' => json_encode(['#café', '#paris', '#quartier']),
                'likes_count' => 324
            ],
            [
                'title' => 'Bar à cocktails parisien',
                'image_path' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800&h=600&fit=crop&q=80',
                'category' => 'Bars/Cafés',
                'location' => 'Paris',
                'link' => null,
                'tags' => json_encode(['#bar', '#paris', '#cocktails']),
                'likes_count' => 456
            ],

            // PARIS - Immobilier
            [
                'title' => 'Appartement moderne vue Tour Eiffel',
                'image_path' => 'https://images.unsplash.com/photo-1564013799919-ab600027ffc6?w=800&h=600&fit=crop&q=80',
                'category' => 'Immobilier',
                'location' => 'Paris',
                'link' => null,
                'tags' => json_encode(['#appartement', '#paris', '#moderne']),
                'likes_count' => 834
            ],
            [
                'title' => 'Loft parisien rénové',
                'image_path' => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800&h=600&fit=crop&q=80',
                'category' => 'Immobilier',
                'location' => 'Paris',
                'link' => null,
                'tags' => json_encode(['#loft', '#paris', '#rénové']),
                'likes_count' => 567
            ],

            // LYON - Monuments
            [
                'title' => 'Basilique Notre-Dame de Fourvière',
                'image_path' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Lyon',
                'link' => 'https://fr.wikipedia.org/wiki/Basilique_Notre-Dame_de_Fourvi%C3%A8re',
                'tags' => json_encode(['#lyon', '#basilique', '#fourvière']),
                'likes_count' => 634
            ],
            [
                'title' => 'Vieux Lyon Renaissance',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Lyon',
                'link' => null,
                'tags' => json_encode(['#lyon', '#vieuxlyon', '#renaissance']),
                'likes_count' => 445
            ],

            // LYON - Restaurants
            [
                'title' => 'Bouchon lyonnais authentique',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Lyon',
                'link' => null,
                'tags' => json_encode(['#bouchon', '#lyon', '#tradition']),
                'likes_count' => 367
            ],
            [
                'title' => 'Restaurant gastronomique lyonnais',
                'image_path' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Lyon',
                'link' => null,
                'tags' => json_encode(['#gastronomie', '#lyon', '#cuisine']),
                'likes_count' => 523
            ],

            // LYON - Bars/Cafés
            [
                'title' => 'Bistrot lyonnais convivial',
                'image_path' => 'https://images.unsplash.com/photo-1501339847302-ac426bb46781?w=800&h=600&fit=crop&q=80',
                'category' => 'Bars/Cafés',
                'location' => 'Lyon',
                'link' => null,
                'tags' => json_encode(['#bistrot', '#lyon', '#convivial']),
                'likes_count' => 198
            ],

            // LYON - Immobilier
            [
                'title' => 'Loft industriel rénové',
                'image_path' => 'https://images.unsplash.com/photo-1570129477492-45c003edd2be?w=800&h=600&fit=crop&q=80',
                'category' => 'Immobilier',
                'location' => 'Lyon',
                'link' => null,
                'tags' => json_encode(['#loft', '#lyon', '#industriel']),
                'likes_count' => 423
            ],

            // MARSEILLE - Monuments
            [
                'title' => 'Basilique Notre-Dame de la Garde',
                'image_path' => 'https://images.unsplash.com/photo-1539650116574-75c0c6d93d5e?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Marseille',
                'link' => null,
                'tags' => json_encode(['#marseille', '#basilique', '#garde']),
                'likes_count' => 567
            ],
            [
                'title' => 'Vieux Port de Marseille',
                'image_path' => 'https://images.unsplash.com/photo-1508747703725-719777637510?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Marseille',
                'link' => null,
                'tags' => json_encode(['#marseille', '#vieuxport', '#port']),
                'likes_count' => 789
            ],

            // MARSEILLE - Restaurants
            [
                'title' => 'Restaurant méditerranéen au Vieux Port',
                'image_path' => 'https://images.unsplash.com/photo-1414235077428-338989a2e8c0?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Marseille',
                'link' => null,
                'tags' => json_encode(['#marseille', '#méditerranéen', '#vieuxport']),
                'likes_count' => 289
            ],
            [
                'title' => 'Bouillabaisse authentique',
                'image_path' => 'https://images.unsplash.com/photo-1565299624946-b28f40a0ca4b?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Marseille',
                'link' => null,
                'tags' => json_encode(['#bouillabaisse', '#marseille', '#poisson']),
                'likes_count' => 456
            ],

            // MARSEILLE - Bars/Cafés
            [
                'title' => 'Café avec vue sur le port',
                'image_path' => 'https://images.unsplash.com/photo-1516997121675-4c2d1684aa3e?w=800&h=600&fit=crop&q=80',
                'category' => 'Bars/Cafés',
                'location' => 'Marseille',
                'link' => null,
                'tags' => json_encode(['#café', '#marseille', '#port']),
                'likes_count' => 456
            ],

            // TOULOUSE - Monuments
            [
                'title' => 'Basilique Saint-Sernin de Toulouse',
                'image_path' => 'https://images.unsplash.com/photo-1513475382585-d06e58bcb0e0?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Toulouse',
                'link' => null,
                'tags' => json_encode(['#toulouse', '#basilique', '#saintsernin']),
                'likes_count' => 334
            ],
            [
                'title' => 'Capitole de Toulouse',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Toulouse',
                'link' => null,
                'tags' => json_encode(['#toulouse', '#capitole', '#place']),
                'likes_count' => 445
            ],

            // TOULOUSE - Restaurants
            [
                'title' => 'Restaurant toulousain traditionnel',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Toulouse',
                'link' => null,
                'tags' => json_encode(['#toulouse', '#cassoulet', '#tradition']),
                'likes_count' => 298
            ],

            // TOULOUSE - Bars/Cafés
            [
                'title' => 'Café brunch moderne',
                'image_path' => 'https://images.unsplash.com/photo-1572116469696-31de0f17cc34?w=800&h=600&fit=crop&q=80',
                'category' => 'Bars/Cafés',
                'location' => 'Toulouse',
                'link' => null,
                'tags' => json_encode(['#café', '#toulouse', '#brunch']),
                'likes_count' => 387
            ],

            // NICE - Monuments
            [
                'title' => 'Promenade des Anglais',
                'image_path' => 'https://images.unsplash.com/photo-1539650116574-75c0c6d93d5e?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Nice',
                'link' => null,
                'tags' => json_encode(['#nice', '#promenade', '#anglais']),
                'likes_count' => 678
            ],
            [
                'title' => 'Vieux Nice coloré',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Nice',
                'link' => null,
                'tags' => json_encode(['#nice', '#vieuxnice', '#coloré']),
                'likes_count' => 534
            ],

            // NICE - Restaurants
            [
                'title' => 'Terrasse restaurant avec vue sur la Promenade',
                'image_path' => 'https://images.unsplash.com/photo-1600891964092-4316c288032e?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Nice',
                'link' => null,
                'tags' => json_encode(['#nice', '#terrasse', '#promenade']),
                'likes_count' => 512
            ],

            // NICE - Immobilier
            [
                'title' => 'Studio vue mer à Nice',
                'image_path' => 'https://images.unsplash.com/photo-1605146769289-440113cc3d00?w=800&h=600&fit=crop&q=80',
                'category' => 'Immobilier',
                'location' => 'Nice',
                'link' => null,
                'tags' => json_encode(['#studio', '#nice', '#mer']),
                'likes_count' => 445
            ],

            // NANTES - Monuments
            [
                'title' => 'Château des Ducs de Bretagne',
                'image_path' => 'https://images.unsplash.com/photo-1583422409516-2895a77efded?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Nantes',
                'link' => null,
                'tags' => json_encode(['#nantes', '#château', '#bretagne']),
                'likes_count' => 423
            ],
            [
                'title' => 'Machines de l\'île de Nantes',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Nantes',
                'link' => null,
                'tags' => json_encode(['#nantes', '#machines', '#île']),
                'likes_count' => 567
            ],

            // NANTES - Restaurants
            [
                'title' => 'Restaurant nantais moderne',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Nantes',
                'link' => null,
                'tags' => json_encode(['#nantes', '#moderne', '#cuisine']),
                'likes_count' => 234
            ],

            // STRASBOURG - Monuments
            [
                'title' => 'Cathédrale Notre-Dame de Strasbourg',
                'image_path' => 'https://images.unsplash.com/photo-1543832923-44667a44c804?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Strasbourg',
                'link' => null,
                'tags' => json_encode(['#strasbourg', '#cathédrale', '#notredame']),
                'likes_count' => 678
            ],
            [
                'title' => 'Petite France Strasbourg',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Strasbourg',
                'link' => null,
                'tags' => json_encode(['#strasbourg', '#petitefrance', '#quartier']),
                'likes_count' => 445
            ],

            // STRASBOURG - Restaurants
            [
                'title' => 'Restaurant alsacien traditionnel',
                'image_path' => 'https://images.unsplash.com/photo-1544148103-0773bf10d330?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Strasbourg',
                'link' => null,
                'tags' => json_encode(['#strasbourg', '#alsace', '#traditionnel']),
                'likes_count' => 234
            ],

            // MONTPELLIER - Monuments
            [
                'title' => 'Place de la Comédie Montpellier',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Montpellier',
                'link' => null,
                'tags' => json_encode(['#montpellier', '#comédie', '#place']),
                'likes_count' => 356
            ],

            // MONTPELLIER - Restaurants
            [
                'title' => 'Restaurant méditerranéen Montpellier',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Montpellier',
                'link' => null,
                'tags' => json_encode(['#montpellier', '#méditerranéen', '#cuisine']),
                'likes_count' => 287
            ],

            // BORDEAUX - Monuments
            [
                'title' => 'Place de la Bourse Bordeaux',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Bordeaux',
                'link' => null,
                'tags' => json_encode(['#bordeaux', '#bourse', '#place']),
                'likes_count' => 678
            ],
            [
                'title' => 'Cathédrale Saint-André de Bordeaux',
                'image_path' => 'https://images.unsplash.com/photo-1543832923-44667a44c804?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Bordeaux',
                'link' => null,
                'tags' => json_encode(['#bordeaux', '#cathédrale', '#saintandré']),
                'likes_count' => 445
            ],

            // BORDEAUX - Restaurants
            [
                'title' => 'Restaurant bordelais gastronomique',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Bordeaux',
                'link' => null,
                'tags' => json_encode(['#bordeaux', '#gastronomique', '#cuisine']),
                'likes_count' => 456
            ],

            // BORDEAUX - Bars/Cafés
            [
                'title' => 'Bar à vins bordelais',
                'image_path' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800&h=600&fit=crop&q=80',
                'category' => 'Bars/Cafés',
                'location' => 'Bordeaux',
                'link' => null,
                'tags' => json_encode(['#bar', '#bordeaux', '#vins']),
                'likes_count' => 289
            ],

            // BORDEAUX - Immobilier
            [
                'title' => 'Maison en pierre bordelaise',
                'image_path' => 'https://images.unsplash.com/photo-1449844908441-8829872d2607?w=800&h=600&fit=crop&q=80',
                'category' => 'Immobilier',
                'location' => 'Bordeaux',
                'link' => null,
                'tags' => json_encode(['#maison', '#bordeaux', '#pierre']),
                'likes_count' => 567
            ],

            // LILLE - Monuments
            [
                'title' => 'Vieille Bourse de Lille',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Lille',
                'link' => null,
                'tags' => json_encode(['#lille', '#bourse', '#vieille']),
                'likes_count' => 234
            ],
            [
                'title' => 'Beffroi de Lille',
                'image_path' => 'https://images.unsplash.com/photo-1543832923-44667a44c804?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Lille',
                'link' => null,
                'tags' => json_encode(['#lille', '#beffroi', '#monument']),
                'likes_count' => 345
            ],

            // LILLE - Restaurants
            [
                'title' => 'Estaminet lillois traditionnel',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Lille',
                'link' => null,
                'tags' => json_encode(['#lille', '#estaminet', '#traditionnel']),
                'likes_count' => 198
            ],

            // RENNES - Monuments
            [
                'title' => 'Parlement de Bretagne',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Rennes',
                'link' => null,
                'tags' => json_encode(['#rennes', '#parlement', '#bretagne']),
                'likes_count' => 289
            ],
            [
                'title' => 'Maisons à pans de bois',
                'image_path' => 'https://images.unsplash.com/photo-1505142468610-359e7d316be0?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Rennes',
                'link' => null,
                'tags' => json_encode(['#rennes', '#colombages', '#historique']),
                'likes_count' => 367
            ],

            // RENNES - Restaurants
            [
                'title' => 'Crêperie rennaise authentique',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Rennes',
                'link' => null,
                'tags' => json_encode(['#rennes', '#crêperie', '#bretagne']),
                'likes_count' => 234
            ],

            // REIMS - Monuments
            [
                'title' => 'Cathédrale Notre-Dame de Reims',
                'image_path' => 'https://images.unsplash.com/photo-1543832923-44667a44c804?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Reims',
                'link' => null,
                'tags' => json_encode(['#reims', '#cathédrale', '#sacre']),
                'likes_count' => 567
            ],
            [
                'title' => 'Palais du Tau',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Reims',
                'link' => null,
                'tags' => json_encode(['#reims', '#palais', '#tau']),
                'likes_count' => 345
            ],

            // REIMS - Restaurants
            [
                'title' => 'Restaurant champenois',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Reims',
                'link' => null,
                'tags' => json_encode(['#reims', '#champagne', '#gastronomie']),
                'likes_count' => 298
            ],

            // SAINT-ÉTIENNE - Monuments
            [
                'title' => 'Musée d\'Art Moderne Saint-Étienne',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Saint-Étienne',
                'link' => null,
                'tags' => json_encode(['#saintetienne', '#musée', '#moderne']),
                'likes_count' => 234
            ],
            [
                'title' => 'Stade Geoffroy-Guichard',
                'image_path' => 'https://images.unsplash.com/photo-1508747703725-719777637510?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Saint-Étienne',
                'link' => null,
                'tags' => json_encode(['#saintetienne', '#stade', '#football']),
                'likes_count' => 456
            ],

            // SAINT-ÉTIENNE - Restaurants
            [
                'title' => 'Restaurant stéphanois traditionnel',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Saint-Étienne',
                'link' => null,
                'tags' => json_encode(['#saintetienne', '#traditionnel', '#cuisine']),
                'likes_count' => 189
            ],

            // TOULON - Monuments
            [
                'title' => 'Port de Toulon',
                'image_path' => 'https://images.unsplash.com/photo-1508747703725-719777637510?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Toulon',
                'link' => null,
                'tags' => json_encode(['#toulon', '#port', '#marine']),
                'likes_count' => 345
            ],
            [
                'title' => 'Cathédrale Sainte-Marie de Toulon',
                'image_path' => 'https://images.unsplash.com/photo-1543832923-44667a44c804?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Toulon',
                'link' => null,
                'tags' => json_encode(['#toulon', '#cathédrale', '#saintemarie']),
                'likes_count' => 267
            ],

            // TOULON - Restaurants
            [
                'title' => 'Restaurant méditerranéen Toulon',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Toulon',
                'link' => null,
                'tags' => json_encode(['#toulon', '#méditerranéen', '#poisson']),
                'likes_count' => 234
            ],

            // GRENOBLE - Monuments
            [
                'title' => 'Téléphérique de Grenoble Bastille',
                'image_path' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Grenoble',
                'link' => null,
                'tags' => json_encode(['#grenoble', '#téléphérique', '#bastille']),
                'likes_count' => 567
            ],
            [
                'title' => 'Vieille ville de Grenoble',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Grenoble',
                'link' => null,
                'tags' => json_encode(['#grenoble', '#vieilleville', '#alpes']),
                'likes_count' => 423
            ],

            // GRENOBLE - Restaurants
            [
                'title' => 'Restaurant alpin Grenoble',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Grenoble',
                'link' => null,
                'tags' => json_encode(['#grenoble', '#alpin', '#montagne']),
                'likes_count' => 298
            ],

            // GRENOBLE - Activités
            [
                'title' => 'Randonnée autour de Grenoble',
                'image_path' => 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=800&h=600&fit=crop&q=80',
                'category' => 'Activités',
                'location' => 'Grenoble',
                'link' => null,
                'tags' => json_encode(['#grenoble', '#randonnée', '#alpes']),
                'likes_count' => 456
            ],

            // DIJON - Monuments
            [
                'title' => 'Palais des Ducs de Bourgogne',
                'image_path' => 'https://images.unsplash.com/photo-1571677227640-8d4b2b8d1c7d?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Dijon',
                'link' => null,
                'tags' => json_encode(['#dijon', '#palais', '#bourgogne']),
                'likes_count' => 345
            ],
            [
                'title' => 'Église Notre-Dame de Dijon',
                'image_path' => 'https://images.unsplash.com/photo-1543832923-44667a44c804?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Dijon',
                'link' => null,
                'tags' => json_encode(['#dijon', '#église', '#notredame']),
                'likes_count' => 267
            ],

            // DIJON - Restaurants
            [
                'title' => 'Restaurant bourguignon traditionnel',
                'image_path' => 'https://images.unsplash.com/photo-1559339352-11d035aa65de?w=800&h=600&fit=crop&q=80',
                'category' => 'Restaurants',
                'location' => 'Dijon',
                'link' => null,
                'tags' => json_encode(['#dijon', '#bourguignon', '#escargots']),
                'likes_count' => 234
            ],

            // DIJON - Bars/Cafés
            [
                'title' => 'Bar à vins dijonnais',
                'image_path' => 'https://images.unsplash.com/photo-1554118811-1e0d58224f24?w=800&h=600&fit=crop&q=80',
                'category' => 'Bars/Cafés',
                'location' => 'Dijon',
                'link' => null,
                'tags' => json_encode(['#dijon', '#bar', '#vins']),
                'likes_count' => 198
            ],

            // ACTIVITÉS DIVERSES
            [
                'title' => 'Pistes de ski à Chamonix',
                'image_path' => 'https://images.unsplash.com/photo-1544735716-392fe2489ffa?w=800&h=600&fit=crop&q=80',
                'category' => 'Activités',
                'location' => 'Chamonix',
                'link' => null,
                'tags' => json_encode(['#ski', '#chamonix', '#alpes']),
                'likes_count' => 723
            ],
            [
                'title' => 'Paddle sur le lac d\'Annecy',
                'image_path' => 'https://images.unsplash.com/photo-1506905925346-21bda4d32df4?w=800&h=600&fit=crop&q=80',
                'category' => 'Activités',
                'location' => 'Annecy',
                'link' => null,
                'tags' => json_encode(['#paddle', '#annecy', '#lac']),
                'likes_count' => 542
            ],
            [
                'title' => 'Surf à Biarritz',
                'image_path' => 'https://images.unsplash.com/photo-1571019613454-1cb2f99b2d8b?w=800&h=600&fit=crop&q=80',
                'category' => 'Activités',
                'location' => 'Biarritz',
                'link' => null,
                'tags' => json_encode(['#surf', '#biarritz', '#océan']),
                'likes_count' => 612
            ],
            [
                'title' => 'Randonnée dans les champs de lavande',
                'image_path' => 'https://images.unsplash.com/photo-1544966503-7cc5ac882d5f?w=800&h=600&fit=crop&q=80',
                'category' => 'Activités',
                'location' => 'Provence',
                'link' => null,
                'tags' => json_encode(['#randonnée', '#provence', '#lavande']),
                'likes_count' => 789
            ],
            [
                'title' => 'Vélo dans la vallée de la Loire',
                'image_path' => 'https://images.unsplash.com/photo-1558618666-fcd25c85cd64?w=800&h=600&fit=crop&q=80',
                'category' => 'Activités',
                'location' => 'Loire',
                'link' => null,
                'tags' => json_encode(['#vélo', '#loire', '#châteaux']),
                'likes_count' => 456
            ],

            // HÔTELS DIVERS
            [
                'title' => 'Palace sur la Croisette',
                'image_path' => 'https://images.unsplash.com/photo-1571003123894-1f0594d2b5d9?w=800&h=600&fit=crop&q=80',
                'category' => 'Hôtels',
                'location' => 'Cannes',
                'link' => null,
                'tags' => json_encode(['#cannes', '#palace', '#croisette']),
                'likes_count' => 834
            ],
            [
                'title' => 'Château-hôtel dans la vallée de la Loire',
                'image_path' => 'https://images.unsplash.com/photo-1578662996442-48f60103fc96?w=800&h=600&fit=crop&q=80',
                'category' => 'Hôtels',
                'location' => 'Loire',
                'link' => null,
                'tags' => json_encode(['#château', '#loire', '#romantique']),
                'likes_count' => 445
            ],
            [
                'title' => 'Hôtel boutique vue lac d\'Annecy',
                'image_path' => 'https://images.unsplash.com/photo-1582719478250-c89cae4dc85b?w=800&h=600&fit=crop&q=80',
                'category' => 'Hôtels',
                'location' => 'Annecy',
                'link' => null,
                'tags' => json_encode(['#annecy', '#lac', '#boutique']),
                'likes_count' => 567
            ],
            [
                'title' => 'Hôtel face à l\'océan Atlantique',
                'image_path' => 'https://images.unsplash.com/photo-1584132967334-10e028bd69f7?w=800&h=600&fit=crop&q=80',
                'category' => 'Hôtels',
                'location' => 'Biarritz',
                'link' => null,
                'tags' => json_encode(['#biarritz', '#océan', '#surf']),
                'likes_count' => 398
            ],

            // IMMOBILIER DIVERS
            [
                'title' => 'Villa provençale avec piscine',
                'image_path' => 'https://images.unsplash.com/photo-1512917774080-9991f1c4c750?w=800&h=600&fit=crop&q=80',
                'category' => 'Immobilier',
                'location' => 'Provence',
                'link' => null,
                'tags' => json_encode(['#villa', '#provence', '#piscine']),
                'likes_count' => 1156
            ],
            [
                'title' => 'Maison de charme normande',
                'image_path' => 'https://images.unsplash.com/photo-1505142468610-359e7d316be0?w=800&h=600&fit=crop&q=80',
                'category' => 'Immobilier',
                'location' => 'Normandie',
                'link' => null,
                'tags' => json_encode(['#maison', '#normandie', '#charme']),
                'likes_count' => 678
            ],
            [
                'title' => 'Château de Versailles et ses jardins',
                'image_path' => 'https://images.unsplash.com/photo-1583422409516-2895a77efded?w=800&h=600&fit=crop&q=80',
                'category' => 'Monuments',
                'location' => 'Versailles',
                'link' => 'https://fr.wikipedia.org/wiki/Ch%C3%A2teau_de_Versailles',
                'tags' => json_encode(['#versailles', '#château', '#jardins']),
                'likes_count' => 1089
            ]
        ];

        foreach ($pictures as $picture) {
            Picture::create($picture);
        }
    }
}