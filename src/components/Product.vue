<template>
  <div>
  <div class="product-block block-dark" id="product">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-left">
          <h3>Latest Products</h3>
        </div>
        <div class="col-md-12 pl-0 pr-0">
          <div class="row">
            <div class="col-md-3" v-for="(data,index) in products" :key="data.id">
              <div class="product">
                <img v-bind:src="getImgUrl(data.image)" alt="">
                <div class="product-desc">
                  <h4>{{data.name}}</h4>
                  <h5>{{data.description}}</h5>
                  <div class="row">
                    <div class="col-md-4 price">${{data.price}}</div>
                    <div class="col-md-8">
                      <button v-on:click="subtract(index)">-</button>
                      <input type="number" min="1" v-model.number="data.quantity" v-on:change="changeTotal(index)">
                      <button v-on:click="add(index)">+</button>
                    </div>
                    <div class="col-md-12 text-center mt-2">
                      <button class="btn btn-success btn-buy" @click="Buy(data)">Buy</button>
                    </div>
                  </div>
                </div>
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
export default {
  name: 'Product',
  data(){
    return{
      products:[],
    }
  },
  mounted(){
    this.fetchProducts();
  },
  methods:{
    add: function(index){
      let that = this;
      that.products[index].quantity += 1;
      that.changeTotal(index);
    },
    subtract: function(index){
      let that = this;
      if(that.products[index].quantity>1){
        that.products[index].quantity -= 1;
        that.changeTotal(index);
      }
    },
    fetchProducts(){
      let that = this;
      that.axios.get('http://localhost:8081/items.php').then((response)=>{
        that.products = response.data;
      });
    },
    getImgUrl(pic) {
      return require('../assets/'+pic);
    },
    Buy(index){
      let that = this;
      localStorage.setItem("product",JSON.stringify(index));
      that.$router.push('/payment')
    },
    changeTotal(index){
      let that = this;
      that.products[index].total_amount = that.products[index].price*that.products[index].quantity;
    },
  }
}
</script>

<!-- Add "scoped" attribute to limit CSS to this component only -->
<style scoped>
.product-block{
  padding: 30px 0px;
}
.block-dark{
  background: #f2f2f2;
}
.product-block h3{
  color: #707070;
  font-weight: 700;
  font-size: 24px;
  display: block;
  margin-bottom: 20px;

}
.product{
  -webkit-box-shadow: 1px 2px 15px -2px #807D7D;
  box-shadow: 1px 2px 15px -2px #807D7D;
  padding: 0px;
  background: #fff;
  text-align: left;
}
.product img{
  width: 100%;
  height: auto;
}
.product-desc{
  padding: 20px;
}
.product-desc h4{
  color: #878787;
  font-size: 14px;
  font-weight: 600;
}
.product-desc h5{
  color: #878787;
  font-size: 12px;
  font-weight: 600;
}
.price{
  font-size: 15px;
  font-weight: 600;
  color: #212121;
}
.product-desc input{
  max-width: 60%; 
}
.btn-buy{
  display: block;
  width: 90%;
  margin: 2% auto;
  text-transform: uppercase;
  border-radius: 0px;
}
</style>
