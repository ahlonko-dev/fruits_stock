const ListeProduits = {
    template:
     `
    <div class="container">
        <div class="post">
            <div v-if="loading" class="loading">
                Loading...
            </div>

            <div v-if="error" class="error">
                {{ error }}
            </div>
        
            <!-- on vérifie que products n'est pas vide, et puis on boucle avec v-for sur un tableau d'objet "item" -->
            <table class="tableProduits" v-if="products" id="example-1">
                <tr>
                    <th>Produits</th>
                    <th>Quantité</th>
                    <th>Prix</th>
                    <th>Fournisseurs</th>
                    <th><router-link class="routeur" to="/produits/ajouterProduit">Ajouter un produit</router-link></th>
                </tr>
                <tr v-for="item in products">
                    <td><router-link :to="{ name: 'detailProduit', params: { id: item.id_product }}">{{ item.name }}</router-link></td>
                    <td>{{ item.qty }} </td>
                    <td>{{ item.price }} </td>
                </tr>
            </table>
        </div>
    </div>
`,


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
            axios.get('http://api.sirius-school.be/product-v2/product/list').then(response => {
                console.log(response);
                this.loading = false;
                this.products = response.data.products;
            });
        }
    }
};