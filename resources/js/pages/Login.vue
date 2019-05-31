<template>
  <div class="container--small">
<ul class="tab">
  <li class="tab__item" :class="{'tab__item--active': tab === 1 }" @click="tab = 1">
Login
</li>
  <li class="tab__item" :class="{'tab__item--active': tab === 2 }" @click="tab = 2">
Register
</li>
</ul>

<div v-show="tab === 1" class="panel">
<div v-show="tab === 1" class="panel">
<form class="form" @submit.prevent="login">
  <div v-if="loginErrors" class="errors">
    <ul v-if="loginErrors.message">
      <li>
{{ loginErrors.message }}
</li>
    <ul v-if="loginErrors.username">
      <li v-for="msg in loginErrors.username" :key="msg">
{{ msg }}
</li>
    </ul>
    <ul v-if="loginErrors.password">
      <li v-for="msg in loginErrors.password" :key="msg">
{{ msg }}
</li>
    </ul>
  </ul>
</div>
<label for="login-email">Email</label>
<input id="login-email" v-model="loginForm.username" type="text" class="form__item">
<label for="login-password">Password</label>
<input id="login-password" v-model="loginForm.password" type="password" class="form__item">
    <div class="form__button">
      <button type="submit" class="button button--inverse">
login
</button>
    </div>
  </form>
</div>
</div>

<div v-show="tab === 2" class="panel">
  <form class="form" @submit.prevent="register">
<div v-if="registerErrors" class="errors">
    <ul v-if="registerErrors.name">
      <li v-for="msg in registerErrors.name" :key="msg">
{{ msg }}
</li>
    </ul>
    <ul v-if="registerErrors.email">
      <li v-for="msg in registerErrors.email" :key="msg">
{{ msg }}
</li>
    </ul>
    <ul v-if="registerErrors.password">
      <li v-for="msg in registerErrors.password" :key="msg">
{{ msg }}
</li>
    </ul>
  </ul>
</div>
    <label for="username">Name</label>
    <input id="username" v-model="registerForm.name" type="text" class="form__item">
    <label for="email">Email</label>
    <input id="email" v-model="registerForm.email" type="text" class="form__item">
    <label for="password">Password</label>
    <input id="password" v-model="registerForm.password" type="password" class="form__item">
    <label for="password-confirmation">Password (confirm)</label>
    <input id="password-confirmation" v-model="registerForm.password_confirmation" type="password" class="form__item">
    <div class="form__button">
      <button type="submit" class="button button--inverse">
        register
      </button>
    </div>
  </form>
</div>
</div>
</template>

<script>

export default {
  data() {
    return {
      tab: 1,
      loginForm: {
        username: '',
        password: '',
      },
      registerForm: {
        name: '',
        email: '',
        password: '',
        password_confirmation: '',
      },
    };
  },
  computed: {
    apiStatus() {
      return this.$store.state.auth.apiStatus;
    },
    loginErrors() {
      return this.$store.state.auth.loginErrorMessages;
    },
    registerErrors() {
      return this.$store.state.auth.registerErrorMessages;
    },
  },
  created() {
    this.clearError();
  },
  methods: {
    clearError() {
      this.$store.commit('auth/setLoginErrorMessages', null);
      this.$store.commit('auth/setRegisterErrorMessages', null);
    },
    async login() {
      // authストアのloginアクションを呼び出す
      await this.$store.dispatch('auth/login', this.loginForm);
      if (this.apiStatus) {
      // authストアのuserアクションを呼び出す
        await this.$store.dispatch('auth/user');

        // トップページに移動する
        this.$router.push('/');
      }
    },
    async  register() {
      // authストアのresigterアクションを呼び出す
      await this.$store.dispatch('auth/register', this.registerForm);

      if (this.apiStatus) {
      // authストアのuserアクションを呼び出す
        await this.$store.dispatch('auth/user');

        // トップページに移動する
        this.$router.push('/');
      }
    },
  },
};
</script>
