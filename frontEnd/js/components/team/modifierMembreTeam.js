const ModifierMembreTeam = {
    template: `
<div>


    <h1>Membre de la Team n° {{ $route.params.id }}</h1>

    <div v-if="loading" class="loading">
        Loading...
    </div>

    <div v-if="error" class="error">
        {{ error }}
    </div>

    <div>
        <p v-if="person">
            Nom: <input type="text" v-model="person.name"/><br />
            Prénom: <input type="text" v-model="person.firstname"/><br />
            Adresse: <input type="text" v-model="person.adress"/><br />
            Ville: <input type="text" v-model="person.city"/><br />
            Code Zip: <input type="text" v-model="person.zip_code"/><br />
            Pays: <input type="text" v-model="person.country"/><br />
            <button v-on:click="modifyTeamMember">Modifier ce membre</button>
        </p>
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
            person: {},
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
            axios.post('http://api.sirius-school.be/product-v2/team/detail', params).then(response => {
                console.log(response.data);
                this.loading = false;
                this.person = response.data.team;
            });
        },

        modifyTeamMember() {

            const params = new URLSearchParams();
            params.append('id', this.$route.params.id);
            params.append('name', this.person.name);
            params.append('firstname', this.person.firstname);
            params.append('adress', this.person.adress);
            params.append('city', this.person.city);
            params.append('zip_code', this.person.zip_code);
            params.append('country', this.person.country);

            axios.post('http://api.sirius-school.be/product-v2/team/update', params).then(response => {
                console.log(response);

                if (response.data.status == "success") {
                    this.message = "Les données du membre de la Team ont bien été mises à jour";
                }
                else {
                    this.message = "Il y a un problème, contactez Ludo";
                }

            }).catch(error => {
                console.log(error.message);
            });


        }

    }
}