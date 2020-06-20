<template>
	<div class="login-form">
		<div class="container">
			<div class="row">
				<div class="col-md-6 offset-md-3">
				<div class="card">
					<div class="card-header">
						<h3>Login Form</h3>
					</div>
					<div class="card-body">
						<div class="form-group">
							<label class="control-label">Username<font color="red">*</font></label>
							<input type="text" required class="form-control" placeholder="Username" name="username" id="username" v-model="user.username" @keyup.enter="password">
							<span class="text text-red">{{errors.username}}</span>
						</div>
						<div class="form-group">
							<label class="control-label">Password<font color="red">*</font></label>
								<input type="password" class="form-control" placeholder="Password" name="password" id="password" v-model="user.password" @keyup.enter="UserLogin">
							<span class="text text-red">{{errors.password}}</span>
						</div>         
						<div class="text-right">
							<button type="submit" class="btn btn-success" @click="UserLogin">Login</button>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
</template>
<script>
	export default{
		data(){
			return{
				user:{
					username: '',
					password: ''
				},
				errors:{
					username: '',
					password: ''
				}
			}
		},
		methods:{
			UserLogin(){
				let that = this;
				var error = 0;
                that.errors.username = "";
                that.errors.password = "";
                if(that.user.username==""){
                    that.errors.username = "Username is required";
					error = error+1;
                }
                if(that.user.password==""){
                    that.errors.password = "Password is required";
					error = error+1;
                }
				if(error<=0){
					localStorage.setItem('login_status',1); 
					window.location.href = '/list_product'; 
				}
				// that.axios.post('/api/login',{
				// 	user:that.user
				// }).then((response)=>{
				// 	if(response.data.status==200){
				// 		localStorage.setItem('login_status',1);  
				// 		that.$router.push('/list_product');
				// 	}
				// }
			}
		}
	}
</script>
<style scoped>
.login-form{
	min-height: 85vh;
	padding: 3% 0;
}
</style>