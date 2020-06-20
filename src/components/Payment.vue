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
								<th class="txtright">Total($)</th>
							</tr>
						</thead>
						<tbody>
							<tr>
								<td>{{details.name}}</td>
								<td>{{details.quantity}}</td>
								<td class="txtright">{{details.total_amount}}</td>
							</tr>
							<tr class="total">
								<td colspan="2">Total Amount</td>
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
				details:{
					id: 'OT01',
					name: 'Tshirt',
					quantity: '1',
					price: '50',
					total_amount: '50'
				}
			}
		},
		methods:{
			save(id){
				let that = this;
				var name = '';
				if(id==1){
					name = "Cash on Delivery";
				}else if(id==2){
					name = "Stripe";
				}
				Swal.fire({
					title: 'Are you sure to buy with '+name+'?',
					icon: 'warning',
					showCancelButton: true,
					confirmButtonText: 'Yes',
					cancelButtonText: 'No'
				}).then((result) => {
					if (result.value) {
						Swal.fire(
							'Success!',
							'User selected '+that.details.name+' and paid $'+that.details.price+' with '+name,
							'success'
						)

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
    max-height: 40px;
    border: 1px solid #ddd;
    margin: 0 5px 5px 0;
}
</style>