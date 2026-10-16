<?php
require_once 'Category.php';

$categoryModel = new Category('categories.json');
$message = '';

// Handle Form Submission (Add Operation)
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'add') {
    $nom = $_POST['nom'] ?? '';
    $couleur = $_POST['couleur'] ?? '';
    $icone = $_POST['icone'] ?? '';

    if (!empty($nom) && !empty($couleur) && !empty($icone)) {
        $categoryModel->add($nom, $couleur, $icone);
        header('Location: index.php?success=1');
        exit;
    } else {
        $message = "Veuillez remplir tous les champs obligatoires.";
    }
}

// Fetch all categories for the table display (Read Operation)
$categories = $categoryModel->getAll();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Blog Spartel</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: { primary: { 50: '#f0f6ff', 500: '#2673e8', 600: '#1c5bba', 900: '#0a2042' } }
                }
            }
        }
    </script>
</head>
<body class="bg-gray-100 text-gray-800 flex h-screen overflow-hidden">

    <!-- BARRE LATÉRALE (Sidebar) -->
    <aside class="w-64 bg-gray-900 text-white flex flex-col hidden md:flex">
        <div class="p-6 border-b border-gray-800">
            <h2 class="text-xl font-bold">Admin Blog</h2>
            <p class="text-xs text-primary-500 mt-1 uppercase font-semibold tracking-wider">Sprint 1</p>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="#" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-800 hover:text-white transition-colors">Tableau de bord</a>
            <a href="#" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-800 hover:text-white transition-colors">Articles</a>
            <a href="#" class="block px-4 py-2 rounded bg-primary-600 text-white font-medium">Catégories</a>
        </nav>
    </aside>

    <!-- CONTENU PRINCIPAL -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <!-- ENTÊTE (Header) -->
        <header class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-6">
            <div class="font-medium text-gray-600">
                Gestion des catégories
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm font-semibold">Admin</span>
            </div>
        </header>

        <!-- ZONE DE TRAVAIL (Main) -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            <div class="max-w-5xl mx-auto space-y-8">
                
                <?php if (isset($_GET['success'])): ?>
                    <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded relative">
                        Catégorie ajoutée avec succès !
                    </div>
                <?php endif; ?>

                <?php if (!empty($message)): ?>
                    <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative">
                        <?= htmlspecialchars($message) ?>
                    </div>
                <?php endif; ?>

                <!-- SECTION 1 : EN-TÊTE DE LA PAGE -->
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Catégories</h1>
                        <p class="text-sm text-gray-500">Organisez les rubriques de votre blog.</p>
                    </div>
                    <button id="btn-show-form" class="bg-primary-600 text-white px-4 py-2 rounded shadow hover:bg-primary-700 transition">
                        + Nouvelle Catégorie
                    </button>
                </div>

                <!-- SECTION 2 : FORMULAIRE D'AJOUT (Caché par défaut) -->
                <div id="section-form" class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hidden">
                    <h2 class="text-lg font-bold mb-4">Ajouter une catégorie</h2>
                    <form id="form-categorie" method="POST" class="space-y-4">
                        <input type="hidden" name="action" value="add">
                        
                        <!-- Champ Nom -->
                        <div>
                            <label for="cat-nom" class="block text-sm font-semibold text-gray-700 mb-1">Nom de la catégorie</label>
                            <input type="text" id="cat-nom" name="nom" required placeholder="Ex: Développement Web" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>

                        <!-- Champs Couleur et Icône -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cat-couleur" class="block text-sm font-semibold text-gray-700 mb-1">Couleur</label>
                                <select id="cat-couleur" name="couleur" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    <option value="">-- Choisir une couleur --</option>
                                    <option value="Bleu">Bleu</option>
                                    <option value="Rose">Rose</option>
                                    <option value="Emeraude">Émeraude</option>
                                    <option value="Violet">Violet</option>
                                </select>
                            </div>
                            <div>
                                <label for="cat-icone" class="block text-sm font-semibold text-gray-700 mb-1">Icône</label>
                                <select id="cat-icone" name="icone" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    <option value="">-- Choisir une icône --</option>
                                    <option value="Code">Code</option>
                                    <option value="Pinceau">Pinceau / Crayon</option>
                                    <option value="Eclair">Éclair</option>
                                    <option value="Livre">Livre</option>
                                </select>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="flex justify-end gap-2 mt-4">
                            <button type="button" id="btn-cancel-form" class="px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-100 transition">
                                Annuler
                            </button>
                            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded hover:bg-primary-700 transition">
                                Enregistrer
                            </button>
                        </div>
                    </form>
                </div>

                <!-- SECTION 3 : LISTE DES CATÉGORIES -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 text-sm font-semibold text-gray-500 uppercase">ID</th>
                                <th class="p-4 text-sm font-semibold text-gray-500 uppercase">Nom</th>
                                <th class="p-4 text-sm font-semibold text-gray-500 uppercase">Couleur / Icône</th>
                                <th class="p-4 text-sm font-semibold text-gray-500 uppercase text-right">Actions</th>
                            </tr>
                        </thead>
                        <tbody id="table-categories-body" class="divide-y divide-gray-100">
                            <?php if (empty($categories)): ?>
                                <tr>
                                    <td colspan="4" class="p-4 text-center text-gray-500">Aucune catégorie trouvée.</td>
                                </tr>
                            <?php else: ?>
                                <?php foreach ($categories as $cat): ?>
                                    <tr class="hover:bg-gray-50">
                                        <td class="p-4 font-mono text-sm text-gray-600"><?= $cat['id'] ?></td>
                                        <td class="p-4 font-medium text-gray-900"><?= htmlspecialchars($cat['nom']) ?></td>
                                        <td class="p-4 text-sm text-gray-600">
                                            <span class="inline-block px-2 py-1 bg-gray-100 rounded text-xs mr-2"><?= htmlspecialchars($cat['couleur']) ?></span>
                                            <span class="text-xs text-gray-400"><?= htmlspecialchars($cat['icone']) ?></span>
                                        </td>
                                        <td class="p-4 text-right">
                                            <span class="text-sm text-gray-400 italic">Lecture seule</span>
                                        </td>
                                    </tr>
                                <?php endforeach; ?>
                            <?php endif; ?>
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>

    <!-- Script minimaliste pour basculer l'affichage du formulaire -->
    <script>
        const btnShowForm = document.getElementById('btn-show-form');
        const btnCancelForm = document.getElementById('btn-cancel-form');
        const sectionForm = document.getElementById('section-form');

        btnShowForm.addEventListener('click', () => {
            sectionForm.classList.toggle('hidden');
        });

        btnCancelForm.addEventListener('click', () => {
            sectionForm.classList.add('hidden');
        });
    </script>
</body>
</html>