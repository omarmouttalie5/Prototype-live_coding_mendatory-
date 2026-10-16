<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Administration - Fashion Store</title>
    <!-- Importation simplifiée de Tailwind CSS via CDN pour l'apprentissage -->
    <script src="https://cdn.tailwindcss.com"></script>
    <!-- Configuration des couleurs primaires (optionnel, mais garde la maquette jolie) -->
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
            <h2 class="text-xl font-bold">Fashion Admin</h2>
            <p class="text-xs text-primary-500 mt-1 uppercase font-semibold tracking-wider">Store</p>
        </div>
        <nav class="flex-1 p-4 space-y-2">
            <a href="#" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-800 hover:text-white transition-colors">Sales dashboard</a>
            <a href="#" class="block px-4 py-2 rounded text-gray-400 hover:bg-gray-800 hover:text-white transition-colors">Orders</a>
            <!-- Lien actif -->
            <a href="#" class="block px-4 py-2 rounded bg-primary-600 text-white font-medium">Produits Mode</a>
        </nav>
    </aside>

    <!-- CONTENU PRINCIPAL -->
    <div class="flex-1 flex flex-col h-screen overflow-hidden">
        
        <!-- ENTÊTE (Header) -->
        <header class="bg-white h-16 border-b border-gray-200 flex items-center justify-between px-6">
            <div class="font-medium text-gray-600">
                Add and manage products
            </div>
            <div class="flex items-center gap-2">
                <span class="text-sm font-semibold">Admin</span>
            </div>
        </header>

        <!-- ZONE DE TRAVAIL (Main) -->
        <main class="flex-1 overflow-y-auto p-6 bg-gray-50">
            <div class="max-w-5xl mx-auto space-y-8">
                
                <!-- SECTION 1 : EN-TÊTE DE LA PAGE -->
                <div class="flex justify-between items-center">
                    <div>
                        <h1 class="text-2xl font-bold text-gray-900">Products</h1>
                        <p class="text-sm text-gray-500">Add and manage products.</p>
                    </div>
                    <!-- Bouton pour afficher le formulaire -->
                    <button id="btn-show-form" class="bg-primary-600 text-white px-4 py-2 rounded shadow hover:bg-primary-700 transition">
                        + New product
                    </button>
                </div>

                <!-- SECTION 2 : FORMULAIRE D'AJOUT/MODIFICATION (Caché par défaut) -->
                <div id="section-form" class="bg-white p-6 rounded-lg shadow-sm border border-gray-200 hidden">
                    <h2 class="text-lg font-bold mb-4">Add a New Product</h2>
                    <form id="form-categorie" class="space-y-4">
                        <!-- Champ caché pour l'ID -->
                        <input type="hidden" id="cat-id" value="">
                        
                        <!-- Champ Nom -->
                        <div>
                            <label for="cat-nom" class="block text-sm font-semibold text-gray-700 mb-1">name of the product</label>
                            <input type="text" id="cat-nom" required placeholder="Ex: Summer White T-shirt" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                        </div>

                        <!-- Champs Prix et Taille -->
                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                            <div>
                                <label for="cat-couleur" class="block text-sm font-semibold text-gray-700 mb-1">Price ($)</label>
                                <input type="text" id="cat-couleur" required placeholder="Ex: 89.99" 
                                    class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                            </div>
                            <div>
                                <label for="cat-icone" class="block text-sm font-semibold text-gray-700 mb-1">Size</label>
                                <select id="cat-icone" required class="w-full px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-primary-500">
                                    <option value="">-- Choose a Size --</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                </select>
                            </div>
                        </div>

                        <!-- Boutons d'action -->
                        <div class="flex justify-end gap-2 mt-4">
                            <button type="button" id="btn-cancel-form" class="px-4 py-2 text-gray-600 border border-gray-300 rounded hover:bg-gray-100 transition">
                                Cancel
                            </button>
                            <button type="submit" class="px-4 py-2 bg-primary-600 text-white rounded hover:bg-primary-700 transition">
                                Save
                            </button>
                        </div>
                    </form>
                </div>

                <!-- SECTION 3 : LISTE DES PRODUITS -->
                <div class="bg-white rounded-lg shadow-sm border border-gray-200 overflow-hidden">
                    <table class="w-full text-left border-collapse">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="p-4 text-sm font-semibold text-gray-500 uppercase">ID</th>
                                <th class="p-4 text-sm font-semibold text-gray-500 uppercase">Name</th>
                                <th class="p-4 text-sm font-semibold text-gray-500 uppercase">Price / Size</th>
                            </tr>
                        </thead>
                        <tbody id="table-categories-body" class="divide-y divide-gray-100">
                            <!-- Les données seront injectées ici par JavaScript -->
                        </tbody>
                    </table>
                </div>

            </div>
        </main>
    </div>

    <!-- Script SPA -->
    <script src="assets/js/app.js"></script>
</body>
</html>