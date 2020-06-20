<template>
<div class="section-footer">
	<div class="container">
		<div class="row">
			<div class="col-lg-12 col-md-12 footer-top">
				<a href="#">Privacy Policy</a>
				<a href="#">Terms Of Use</a>
			</div>
			<div class="col-lg-12 col-md-12">
				<hr>
			</div>
			<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 footer-bottom">
				<p class="copyright">Copyright © 2020</p>
			</div>
		</div>
	</div>
</div>
</template>
<script>
export default {
  name: 'Footer'
}
</script>

<style scoped>
.section-footer{
    text-align: center;
    background: #343a40;
    padding: 10px 0;
}
.footer-top a{
    color: #fff;
    text-decoration: none;
    padding: 0px 10px;
    border-right: 1px solid #fff
}
.footer-top a:last-child{
    border: none;
}
.footer-bottom{text-align: center; color: #fff;}
.section-footer hr{
    width: 100%;
    margin: 10px auto;
}
</style>