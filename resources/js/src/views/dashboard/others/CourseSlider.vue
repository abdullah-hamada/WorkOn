<template>

  <v-card class="greeting-card">
    <v-row class="ma-0 pa-0">
      <v-col cols="12">
        <v-card-title class="text-no-wrap pt-1 ps-2 text-primary"> آخر الدورات المنشورة 😎
        </v-card-title>
        <v-card-text>

          <section class="py-0 section-home">
            <VueSlickCarousel
              :arrows="true" :autoplay="true" :dots="true"
              :dotsClass="`slick-dots custom-dot-class`"
              :edgeFriction="0.35"
              :infinite="false"
              :slidesToScroll=" 1"
              :slidesToShow=" 1"
              :speed="500"
            >
              <div v-for="course in courses" class="slide-home">
                <a :href="`/course/${course.id}`" target="_blank">

                  <div class="image">
                    <img
                      :src="`/get_file/course_logos/${course.image}`"
                      alt=""
                    />
                  </div>
                  <div class="content">
                    <h2 class="font-weight-bolder white--text title-home"
                        style="line-height: 3rem; !important">
                      {{ course.title }}
                    </h2>
                    <h2 class="font-weight-regular white--text text-home">
                      <!--              {{event.brief_explanation}}-->
                    </h2>
                  </div>
                </a>
              </div>
            </VueSlickCarousel>
          </section>
        </v-card-text>
      </v-col>
    </v-row>
  </v-card>

</template>

<script>
import VueSlickCarousel from 'vue-slick-carousel'
import 'vue-slick-carousel/dist/vue-slick-carousel.css'
// optional style for arrows & dots
import 'vue-slick-carousel/dist/vue-slick-carousel-theme.css'

export default {
  name: "CoursesSlider",
  components: {VueSlickCarousel},
  props: {
    courses: Array
  }
}
</script>


<style lang="scss" scoped>
.v-image {
  width: 100% !important;
  height: 400px !important;
  cursor: pointer;
}

.section-home .slick-slide {
  height: 400px !important;
}

.slide-home {
  position: relative;
  //height: 650px;
  direction: rtl;

  &::before {
    //position: absolute;
    //content: "";
    //width: 100%;
    //height: 100%;
    //top: 0;
    //right: 0;
    //background-color: #000;
    //opacity: .6;
  }

  .content {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    z-index: 1;
    padding: 40px 90px;

    .title-home {
      font-size: 21px;
      line-height: 2rem;
    }

    @media (min-width: 992px) {
      max-width: 50%;
      right: 0;
      .title-home {
        font-size: 21px;
        line-height: 2rem;
      }
    }
  }

  .image {
    width: 100%;

    img {
      width: 100%;
      height: 400px !important;
      object-fit: cover;
    }
  }

  @media (max-width: 991px) {
    //height: 400px;
    .content {
      position: absolute;
      top: 50%;
      transform: translateY(-50%);
      z-index: 1;
      padding: 40px;
    }
  }
}


</style>
