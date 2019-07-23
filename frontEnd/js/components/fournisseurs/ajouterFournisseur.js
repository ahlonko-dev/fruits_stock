const AjouterFournisseur = {
    template: `
<div>

    <div>

        <h1>Ajouter un nouveau fournisseur</h1>
            <p>

                Nom: <input v-model="fournisseur.name"> <br />
                Prénom: <input v-model="fournisseur.firstname"> <br />
                Adresse: <input v-model="fournisseur.adress"> <br />
                Ville: <input v-model="fournisseur.city"> <br />
                Code zip: <input v-model="fournisseur.zip_code"> <br />
                Pays: <input v-model="fournisseur.country"> <br />
                <button v-on:click="addSupplier">Ajouter Nouveau Fournisseur</button>

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
            fournisseur: {},
            error: null,
            message: null
        }
    },

    methods: {
        addSupplier() {
            
            if (this.fournisseur.name != null && this.fournisseur.firstname != null && this.fournisseur.adress != null && this.fournisseur.city != null && this.fournisseur.zip_code != null && this.fournisseur.country != null) {
                this.loading = true;
                const params = new URLSearchParams();
                params.append('name', this.fournisseur.name);
                params.append('firstname', this.fournisseur.firstname);
                params.append('adress', this.fournisseur.adress);
                params.append('city', this.fournisseur.city);
                params.append('zip_code', this.fournisseur.zip_code);
                params.append('country', this.fournisseur.country);

                axios.post('http://api.sirius-school.be/product-v2/producer/insert', params).then(response => {
                    console.log(response);

                    this.loading = false;
                    if(response.data.status=="success"){
                        this.message="Le fournisseur a bien été ajouté";
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