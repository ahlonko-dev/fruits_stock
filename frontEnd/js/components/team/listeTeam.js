const ListeTeam = {
    template: `
    <div class="post">
    <h1>Liste des membres de la Team</h1>
    <div v-if="loading" class="loading">
      Loading...
    </div>

    <div v-if="error" class="error">
      {{ error }}
    </div>
    
    <!-- on vérifie que people n'est pas vide, et puis on boucle avec v-for sur un tableau d'objet "person" -->
    <ul v-if="people" id="example-1">
        <li v-for="person in people">
        {{ person.firstname }} {{ person.name }}
            <router-link :to="{ name: 'detailMembreTeam', params: { id: person.id_team}}">Détail</router-link>
        </li>
    </ul>
  </div>
`,


    data() {
        return {
            loading: true,
            people: null,
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
            axios.get('http://api.sirius-school.be/product-v2/team/list').then(response => {
                console.log(response);
                this.loading = false;
                this.people = response.data.teams;
            });
        }
    }
};