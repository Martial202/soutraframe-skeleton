
connexion();// connexion


addFamille(); // Famille
addCategorie(); // Categorie
editFamille() // edit famille
editCategorie() // edit categorie
addProduit() // add Produit
editProduit() // edit Produit
addLivreur() // add livreur
editLivreur() // edit livreur
addLivraison() // add livraison
checkLivraison() // add livraison
addImages() // add image
addArticleBlog() // add ArticleBlog
editArticleBlog() // edit ArticleBlog
editUsers() // edit users
modifPassword() // edit password user
createPagination('#paginationControls', '.element-item', 6);
countNewElement(".newCommandeCount", 'commandeController/countNew',"#dotNewCommande"); // Compte les nouvelles commandes
countNewElement(".newDevisCount", 'devisController/countNew',"#dotNewDevis"); // Compte les nouvelles commandes
setInterval(function() {
    countNewElement(".newCommandeCount", 'commandeController/countNew', "#dotNewCommande");
    // Ajoute ici ta deuxième fonction, par exemple :
    countNewElement(".newDevisCount", 'devisController/countNew',"#dotNewDevis");
}, 5000);

// alert("Bienvenue dans l'interface d'administration de votre application !");

// document.addEventListener('DOMContentLoaded', function () {
    // Pour les commandes
    initLiveSearch('#search-contacts', '.element-item', {
        noResultMessage: "Aucune commande trouvée.",
        noResultId: "commande-no-result",
        messageContainerSelector: "#commande-liste"
    });

    // Pour les produits
    initLiveSearch('#search-livraison', '.livraison-item', {
        noResultMessage: "Aucun produit ne correspond à votre recherche.",
        noResultId: "produit-no-result",
        messageContainerSelector: "#livraison-liste"
    });

    // Pour les utilisateurs
    initLiveSearch('#search-devis', '.devis-item', {
        noResultMessage: "Aucun utilisateur trouvé.",
        noResultId: "user-no-result",
        messageContainerSelector: "#devis-liste"
    });
// });