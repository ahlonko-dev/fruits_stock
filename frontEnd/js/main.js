// api https://jsonplaceholder.typicode.com/albums
// https://jsonplaceholder.typicode.com/users
// https://jsonplaceholder.typicode.com/albums?userId=1


// 1. Define route components.
// These can be imported from other files

// files is loaded from js/components

// 2. Define some routes
// Each route should map to a component. The "component" can
// either be an actual component constructor created via
// `Vue.extend()`, or just a component options object.
// We'll talk about nested routes later.
const routes = [
    {path: '/', name: 'home', component: ListeProduits},
    {path: '/produits/listeProduits', name: 'listeProduits', component: ListeProduits},
    {path: '/produits/ajouterProduit', name: 'ajouterProduit', component: AjouterProduit},
    {path: '/produits/modifierProduit', name: 'modifierProduit', component: ModifierProduit},
    {path: '/produits/:id', name: 'detailProduit', component: DetailProduit},

    {path: '/clients/listeClients', name: 'listeClients', component: ListeClients},
    {path: '/clients/ajouterClient', name: 'ajouterClient', component: AjouterClient},
    {path: '/clients/modifierClient', name: 'modifierClient', component: ModifierClient},
    {path: '/clients/:id', name: 'detailClient', component: DetailClient},

    {path: '/team/listeTeam', name: 'listeTeam', component: ListeTeam},
    {path: '/team/ajouterMembreTeam', name: 'ajouterMembreTeam', component: AjouterMembreTeam},
    {path: '/team/modifierMembreTeam', name: 'modifierMembreTeam', component: ModifierMembreTeam},
    {path: '/team/:id', name: 'detailMembreTeam', component: DetailMembreTeam},

    {path: '/fournisseurs/listeFournisseurs', name: 'listeFournisseurs', component: ListeFournisseurs},
    {path: '/fournisseurs/ajouterFournisseur', name: 'ajouterFournisseur', component: AjouterFournisseur},
    {path: '/fournisseurs/modifierFournisseur', name: 'modifierFournisseur', component: ModifierFournisseur},
    {path: '/fournisseurs/:id', name: 'detailFournisseur', component: DetailFournisseur},

    {path: '/contact', name: 'contact', component: Contact},
];

// 3. Create the router instance and pass the `routes` option
// You can pass in additional options here, but let's
// keep it simple for now.
const router = new VueRouter({
    routes // short for `routes: routes`
});

// 4. Create and mount the root instance.
// Make sure to inject the router with the router option to make the
// whole app router-aware.
const app = new Vue({
    router
}).$mount('#app');
