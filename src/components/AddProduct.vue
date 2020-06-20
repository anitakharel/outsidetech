<template>
	<div v-show="permission_stat==1" class="add-product">
		<div class="container">
			<div class="row">
				<div class="col-md-8 offset-md-2">
				<div class="card">
					<div class="card-header">
						<h3>Add Product</h3>
					</div>
					<div class="card-body">
						<div class="login-form">
                        <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">Product ID <font color="red">*</font></label>
                            <input
                                class="form-control"
                                type="text"
                                id="product_id"
                                placeholder="Product ID"
                                v-model="product.id"
                                name="product_id"
                                v-on:keydown.13="focusOnEnter('#product_name')"
                                style="margin-bottom:5px"
                            >
                            <span class="text text-red">{{errors.product_id}}</span>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="control-label">Product Name <font color="red">*</font></label>
                            <input
                                class="form-control"
                                type="text"
                                id="product_name"
                                placeholder="Product Name"
                                v-model="product.name"
                                name="product_name"
                                v-on:keydown.13="focusOnEnter('#price')"
                                style="margin-bottom:5px"
                            >
                            <span class="text text-red">{{errors.product_name}}</span>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">Price ($) <font color="red">*</font></label>
                            <input
                                class="form-control"
                                id="price"
                                placeholder="Product Price"
                                v-model="product.price"
                                name="price"
                                v-on:keydown.13="focusOnEnter('#category')"
                                style="margin-bottom:5px"
                            >
                            <span class="text text-red">{{errors.price}}</span>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="control-label">Category <font color="red">*</font></label>
                            <select v-model="product.category" name="category" class="form-control input-sm" id="category">
								<option value="" selected="selected">Select Category</option>
                                <option v-for="option in category" v-bind:value="option.id" :key="option.id" >
                                    {{ option.name }}
                                </option>
                            </select>
                            <span class="text text-red">{{errors.category}}</span>
                        </div>
                    </div>
                        
                        <div class="text-left">
                            <button type="button" class="btn btn-danger" @click="goBack">Cancel</button>
                            <button type="submit" class="btn btn-success ml-3" @click="saveDetails">Submit</button>
                        </div>
                    </div>
					</div>
				</div>
				</div>
			</div>
		</div>
	</div>
</template>
<script>
	import Swal from 'sweetalert2/src/sweetalert2.js'
	export default{
		data(){
			return{
				product:{
					id:'',
					name:'',
					price:'',
					category_slug:''
				},
				errors:{
					id:"",
					name: "",
					price: "",
					category_slug: "",
				},
				category : [
					{id: '1', name: 'clothing'},
					{id: '2', name: 'hardware'}
				],
				permission_stat: ''
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
		},
		methods:{
			goBack(){
				Swal.fire({
					title: 'Are you sure?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						window.location.href = "/list_product";
					}
				})
            },
            clear(){
				this.product = {
					id: '',
					name: '',
					price: '',
					category_slug: ''
				};
				this.errors = {
					id: '',
					name: '',
					price: '',
					category_slug: ''
				};
            },
            saveDetails(){
                let that = this;
                var error = 0;
                that.errors.id = "";
                that.errors.name = "";
                that.errors.price = "";
                that.errors.category_slug = "";

                if(that.product.id==""){
                    that.errors.product_id = "Product ID is required";
					error = error+1;
                } 
                if(that.product.name==""){
                    that.errors.product_name = "Product Name is required";
					error = error+1;
                } 
                if(that.product.price==""){
                    that.errors.price = "Price is required";
                    error = error+1;
                }
                if(that.product.category_slug==""){
                    that.errors.category = "Category is required";
                    error = error+1;
                }
                if(error<=0){
					that.axios.post('/api/save_product',{
						product:that.product
					}).then((response)=>{
						if(response.data.status==200){
							that.clear();
							that.errors = '';
							Swal.fire("Successfully saved!", {
								icon: "success",
							});
							that.$router.push('/list_product');
						}
					});
				}
			}
		}
	}
</script>
<style>
.add-product{
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
.control-label{
	display: block;
	text-align: left;
}
span{
	display: block;
	text-align: left;
}
.text-red{
	color: red;
}
</style>