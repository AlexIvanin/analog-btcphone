<template>
  <div>
     <form class="form-signin" v-on:submit.prevent="onSubmit">
      <h1 class="h3 mb-3 font-weight-normal">Авторизация</h1>
      <label for="inputEmail" class="sr-only">Логин</label>
      <input v-model="form.login" type="text" id="inputEmail" class="form-control" placeholder="Логин" required autofocus>
      <label for="inputPassword" class="sr-only">Пароль</label>
      <input v-model="form.password" type="password" id="inputPassword" class="form-control" placeholder="Пароль" required>
  
      <button class="btn btn-lg btn-primary btn-block" type="submit">Войти</button>
    </form>
  </div>
</template>
<script>
import axios from 'axios'
import Cookies from 'js-cookie'

export default {
  data: () => ({
      title: 'Авторизация',
      form:{
          login:'',
          password:''
      }
  }),
  async mounted () {
        var user = Cookies.get('user');
        if (user){
             window.location.href = "/admin"
        }
    },
  methods:{
      onSubmit(){
        axios.post('/api/auth', this.form)
  .then(function (response) {
    if (response.data.status == 'success'){
        console.log(1);
        Cookies.set('user', { user: response.data.user});
        window.location.href = "/admin"


    } else {
        console.log(0)
    }
  })
  .catch(function (error) {
    console.log(error);
  });
      }
  },
  metaInfo () {
    return { title: this.title }
  }
}
</script>
<style>
html,
body {
  height: 100%;
}

body {
  display: -ms-flexbox;
  display: -webkit-box;
  display: flex;
  -ms-flex-align: center;
  -ms-flex-pack: center;
  -webkit-box-align: center;
  align-items: center;
  -webkit-box-pack: center;
  justify-content: center;
  padding-top: 40px;
  padding-bottom: 40px;
  background-color: #f5f5f5;
}

.form-signin {
  width: 100%;
  max-width: 330px;
  padding: 15px;
  margin: 0 auto;
}
.form-signin .checkbox {
  font-weight: 400;
}
.form-signin .form-control {
  position: relative;
  box-sizing: border-box;
  height: auto;
  padding: 10px;
  font-size: 16px;
}
.form-signin .form-control:focus {
  z-index: 2;
}
.form-signin input[type="email"] {
  margin-bottom: -1px;
  border-bottom-right-radius: 0;
  border-bottom-left-radius: 0;
}
.form-signin input[type="password"] {
  margin-bottom: 10px;
  border-top-left-radius: 0;
  border-top-right-radius: 0;
}
</style>
