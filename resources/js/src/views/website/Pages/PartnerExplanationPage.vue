<template>
  <div>
    <section
      class="section section-home py-0"
    >
      <swiper :options="swiperOptionsHome">
        <swiper-slide v-for="item in slider_items" :key="item.id"
                      :style="{ 'background': 'url(/get_file/website_images/' + item.image +')' + 'center no-repeat' }"
                      style="background: url(/images/bg-home2.png?5de844e…) center no-repeat; background-repeat: no-repeat;  background-size: cover;"
        >
          <v-container>
            <v-row>
              <v-col class="mx-auto text-center" cols="12" lg="6">
                <h1 class="home-title font-weight-bold white--text mb-6" data-aos="fade-up"
                    data-aos-delay="50" data-aos-duration="1500"> {{ item.title }} </h1>
                <h3 class="home-text white--text mb-9" data-aos="fade-up" data-aos-delay="150"
                    data-aos-duration="1500">
                  {{ item.paragraph }}
                </h3>
                <Link v-if="item.button_text" :href="item.button_url"
                      class="btn btn-outline-white rounded-pill" data-aos="fade-up"
                      data-aos-delay="250" data-aos-duration="1500"> {{ item.button_text }}
                </Link>
              </v-col>
            </v-row>
          </v-container>
        </swiper-slide>
        <div slot="pagination" class="swiper-pagination"></div>
      </swiper>

    </section>

    <section id="freelance_incubator" class="section bg-1">
      <v-container>
        <v-row class="mb-2" data-aos="fade-up" data-aos-duration="1500">
          <v-col class="mx-auto" cols="12" lg="6">
            <h2 class="section-title font-weight-bold text-center">{{ section_two_item.title }}</h2>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="mx-auto" cols="12" lg="11">
            <v-row>
              <v-col cols="12" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1500"
                     data-aos-offset="200" lg="6">
                <img :src="`/get_file/website_images/${section_two_item.image}`" alt=""
                     class="rounded-5 fill-height"/>
              </v-col>
              <v-col cols="12" data-aos="fade-right" data-aos-delay="200" data-aos-duration="1500"
                     data-aos-offset="200" lg="6">
                <h5 class="text-justify text_organize">
                  {{ section_two_item.paragraph }}
                </h5>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section class="section section-whay py-4">
      <v-container>
        <v-row data-aos="fade-up" data-aos-duration="1500">
          <v-col class="mx-auto" cols="12" lg="12">
            <h2 class="section-title font-weight-bold text-center mb-2 white--text">
              {{ section_three_item.title }}</h2>
          </v-col>
        </v-row>
        <v-row>
          <v-col v-for="item in section_three_items" :key="item.id" cols="12" data-aos="fade-up" data-aos-delay="100"
                 data-aos-duration="1500" data-aos-offset="200" lg="3"
                 md="6">
            <div class="widget_item-why text-center mb-4">
              <div class="widget_item-icon mx-auto mb-4 d-flex align-center justify-center">
                <img :src="`/get_file/website_images/${item.image}`" alt=""/>
              </div>
              <div class="widget_item-content">
                <h4 class="widget_item-title white--text mb-3 font-weight-bold">
                  {{ item.title }} </h4>
                <h5 class="widget_item-desc white--text">
                  {{ item.paragraph }}
                </h5>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section class="section section-guidance py-17 my-10 bg-2 bg-3 reverse-bg">
      <v-container>
        <v-row class="align-center">
          <v-col class="position-relative" cols="12" data-aos="fade-left" data-aos-delay="100"
                 data-aos-duration="1500" data-aos-offset="200" md="6">
            <div class="text-center image">
              <img style="height: 400px"  :src="`/get_file/website_images/${section_four_item.image}`" alt="" height="400px"/>
            </div>
          </v-col>
          <v-col cols="12" data-aos="fade-right" data-aos-delay="100" data-aos-duration="1500"
                 data-aos-offset="200" md="6">
            <h2 class="section-title font-weight-bold mb-4">{{ section_four_item.title }}</h2>
            <h5 class="mb-9">
              {{ section_four_item.paragraph }}
            </h5>
            <a v-if="section_four_item.button_text" :href="section_four_item.button_url"
               class="btn btn-primary">{{ section_four_item.button_text }}</a>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section id="about_us" class="section section-testimonial">
      <v-container>
        <v-row class="text-center" data-aos="fade-up" data-aos-delay="400" data-aos-duration="1500"
               data-aos-offset="400">
          <v-col class="mx-auto" cols="12" lg="12">
            <h2 class="section-title font-weight-bold text-center">
              {{ section_six_item.title }}</h2>
          </v-col>
        </v-row>
        <v-row class="position-relative" data-aos="fade-up" data-aos-delay="400"
               data-aos-duration="1500" data-aos-offset="400">
          <v-col cols="12">
            <swiper :options="swiperOptions2" class="pb-4">
              <swiper-slide v-for="item in section_six_items" :key="item.id">
                <div class="widget_item-testimonial">
                  <div class="d-flex align-center">
                    <div class="widget_item-image mb-4">
                      <img :src="`/get_file/website_images/${item.image}`" alt=""/>
                    </div>
                    <div class="d-flex flex-column">
                      <h5 class="font-bold">{{ item.title }} </h5>
                      <h5 class="text-primary">{{ item.sub_title }}</h5>
                    </div>
                  </div>
                  <div class="widget_item-content">
                    <h5>
                      {{ item.paragraph }}
                    </h5>
                  </div>
                </div>
              </swiper-slide>

              <div slot="pagination" class="swiper-pagination"></div>
            </swiper>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <FlashMessage></FlashMessage>
  </div>
