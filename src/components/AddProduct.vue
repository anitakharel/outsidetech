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
                        <!-- <div class="col-md-6 form-group">
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
                        </div> -->
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
                        <div class="col-md-6 form-group">
                            <label class="control-label">Price ($) <font color="red">*</font></label>
                            <input
                                class="form-control"
                                id="price"
                                placeholder="Product Price"
                                v-model="product.price"
                                name="price"
                                v-on:keydown.13="focusOnEnter('#description')"
                                style="margin-bottom:5px"
                            >
                            <span class="text text-red">{{errors.price}}</span>
                        </div>
                        </div>
                        <div class="row">
                        <div class="col-md-6 form-group">
                            <label class="control-label">Description <font color="red">*</font></label>
                            <textarea
                                class="form-control"
                                id="description"
                                placeholder="Product description"
                                v-model="product.description"
                                name="description"
                                style="margin-bottom:5px"
                            ></textarea>
                            <span class="text text-red">{{errors.description}}</span>
                        </div>
                        <div class="col-md-6 form-group">
                            <label class="control-label">Image <font color="red">*</font></label>
                            <input type="file" id="file" name="product_image" accept="image/*" @change="onFileChange" />
                            <span class="text text-red">{{errors.image}}</span>
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
					name:'',
					price:'',
					description:'',
                    image:''
				},
				errors:{
					name: "",
					price: "",
					description: "",
                    image:''
				},
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
					name: '',
					price: '',
					description: '',
                    image:''
				};
				this.errors = {
					name: '',
					price: '',
					description: '',
                    image:''
				};
            },
            onFileChange(e) {
                const file = e.target.files[0];
                this.product.image =  URL.createObjectURL(file);
            },
            saveDetails(){
                let that = this;
                var error = 0;
                that.errors.name = "";
                that.errors.price = "";
                that.errors.description = "";

                if(that.product.name==""){
                    that.errors.product_name = "Product Name is required";
					error = error+1;
                } 
                if(that.product.price==""){
                    that.errors.price = "Price is required";
                    error = error+1;
                }
                if(that.product.description==""){
                    that.errors.description = "Product Description is required";
                    error = error+1;
                }
                if(that.product.image==""){
                    that.errors.image = "Product Image is required";
                    error = error+1;
                }
                if(error<=0){
					that.axios.post('http://localhost:8081/items.php',{
						name:that.product.name, price:that.product.price, description:that.product.description, image:that.product.image
					}).then((response)=>{
						console.log(response);
							that.clear();
							that.errors = '';
							Swal.fire('Success',response.data.message,'success');
							that.$router.push('/list_product');
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