<template>
  <div>
  <div class="product-block block-dark" id="product">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-left">
          <h3>Clothing</h3>
        </div>
        <div class="col-md-12 pl-0 pr-0">
          <div class="col-md-3 product">
            <img src="../assets/tshirt.jpg">
            <div class="product-desc">
              <h4>Tshirt</h4>
              <div class="row">
                <div class="col-md-4 price">$50</div>
                <div class="col-md-8">
                  <button v-on:click="subtract(1)">-</button>
                  <input type="number" min="1" v-model="quantity">
                  <button v-on:click="add(1)">+</button>
                </div>
                <div class="col-md-12 text-center mt-2">
                <button class="btn btn-success">Buy</button>
              </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <div class="product-block">
    <div class="container">
      <div class="row">
        <div class="col-md-12 text-left">
          <h3>Hardwares</h3>
        </div>
        <div class="col-md-12 pl-0 pr-0">
          <div class="col-md-3 product">
            <img src="../assets/monitor.jpg">
            <div class="product-desc">
              <h4>Monitor</h4>
              <div class="row">
                <div class="col-md-4 price">$700</div>
                <div class="col-md-8">
                  <button v-on:click="subtract(1)">-</button>
                  <input type="number" min="1" v-model="quantity">
                  <button v-on:click="add(1)">+</button>
                </div>
                <div class="col-md-12 text-center mt-2">
                <button class="btn btn-success">Buy</button>
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
      quantity: 1
    }
  },
  methods:{
    add: function(inc){
      this.quantity += inc;
    },
    subtract: function(dec){
      if(this.quantity>0){
        this.quantity -= dec;
      }
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
.price{
  font-size: 15px;
  font-weight: 600;
  color: #212121;
}
.product-desc input{
  max-width: 60%; 
}
</style>
