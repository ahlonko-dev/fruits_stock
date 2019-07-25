const ModifierProduit = {
    template: `
<div>


    <h1>Produit n° {{ $route.params.id }}</h1>

    <div v-if="loading" class="loading">
        Loading...
    </div>

    <div v-if="error" class="error">
        {{ error }}
    </div>

    <div>
        Nom: <input type="text" v-model="item.name"/><br />
        Référence: <input type="text" v-model="item.reference"/><br />
        Quantity: <input type="text" v-model="item.quantity"/><br />
        Prix: <input type="text" v-model="item.price"/><br />
        <button v-on:click="modifyProduct">Valider Modification</button>
    </div>

    <div v-if="loading2" class="loading">
        Loading...
    </div>
    <div v-if="message" class="message">
        {{message}}
    </div>



</div>
`,
    data() {
        return {
            loading: true,
            loading2: false,
            item: {},
            error: null,
            message: ""

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

            const params = new URLSearchParams();
            params.append('id', this.$route.params.id);
            console.log("L'id est égal à " + this.$route.params.id);
            //dans notre exemple on avait : axios.post('http://files.sirius-school.be/products-api/?action=getDetail' + this.$route.params.id, params).then(response => {
            // -> le post qu'on avait de base se faisait avec le paramètre "id" ajouté dans l'url => "+ this.$route.params.id"
            //      -> mais ici, on ne met pas l'id dans l'url, il doit être en paramètre
                axios.post(URL+'/detail.php?id_product='+this.$route.params.id, params).then(response => {

                console.log(response.data);
                this.loading = false;
                this.item = response.data;            });
        },

        modifyProduct() {

            const params = new URLSearchParams();
            params.append('id_product', this.$route.params.id);
            params.append('name', this.item.name);
            params.append('ref', this.item.reference);
            params.append('qty', this.item.quantity);
            params.append('price', this.item.price);

            axios.post('http://192.168.1.63/api/fruits_stock/backend/update.php?id_product='+this.$route.params.id, params).then(response => {
                console.log(response);
                console.log(response.data.erreur);
                

                if (response.data.erreur == false) {
                    this.message = "Le produit a bien été mis à jour";
                }
                else {
                    this.message = "Il y a un problème, contactez la personne en charge de l'ERP";
                }

            }).catch(error => {
                console.log(error.message);
            });


        }

    }
}