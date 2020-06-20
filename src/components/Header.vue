<template>
  <nav id="navbar" class="navbar navbar-expand-md bg-dark navbar-dark fixed-top">
    <a class="navbar-brand" href="#"><img src="../assets/logo.png"></a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#collapsibleNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="collapsibleNavbar">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="/">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-custom" v-show="login_stat==0" href="login">Login</a>
        </li>
        <li class="nav-item">
          <a class="nav-link btn btn-custom" v-show="login_stat==1" @click="logout">Logout</a>
        </li> 
      </ul>
    </div>  
  </nav>
</template>
<script>
export default {
  name: 'Header',
  data(){
    return{
      login_stat: ''
    }
  },
  mounted(){
    var stat = localStorage.getItem('login_status'); 
    if(stat){
      if(stat==1){
        this.login_stat = 1;
      }else{
        this.login_stat = 0;
      }
    }else{
      this.login_stat = 0;
    }
  },
  methods:{
    logout(){
      localStorage.removeItem('login_status');
      window.location.href = "/";
    }
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.navbar-brand img{
    max-height: 35px;
}
.navbar-expand-md .navbar-collapse{
  display: block !important;
}
.navbar-nav{
  float: right;
}
.btn-custom{
  border: 1px solid rgba(255,255,255,.5);
  border-radius: 0px;
  margin: 0 3px;
  padding: 8px 15px !important;
}
.btn-custom:hover{
  border: 1px solid rgba(255,255,255,.7);
}
</style>