</template>

<script>
import {directive, Swiper, SwiperSlide} from 'vue-awesome-swiper'
import 'swiper/css/swiper.css'
import FlashMessage from "../../../Sahred/FlashMessage";
import website_layout from "../../../layouts/website_layout/layout";
import AOS from 'aos'
import 'aos/dist/aos.css'

export default {
  props: {
    section_two_item: Object,
    section_three_items: Array,
    section_three_item: Object,
    section_four_item: Object,
    section_six_item: Object,
    section_six_items: Array,
    slider_items: Array,

  },
  layout: website_layout,
  data() {
    return {
      swiperOptionsHome: {
        slidesPerView: 1,
        speed: 1500,
        pagination: {
          el: '.section-home .swiper-pagination',
          clickable: true,
        },
        navigation: {
          nextEl: ".swiper-next-home",
          prevEl: ".swiper-prev-home",
        },
      },
      sidebar: false,
      tabs: null,
      swiperOptions1: {
        spaceBetween: 0,
        navigation: {
          nextEl: '.swiper-next-trainer',
          prevEl: '.swiper-prev-trainer',
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          640: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 4,
          },
        },
      },
      swiperOptions2: {
        spaceBetween: 0,
        pagination: {
          el: '.section-testimonial .swiper-pagination',
          clickable: true,
        },
        breakpoints: {
          0: {
            slidesPerView: 1,
          },
          640: {
            slidesPerView: 1,
          },
          768: {
            slidesPerView: 3,
          },
          1200: {
            slidesPerView: 3,
          },
        },
      },
      swiperOptions4: {
        spaceBetween: 20,
        pagination: {
          el: '.swiper-service .swiper-pagination',
          clickable: true,
        },
        breakpoints: {
          0: {
            slidesPerView: 2,
          },
          640: {
            slidesPerView: 4,
          },
          768: {
            slidesPerView: 5,
          },
          1200: {
            slidesPerView: 6,
          },
        },
      },
    }
  },
  components: {
    Swiper,
    SwiperSlide, FlashMessage
  },
  directives: {
    swiper: directive,
  },
  mounted() {
    AOS.init()
  },
  methods: {},

}
</script>


