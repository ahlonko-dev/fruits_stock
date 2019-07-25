const Accueil = {
    template:
     `
    <div class="container">
        <div class="row">
            <div class="col-6 col-md-4 col-lg-2">
                <img src="images/Logo.jpg" class="image" alt="Logo Diksi">
            </div>
            <div class="col-2 col-md-4 col-lg-10">
            </div>

        </div>
        <div class="post">
            <div v-if="loading" class="loading">
                Loading...
            </div>

            <div v-if="error" class="error">
                {{ error }}
            </div>
        
            <!-- on vérifie que products n'est pas vide, et puis on boucle avec v-for sur un tableau d'objet "item" -->
            <table class="tableProduits" v-if="products" id="example-1">
                <tr class="row">
                    <td class="col-2 col-md-2 col-lg-2 produits hautColonne colGauche">Produits</td>
                    <td class="col-2 col-md-2 col-lg-2 produits hautColonne colDroite">Quantité</td>
                    <td class="col-2 col-md-2 col-lg-2"><div class="boutonAjouterProduit"><router-link class="routeur" to="/produits/ajouterProduit">Ajouter un produit</router-link></td>

                </tr>
                <tr class="row" v-for="item in products">
                    <td class="col-2 col-md-2 col-lg-2 produits">{{ item.name }} </td>
                    <td class="col-2 col-md-2 col-lg-2 produits">{{ item.quantity }} </td>
                    <td class="col-2 col-md-1 col-lg-1 boutonDetail"><router-link class="texteBoutton" :to="{ name: 'detailProduit', params: { id: item.id_product }}">détail</router-link></td>

                    <td class="col-0 col-md-2 col-lg-2"></td>
                </tr>
            </table>


        </div>
    </div>
`,
/*                    
                    <td class="col-2 col-md-2 col-lg-1 produits hautColonne colMilieu">Prix</td>

<td class="col-1 col-md-2 col-lg-1 produits hautColonne colDroite"></td>
                    <td class="col-2 col-md-2 col-lg-1 produits">{{ item.price }} </td>
*/

    data() {
        return {
            loading: true,
            products: null,
            error: null
        }
    },
    created() {
        // fetch the data when the view is created and the data is
        // already being observed
        this.fetchData();
    },
    watch: {
        // call again the method if the route changes
        '$route': 'fetchData'
    },
    methods: {

        fetchData() {
            axios.get(URL+'/read.php').then(response => {

            /*axios.get('http://localhost/xampp/api/fruits_stock/backend/read.php').then(response => {*/
            /*axios.get('https://api.sirius-school.be/product-v2/product/list').then(response => {*/
            

                console.log(response);
                this.loading = false;
                this.products = response.data.products;
            });
        }
    }
};