<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ title }}</h1>
                <p>{{ message }}</p>
                <button @click="editButton" class="btn btn-primary">edit</button>
            </div>

    <button @click="getUser">Am I logged in?</button>
    <p v-if="user != []">{{ user.id }} : {{ user.name }}</p>
        </div>
    </div>
</template>

<script>
export default {
       mounted() {
            console.log('Component mounted.')
        },
  data() {
    return {
      title: "Laravel + Vue.js",
      message: "Initialize",

    user: [],
    };
  },
  methods: {
    editButton: function() {
      alert("edit");
      this.title = "Welcome to Vue.js!";
      this.message = "This is a sample application.";
  },
    getUser: function() {
      axios.get("/api/user")
      .then(res => {
        alert('Welcome, ' + response.data.name + '!!');
        console.log(response.data);
        this.user = response.data;
      })
      .catch(
        alert('Sorry, you are not logged in.'),
      );
    },
  }
};
</script>
