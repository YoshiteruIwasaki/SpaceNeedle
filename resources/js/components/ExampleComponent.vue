<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>{{ title }}</h1>
                <p>{{ message }}</p>
                <button @click="editButton" class="btn btn-primary">edit</button>
            </div>
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
      message: "Initialize"
    };
  },
  methods: {
    editButton: function() {
      alert("edit");
      this.title = "Welcome to Vue.js!";
      this.message = "This is a sample application.";
    }
  }
};
</script>
