<template>
  <div>
    <img class="landing-page-img" src="/landing-page.jpg" />
    <div class="coou-text-landing-page">
      <h1>Chukwuemeka Odumegwu Ojukwu University Portal</h1>
      <P>Find all our authenticated applications and registrations below for various student types and programmesLearn
        more</P>
        <router-link to="" class="btn btn-success" >Learn More</router-link>
    </div>

    <div class="text-center m-5">
      <h4><b>Programmes, Applications and Payments</b></h4>
      <p>Find all our authenticated applications and registrations below for various student types and programmes</p>
    </div>

    <div class="admission-contents">
      <div class="card rounded-4" style="width: 18rem;">
        <img src="..." class="card-img-top" alt="...">
        <div class="card-body">
          <h5 class="card-title">Card title</h5>
          <p class="card-text">Some quick example text to build on the card title and make up the bulk of the card's
            content.</p>
            <router-link to="" class="btn btn-success">Go somewhere</router-link>
        </div>
      </div>
    </div>



  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.landing-page-img {
  width: 100%;
  object-fit: cover;
  height: auto;
  max-height: 729px;
  position: relative;
}

.coou-text-landing-page {
  padding: 50px;
  width: 50%;
  border-radius: 10px;
  background-color: rgba(227, 240, 255, 0.6);
  position: absolute;
  left: 4%;
  top: 38%;
}

.admission-contents{
  background-color: rgb(244, 245, 247);
  border-radius: 15px;
  width: 60%;
  margin: 10px auto;
  padding: 30px;
}
</style>