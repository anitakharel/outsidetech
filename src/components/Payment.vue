<template>
	<div class="payselect">
		<div class="container">
			<div class="row">
		<div class="col-lg-8 col-md-8 col-sm-8col-xs-12 pright">
			<div class="card">
				<div class="card-heading phead">Transaction Details</div>
				<div class="card-body">
					<table class="table">
						<thead>
							<tr>
								<th>Item</th>
								<th>Qty</th>
								<th class="txtright">Price($)</th>
								<th class="txtright">Total($)</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{details.name}}</td>
								<td>{{details.quantity}}</td>
								<td class="txtright">{{details.price}}</td>
								<td class="txtright">{{details.total_amount}}</td>
							</tr>
							<tr class="total">
								<td colspan="3">Total Amount</td>
								<td class="txtright">{{ details.total_amount }}</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
		</div>
		<div class="col-lg-4 col-md-4 col-sm-4 col-xs-12 pleft">
			<div class="card">
				<div class="card-heading phead">Payment Options</div>
				<div class="panel-body paybody">
					<div class="buy-info">
						Confirm the transaction. When ready to buy, select your preferred payment provider below.
					</div>
					<a href="javascript:;" @click="save(1)"><img src="../assets/cod.png"></a>
					<a href="javascript:;" @click="save(2)"><img src="../assets/stripe.png"></a>
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
				details:{},
				order_details:{
					item_id:'',
					quantity:'',
					payment_id:'',
					payment_type:''
				}
			}
		},
		mounted(){
			this.details = JSON.parse(localStorage.getItem('product'));
			this.order_details.item_id = this.details.id;
			this.order_details.quantity = this.details.quantity;
		},
		methods:{
			save(id){
				let that = this;
				var payment_id = id;
				var name = '';
				var payment_type = '';
				if(id==1){
					name = "Cash on Delivery";
					payment_type = "cash";
				}else if(id==2){
					name = "stripe";
					payment_type = "stripe";
				}
				Swal.fire({
					title: 'Are you sure to buy with '+name+'?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						that.axios.post('http://localhost:8081/orders.php',{
							item_id:that.details.id, quantity:that.details.quantity, payment_id:payment_id, payment_type:payment_type, name:that.details.name, total:that.details.total_amount
						}).then((response)=>{
							console.log(response);
								localStorage.removeItem('product');
								Swal.fire('Success!',response.data.message,'success')
								setTimeout(function () {
									window.location.href = "/";
								}, 1000); 
						});

					}
				})
			}
		}
	}
</script>
<style scoped>
.payselect{
    padding: 3% 0;
    min-height: 85vh;
}
.phead{
    background: #28a745;
    color: #fff !important;
    font-size: 16px;
    padding: 10px;
}
.payselect .table>thead>tr>th, .payselect .total{
    background-color: #ddd;
    font-size: 14px;
    font-weight: bold;
}
.paybody img{
    width: auto!important;
    max-height: 50px;
    border: 1px solid #ddd;
    margin: 0 10px 5px 0;
    padding: 5px 15px;
    -webkit-box-shadow: 1px 2px 5px -2px #807D7D;
	box-shadow: 1px 2px 5px -2px #807D7D;
}
</style>