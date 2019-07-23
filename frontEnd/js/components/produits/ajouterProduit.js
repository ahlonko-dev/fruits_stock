const AjouterProduit = {
    template: `
<div>

    <div>

        <h1>Ajouter un nouveau produit</h1>
            <p>

                Nom: <input v-model="item.name"> <br />
                Référence: <input v-model="item.ref"> <br />
                Quantity: <input v-model="item.qty"> <br />
                Prix: <input v-model="item.price"> <br />
                <button v-on:click="addProduct">Ajouter Nouveau Produit</button>

            </p>

    </div>
    <div v-if="loading" class="loading">
        Loading...
    </div>
    <div v-if="error" class="error">
        {{ error }}
    </div>
    <div v-if="message" class="message">
        {{ message }}
    </div>
</div>
`,
    data() {
        return {
            loading: false,
            item: {},
            error: null,
            message: null
        }
    },

    methods: {
        addProduct() {
            
            if (this.item.name != null && this.item.ref != null && this.item.qty != null && this.item.price != null) {
                this.loading = true;
                const params = new URLSearchParams();
                params.append('name', this.item.name);
                params.append('ref', this.item.ref);
                params.append('qty', this.item.qty);
                params.append('price', this.item.price);

                axios.post('http://api.sirius-school.be/product-v2/product/insert', params).then(response => {
                    console.log(response);

                    this.loading = false;
                    if(response.data.status=="success"){
                        this.message="Le produit a bien été ajouté";
                    }
                    else{
                        this.message = "Il y a un problème. Si ce message se répète contactez la personne en charge de l'ERP";
                    }


                });
            }
            else{
                this.error = "Veuillez compléter tous les champs";
            }
        }
    }
}