<style lang="scss" >
.section-home {
  .btn {
    color: #FFF !important;
    border: 1px solid #fff;
    border-radius: 50rem !important;
  }
}
.section {
  padding: 30px 0;
  @media (min-width: 992px) {
    padding: 70px 0;
  }
}
.btn {
  border: 1px solid var(--secondar);
  display: inline-block;
  padding: 12px 26px;
  color: var(--secondary) !important;
  outline: none;
  border-radius: 5px !important;
  text-decoration: none;
  transition: all 0.2s ease-in-out;
  font-size: 16px;

  &:hover {
    background-color: var(--primary);
    border-color: var(--primary);
    color: #fff !important;

    svg {
      path {
        stroke: #fff;
      }
    }
  }

  &.btn-primary {
    border-color: var(--primary);
    color: #fff !important;
    background-color: var(--primary);

    &:hover {
      background-color: var(--primary);
      border-color: var(--primary);
    }
  }

  &.btn-primary-2 {
    border-color: #a21300;
    color: #fff !important;
    background-color: #a21300 !important;

    &:hover {
      background-color: var(--primary) !important;
      border-color: var(--primary) !important;
    }
  }

  &.btn-outline-primary {
    border-color: var(--primary) !important;
    color: var(--primary) !important;
    background-color: transparent;

    &:hover {
      background-color: var(--primary) !important;
      color: #fff !important;
      border-color: var(--primary) !important;
    }
  }

  &.btn-white {
    border-color: #fff;
    color: var(--primary) !important;
    background-color: #fff;

    &:hover {
      background-color: var(--primary);
      color: #fff !important;
      border-color: var(--primary);
    }
  }
}
.section-title {
  @media (min-width: 992px) {
    font-size: 36px;
  }
}
.section-home {
  padding: 70px 0;
  position: relative;
  z-index: 1;

  &::before {
    position: absolute;
    content: '';
    z-index: -1;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: #141414;
    opacity: 0.7;
  }

  @media (min-width: 992px) {
    &::after {
      position: absolute;
      content: '';
      z-index: -1;
      width: 320px;
      height: 100%;
      top: 0;
      inset-inline-end: 140px;
      background: url('/images/home/vector-home.png');
      mix-blend-mode: overlay;
    }
    height: 520px;
    display: flex;
    align-items: center;
  }
  @media (max-width: 992px) {
    padding: 40px 10px 40px !important;
  }

  .home-title {
    font-size: 36px;
  }

  .home-text {
    font-size: 16px;
  }
}
.bg-1 {
  //background: url('/images/home/bg-01.svg');
  //background-repeat: no-repeat;
  //background-position: left bottom;
  //background-size: auto;
}
.widget_item-serv {
  background-color: #ffe9e6;
  border-radius: 16px;
  padding: 17px 5px;

  .widget_item-icon {
    width: 50px;
    height: 50px;
    border-radius: 50%;
    color: #fff;
    background-color: var(--primary);

    img {
      max-height: 30px;
    }
  }

  .widget_item-title {
    color: #030303;
  }

  .widget_item-desc {
    color: #4b5563;
  }
}
.position-relative {
  position: relative;
}
.section-guidance {
  background-color: #f3f4f6;

  .image {
    img {
      border-radius: 60px 60px 0 60px;
    }

    @media (min-width: 992px) {
      img {
        height: 445px;
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
      }
    }
  }
}
.bg-2 {
  z-index: 1;
  position: relative;

  &::before {
    position: absolute;
    z-index: -1;
    content: '';
    inset-inline-start: 0;
    top: 0;
    background: url('/images/home/bg-02.png');
    background-repeat: no-repeat;
    background-position: left bottom;
    background-size: auto;
    height: 100%;
    width: 330px;
    mix-blend-mode: overlay;
  }
}
.bg-3 {
  z-index: 1;
  position: relative;

  &::after {
    position: absolute;
    z-index: -1;
    content: '';
    inset-inline-end: 100px;
    top: 50%;
    transform: translateY(-50%);
    background: url('/images/home/bg-03.png');
    background-repeat: no-repeat;
    background-position: left bottom;
    background-size: auto;
    height: 195px;
    width: 162px;
  }
}
.section-info {
  background: url('/images/home/bg-07.png');
  background-repeat: no-repeat;
  background-position: 50% 0%;
  background-size: auto;
}
.widget_item-info {
  .widget_item-icon {
    height: 170px;
  }

  .widget_item-number {
    font-size: 48px;
  }

  .widget_item-title {
    color: #374151;
  }

  &.widget-1 {
    .widget_item-icon {
      background: url('/images/home/bg-04.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: auto;
    }
  }

  &.widget-2 {
    .widget_item-icon {
      background: url('/images/home/bg-05.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: auto;
    }
  }

  &.widget-3 {
    .widget_item-icon {
      background: url('/images/home/bg-06.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: auto;
    }
  }
}
.section-whay {
  background: url('/images/home/section-why.svg');
  background-position: center;
  background-repeat: no-repeat;
  background-size: cover;
}
.widget_item-why {
  .widget_item-icon {
    background-color: #ffc0b8;
    border-radius: 50%;
    width: 97px;
    height: 97px;
    color: var(--primary);

    img {
      max-height: 50px;
    }
  }

  .widget_item-desc {
    color: #ffe9e6;
  }
}
.reverse-bg {
  &.bg-2::before {
    inset-inline-start: unset;
    inset-inline-end: 0;
    transform: scaleX(-1);
    height: 99%;
  }

  &.bg-3::after {
    inset-inline-start: 100px;
    inset-inline-end: unset;
    transform: scaleX(-1) translateY(-50%);
  }

  .image img {
    border-radius: 60px 60px 60px 0px;
  }
}
.widget_item-testimonial {
  background: #ffffff;
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  padding: 20px;
  margin: 20px;
  border-radius: 8px;

  .widget_item-image {
    margin-inline-end: 20px;

    img {
      width: 80px;
      height: 80px;
      border-radius: 50%;
    }
  }
}
.section-testimonial {
  .swiper-pagination {
    .swiper-pagination-bullet {
      background-color: transparent;
      border: 2px solid var(--primary);

      &.swiper-pagination-bullet-active {
        background-color: var(--primary);
      }
    }
  }
}
@media (max-width: 991px) {
  .logo {
    img {
      max-width: 100px;
    }
  }
}
.section-home {
  padding: 0 !important;

  .swiper-container {
    width: 100%;
  }

  .swiper-slide {
    display: flex;
    align-items: center;
    z-index: 1;

    &::before {
      position: absolute;
      content: "";
      z-index: -1;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      background-color: #141414;
      opacity: 0.7;
    }
  }

  @media(max-width: 991px) {
    .swiper-wrapper {
      height: auto;

      .swiper-slide {
        padding: 50px 30px;
      }
    }
  }

  @media(min-width: 992px) {
    .swiper-service .swiper-wrapper {
      justify-content: center;
    }
  }


  .action-swiper {
    @media(min-width: 992px) {
      width: 90%;
    }
    @media(max-width: 991px) {
      top: 50%;
    }

    .swiper-next-home svg,
    .swiper-prev-home svg {
      height: 40px;
      width: 40px;
    }
  }

  .swiper-pagination .swiper-pagination-bullet {
    background: #fff;
    border-radius: 30px;
    height: 12px;
    opacity: 1;
    transition: all .2s ease-in-out;
    width: 12px;

    &.swiper-pagination-bullet-active {
      background: var(--primary);
      width: 30px;
    }
  }
}
</style>









