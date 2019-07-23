const AjouterMembreTeam = {
    template: `
<div>

    <div>

        <h1>Ajouter un nouveau membre à la Team</h1>
            <p>

                Nom: <input v-model="client.name"> <br />
                Prénom: <input v-model="client.firstname"> <br />
                Adresse: <input v-model="client.adress"> <br />
                Ville: <input v-model="client.city"> <br />
                Code zip: <input v-model="client.zip_code"> <br />
                Pays: <input v-model="client.country"> <br />
                <button v-on:click="addClient">Ajouter Nouveau Membre</button>

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
            client: {},
            error: null,
            message: null
        }
    },

    methods: {
        addClient() {
            
            if (this.client.name != null && this.client.firstname != null && this.client.adress != null && this.client.city != null && this.client.zip_code != null && this.client.country != null) {
                this.loading = true;
                const params = new URLSearchParams();
                params.append('name', this.client.name);
                params.append('firstname', this.client.firstname);
                params.append('adress', this.client.adress);
                params.append('city', this.client.city);
                params.append('zip_code', this.client.zip_code);
                params.append('country', this.client.country);

                axios.post('http://api.sirius-school.be/product-v2/team/insert', params).then(response => {
                    console.log(response);

                    this.loading = false;
                    if(response.data.status=="success"){
                        this.message="Le membre de la Team a bien été ajouté";
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