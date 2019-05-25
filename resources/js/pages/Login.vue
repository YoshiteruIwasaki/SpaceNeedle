<template>
  <div class="container--small">
<ul class="tab">
  <li
    class="tab__item"
    :class="{'tab__item--active': tab === 1 }"
    @click="tab = 1"
  >
Login
</li>
  <li
    class="tab__item"
    :class="{'tab__item--active': tab === 2 }"
    @click="tab = 2"
  >
Register
</li>
</ul>


<div
v-show="tab === 1"
class="panel"
>
<div
v-show="tab === 1"
class="panel"
>
<form
class="form"
@submit.prevent="login"
>
<label for="login-email">Email</label>
<input
id="login-email"
v-model="loginForm.email"
type="text"
class="form__item"
>    <label for="login-password">Password</label><input
id="login-password"
v-model="loginForm.password"
type="password"
class="form__item"
>
    <div class="form__button">
      <button
type="submit"
class="button button--inverse"
>
login
</button>
    </div>
  </form>
</div>
</div>


<div
v-show="tab === 2"
class="panel"
>
  <form
class="form"
@submit.prevent="register"
>
    <label for="username">Name</label>
    <input
id="username"
v-model="registerForm.name"
type="text"
class="form__item"
>
    <label for="email">Email</label>
    <input
id="email"
v-model="registerForm.email"
type="text"
class="form__item"
>
    <label for="password">Password</label>
    <input
id="password"
v-model="registerForm.password"
type="password"
class="form__item"
>
    <label for="password-confirmation">Password (confirm)</label>
    <input
id="password-confirmation"
v-model="registerForm.password_confirmation"
type="password"
class="form__item"
>
    <div class="form__button">
      <button
type="submit"
class="button button--inverse"
>
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
        email: '',
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
  methods: {
    async login() {
      // authストアのloginアクションを呼び出す
      await this.$store.dispatch('auth/login', this.loginForm);

      // トップページに移動する
      this.$router.push('/');
    },
    async  register() {
      // authストアのresigterアクションを呼び出す
      await this.$store.dispatch('auth/register', this.registerForm);

      // トップページに移動する
      this.$router.push('/');
    },
  },
};
</script>
