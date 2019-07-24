const DetailProduit = {
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
        <p v-if="item">
            Id Produit: {{ item.id_product }} <br />
            Nom: {{ item.name}} <br />
            Référence: {{ item.ref}} <br />
            Quantity: {{ item.qty}} <br />
            Prix: {{ item.price}} <br />
            <button v-on:click="deleteProduct">Supprimer ce produit</button>
            <router-link :to="{ name: 'modifierProduit', params: { id: item.id_product }}">Modifier</router-link>
        </p>
    </div>
    <div v-if="loading2" class="loading">
        Loading...
    </div>
    <div v-if="messageDeleted" class="error">
        {{ messageDeleted }}
    </div>
</div>
`,
    data() {
        return {
            loading: true,
            loading2: false,
            item: null,
            error: null,
            messageDeleted: null
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
            console.log(this.$route.params.id);
            this.loading = false;
            const params = new URLSearchParams();
            params.append('id', this.$route.params.id);

            //dans notre exemple on avait : axios.post('http://files.sirius-school.be/products-api/?action=getDetail' + this.$route.params.id, params).then(response => {
            // -> le post qu'on avait de base se faisait avec le paramètre "id" ajouté dans l'url => "+ this.$route.params.id"
            //      -> mais ici, on ne met pas l'id dans l'url, il doit être en paramètre
            /*axios.post('http://api.sirius-school.be/product-v2/product/detail', params).then(response => {*/
            axios.post(URL+'/detail.php?id_product='+this.$route.params.id, params).then(response => {

                
                console.log(response);

                this.item = response.data;
                console.log("item est égal à"+this.item);

            });
        },

        deleteProduct() {

            var messageConfirm = confirm("Etes-vous sûr de vouloir supprimer ce produit?");
            if (messageConfirm == true) {
                this.loading = true;
                const params = new URLSearchParams();
                params.append('id', this.$route.params.id);

                axios.post('http://api.sirius-school.be/product-v2/product/delete', params).then(response => {
                    console.log(response.data);

                    this.loading = false;
                    if (response.data.status == "success") {
                        this.messageDeleted = "Le produit a bien été supprimé";
                    }
                    else {
                        this.messageDeleted = "Il y a un problème, contactez la personne en charge de l'ERP";
                    }


                    setTimeout(function () {
                        router.push({ name: "listeProduits" })
                    }, 2000);


                });
            }



        },

        modifyProduct() {
            router.push({ name: "modifierProduit" })
        }


    }
}