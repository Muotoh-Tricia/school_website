<template>
  <div class="main-container">
    <div>
      <img src="/about-img.jpg" class="about-img img-fluid" />
      <div class="about-text">
        <h5 class="fw-bold mb-0">Know Us Better</h5>
        <h1 class="fw-bolder">About Us</h1>
      </div>
    </div>

    <div class="d-flex row abt-txt-without-bg">
      <div class="col-4">
        <h1>Kingster's History</h1>
      </div>
      <div class="col-4">
        <p>If you would like to study in the university in the heart of the city that focus on changing the world for
          better tomorrow, you're choosing the right place. We do not use special formulas to select students. We look
          at every single applicant's application, academic and personal, to select students who suit to our community
          with a full range of backgrounds. If you would like to study</p>
      </div>
      <div class="col-4">
        <p>If you would like to study in the university in the heart of the city that focus on changing the world for
          better tomorrow, you're choosing the right place. We do not use special formulas to select students. We look
          at every single applicantt's application, academic and personal, to select students who suit to our community.
        </p>
      </div>
    </div>

    <div class="row abt-txt-with-bg">
      <div class="col-4">
        <h3 class="mb-4">Our Philosophy</h3>
        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I
          enjoy with my whole heart. I am alone, and feel the charm of existence.</p>
      </div>
      <div class="col-4">
        <h3 class="mb-4">Kingster's Principle</h3>
        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I
          enjoy with my whole heart. I am alone, and feel the charm of existence.</p>
      </div>
      <div class="col-4">
        <h3 class="mb-4">Key Of Success</h3>
        <p>A wonderful serenity has taken possession of my entire soul, like these sweet mornings of spring which I
          enjoy with my whole heart. I am alone, and feel the charm of existence.</p>
      </div>
    </div>

    <div class="d-flex row abt-txt-with-img">
      <div class="col-6 mt-5">
        <h1 class="mt-5"> Special Campus Tour </h1>
        <p>Campus on a tour designed for prospective graduate and professional students. You will see how our university
          like, facilities, studenst and life in this university. Meet our graduate admissions representative to learn
          more about our graduate programs and decide what it the best for you.</p>
      </div>
      <div class="col-6">
        <img src="/building-img.avif" class="building-img img-fluid" />
      </div>
    </div>

    <div class="d-flex row abt-txt-with-img2 ">
      <div class="col-6">
        <img src="/graduation-img.avif" class="img-fluid graduation-img" />
      </div>
      <div class="col-6 mt-5 abt-txt-with-img2-text-content">
        <h1 class="mt-5"> Special Campus Tour </h1>
        <p>Campus on a tour designed for prospective graduate and professional students. You will see how our university
          like, facilities, studenst and life in this university. Meet our graduate admissions representative to learn
          more about our graduate programs and decide what it the best for you.</p>
      </div>
    </div>

  </div>
</template>

<script>
export default {

}
</script>

<style scoped>
.about-img {
  width: 90%;
  object-fit: cover;
  height: auto;
  max-height: 500px;
  margin: 6% 5% 2% 5%;
  border-radius: 7px;
  position: relative;
}

.about-text {
  color: rgb(255, 255, 255);
  position: absolute;
  top: 67%;
  left: 6%;
}

.abt-txt-without-bg {
  padding: 0 5%;
  line-height: 30px;
}

.abt-txt-with-bg {
  background-color: rgb(168, 26, 58);
  color: rgb(255, 255, 255);
  padding: 5% 5%;
  line-height: 30px;
  margin: 5% 5% 0 5%;
}

.abt-txt-with-img {
  padding: 0 5%;
  background-color: rgb(242 242 242);
  margin: 0 5% 0 5%;
}

.building-img {
  margin: 0 0 0 15%;
}

.building-img:hover {
  transform: translateY(8px);
  box-shadow: 0 4px 10px rgba(9, 8, 8, 0.8);
}

.abt-txt-with-img2 {
  padding: 0 5%;
  background-color: rgb(242 242 242);
  margin: 0 5% 5% 5%;
}

.graduation-img:hover {
  transform: translateY(-8px);
  box-shadow: 0 4px 10px rgba(9, 8, 8, 0.8);
}

.abt-txt-with-img2-text-content {
  padding: 0 0 0 8%;
}
</style>