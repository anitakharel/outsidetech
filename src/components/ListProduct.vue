<template>
	<div v-show="permission_stat==1" class="list-product">
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-2">
				<div class="card">
					<div class="card-header">
						<h3>Product List</h3>
						<button class="btn btn-sm btn-success" @click="$router.push('/add_product')">Add New Product</button>
					</div>
					<div class="card-body">
						<table class="table table-responsive table-striped">
							<thead>
								<th>S.N</th>
								<th>Product ID</th>
								<th>Name</th>
								<th>Price ($)</th>
								<th>Description</th>
								<th>Image</th>
							</thead>
							<tbody>
								<tr v-for="(product,index) in products" :key="index">
									<td>{{ index+1 }}</td>
									<td>{{ product.id }}</td>
									<td>{{ product.name }}</td>
									<td>{{ product.price }}</td>
									<td>{{ product.description }}</td>
									<td><img v-bind:src="getImgUrl(product.image)" width="50" alt=""></td>
								</tr>
							</tbody>
						</table>
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
				products:[],
                permission_stat:''
			}
		},
		mounted(){
			var permission = localStorage.getItem('login_status'); 
			if(permission){
				if(permission==1){
					this.permission_stat = 1;
				}else{
				window.location.href = "/";
				}
			}else{
				window.location.href = "/";
			}
			this.fetchProducts();
		},
		methods:{
			fetchProducts(){
                let that = this;
				that.axios.get('http://localhost:8081/items.php').then((response)=>{
					that.products = response.data;
				});
			},
			getImgUrl(pic) {
				return require('../assets/'+pic);
			}
		}
	}
</script>
<style scoped>
.list-product{
	min-height: 85vh;
	padding: 3% 0;
}
.card-header h3{
	display: inline-block;
    float: left;
    font-size: 16px;
    font-weight: 600;
    margin: 0px;
    padding-top: 5px;
}
.card-header button{
	display: inline-block;
    float: right;
}
.table{
	display: inline-table;
}
tbody tr td{
	font-size: 14px;
}
</style>