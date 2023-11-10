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
      <!--      <div-->
      <!--          class="action-swiper d-flex align-center justify-space-between w-100">-->
      <!--        <div-->
      <!--            class="swiper-prev-home d-flex align-center justify-center"-->
      <!--            slot="button-prev"-->
      <!--        >-->
      <!--          <svg-->
      <!--              width="20"-->
      <!--              height="14"-->
      <!--              viewBox="0 0 20 14"-->
      <!--              fill="none"-->
      <!--              xmlns="http://www.w3.org/2000/svg"-->
      <!--          >-->
      <!--            <path-->
      <!--                d="M12.43 0.929993L18.5 6.99999L12.43 13.07M1.5 6.99999H18.33"-->
      <!--                stroke="white"-->
      <!--                stroke-width="1.5"-->
      <!--                stroke-miterlimit="10"-->
      <!--                stroke-linecap="round"-->
      <!--                stroke-linejoin="round"-->
      <!--            />-->
      <!--          </svg>-->
      <!--        </div>-->
      <!--        <div-->
      <!--            class="swiper-next-home d-flex align-center justify-center"-->
      <!--            slot="button-next"-->
      <!--        >-->
      <!--          <svg-->
      <!--              width="20"-->
      <!--              height="14"-->
      <!--              viewBox="0 0 20 14"-->
      <!--              fill="none"-->
      <!--              xmlns="http://www.w3.org/2000/svg"-->
      <!--          >-->
      <!--            <path-->
      <!--                d="M7.57 0.929993L1.5 6.99999L7.57 13.07M18.5 6.99999H1.67"-->
      <!--                stroke="white"-->
      <!--                stroke-width="1.5"-->
      <!--                stroke-miterlimit="10"-->
      <!--                stroke-linecap="round"-->
      <!--                stroke-linejoin="round"-->
      <!--            />-->
      <!--          </svg>-->
      <!--        </div>-->
      <!--      </div>-->
    </section>
    <!--    <section-->
    <!--      :style="{ 'background': 'url(/get_file/website_images/' + section_one_item.image +')' + 'center no-repeat' }"-->
    <!--      class="section section-home"-->
    <!--      style="-->
    <!--           background-repeat: no-repeat;-->
    <!--          background-size: cover;-->
    <!--        "-->
    <!--    >-->
    <!--      <v-container>-->
    <!--        <v-row>-->
    <!--          <v-col cols="12" lg="6">-->
    <!--            <h1 class="home-title font-weight-bold white&#45;&#45;text mb-6">-->
    <!--              {{ section_one_item.title }}</h1>-->
    <!--            <h3 class="home-text white&#45;&#45;text mb-9">-->
    <!--              {{ section_one_item.paragraph }}-->
    <!--            </h3>-->
    <!--            <Link v-if="section_one_item.button_text" :href="section_one_item.button_url"-->
    <!--                  class="btn btn-primary"> {{ section_one_item.button_text }}-->
    <!--            </Link>-->
    <!--          </v-col>-->
    <!--        </v-row>-->
    <!--      </v-container>-->
    <!--    </section>-->
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
    <section id="services" class="section">
      <v-container>
        <v-row data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
               data-aos-offset="200">
          <v-col class="mx-auto" cols="12" lg="6">
            <h2 class="section-title font-weight-bold text-center">
              {{ section_three_item.title }}</h2>
          </v-col>
        </v-row>

        <v-row data-aos="fade-up" data-aos-delay="100" data-aos-duration="1500"
               data-aos-offset="200">
          <v-col cols="12">
            <swiper :options="swiperOptions4" class="swiper-service mb-5 ">
              <swiper-slide v-for="item in services" :key="item.id">
                <div class="widget_item-serv text-center cursor-pointer"
                     @click="show_service_info_section(item)">
                  <div class="widget_item-icon mx-auto mb-3 d-flex align-center justify-center">
                    <img :src="item.preview_image" alt="" class="rounded-5"/>
                  </div>
                  <div class="widget_item-content">
                    <h6 class="widget_item-title font-weight-bold mb-2">{{ item.name }}</h6>
                    <h6 class="widget_item-desc"> {{ item.courses_count }} دورة </h6>
                  </div>
                </div>
              </swiper-slide>

              <div slot="pagination" class="swiper-pagination"></div>
            </swiper>
          </v-col>
        </v-row>
      </v-container>
    </section>


    <section v-if="show_service_info_data" id="guidance"
             class="section section-guidance py-10 my-10 bg-2 bg-3">
      <v-container>
        <v-row class="align-center">
          <v-col cols="12" data-aos="fade-left" data-aos-delay="100" data-aos-duration="1500" data-aos-offset="200"
                 md="6">
            <h2 class="section-title font-weight-bold mb-4"> {{ service_info.title }} </h2>
            <h5 class="mb-9  text_organize">
              {{ service_info.paragraph }}
            </h5>
            <a v-if="service_info.button_text" :href="service_info.button_url"
               class="btn btn-primary "> {{ service_info.button_text }} </a>

          </v-col>
          <v-col class="position-relative" cols="12" data-aos="fade-right" data-aos-delay="100"
                 data-aos-duration="1500" data-aos-offset="200" md="6">
            <div class="text-center image">
              <img :src="`/get_file/service_description_images/${service_info.description_image}`"
                   alt=""/>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>


    <!--    <section id="guidance" class="section section-guidance py-10 my-10 bg-2 bg-3">-->
    <!--      <v-container>-->
    <!--        <v-row class="align-center">-->
    <!--          <v-col cols="12" md="6">-->
    <!--            <h2 class="section-title font-weight-bold mb-4">{{ section_four_item.title }} </h2>-->
    <!--            <h5 class="mb-9  text_organize">-->
    <!--              {{ section_four_item.paragraph }}-->
    <!--            </h5>-->
    <!--            <a v-if="section_four_item.button_text" :href="section_four_item.button_url"-->
    <!--               class="btn btn-primary"> {{ section_four_item.button_text }} </a>-->

    <!--          </v-col>-->
    <!--          <v-col class="position-relative" cols="12" md="6">-->
    <!--            <div class="text-center image">-->
    <!--              <img :src="`/get_file/website_images/${section_four_item.image}`" alt=""/>-->
    <!--            </div>-->
    <!--          </v-col>-->
    <!--        </v-row>-->
    <!--      </v-container>-->
    <!--    </section>-->
    <section id="numbers" class="section section-info">
      <v-container>
        <v-row data-aos="fade-up" data-aos-duration="1500">
          <v-col class="mx-auto" cols="12" lg="12">
            <h2 class="section-title font-weight-bold text-center mb-2">{{ section_five_item.title
              }}</h2>
            <h5 class="text-center mb-3">
              {{ section_five_item.paragraph }}
            </h5>
          </v-col>
        </v-row>
        <v-row>
          <v-col class="mx-auto" cols="12" lg="10">
            <v-row class="justify-center">
              <v-col v-for="item in section_five_items" :key="item.id" cols="6" data-aos="fade-up"
                     data-aos-delay="100" data-aos-duration="1500" data-aos-offset="200"
                     md="4">
                <div class="widget_item-info widget-1 text-center mb-5">
                  <div class="widget_item-icon mx-auto mb-3 d-flex align-center justify-center">
                    <img :src="`/get_file/website_images/${item.image}`" alt=""/>
                  </div>
                  <div class="widget_item-content">
                    <h6 class="widget_item-number text-primary font-weight-bold mb-2">
                      {{ item.title }}</h6>
                    <h4 class="widget_item-title">{{ item.sub_title }} </h4>
                  </div>
                </div>
              </v-col>
            </v-row>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <!--    <section id="memberships" class="section section-membership">-->
    <!--      <v-container>-->
    <!--        <v-row>-->
    <!--          <v-col cols="12" lg="12" class="mx-auto">-->
    <!--            <h2 class="section-title font-weight-bold text-center mb-2">{{ section_six_item.title }}  </h2>-->
    <!--          </v-col>-->
    <!--        </v-row>-->
    <!--        <v-row>-->
    <!--          <v-col cols="12" lg="10" class="mx-auto">-->
    <!--            <v-row>-->
    <!--              <v-col cols="11" class="mx-auto">-->
    <!--                <div class="list-items-membership" >-->
    <!--                  <div class="widget_item-membership widget-1 text-center mb-5" v-for="(item,index) in section_six_items" :key="item.id"-->
    <!--                       :style="{ 'background': 'url(' +index  == 1 ?  '/images/home/bg-08.png' :  '/images/home/bg-09.png' +')' }">-->

    <!--                    <div class="widget_item-icon mx-auto mb-4 d-flex align-center justify-center"  >-->
    <!--                      <img  :src="`/get_file/website_images/${item.image}`" alt="" />-->
    <!--                    </div>-->
    <!--                    <div class="widget_item-content">-->
    <!--                      <h5 class="widget_item-title">{{ item.title }}</h5>-->
    <!--                    </div>-->
    <!--                  </div>-->
    <!--                </div>-->
    <!--              </v-col>-->
    <!--            </v-row>-->
    <!--          </v-col>-->
    <!--        </v-row>-->
    <!--      </v-container>-->
    <!--    </section>-->
    <section class="section section-whay py-4">
      <v-container>
        <v-row data-aos="fade-up" data-aos-duration="1500">
          <v-col class="mx-auto" cols="12" lg="12">
            <h2 class="section-title font-weight-bold text-center mb-2 white--text">
              {{ section_seven_item.title }}</h2>
          </v-col>
        </v-row>
        <v-row>
          <v-col v-for="item in section_seven_items" :key="item.id" cols="12" data-aos="fade-up" data-aos-delay="100"
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
    <section id="courses" class="section section-course">
      <v-container>
        <v-row data-aos="fade-left" data-aos-duration="1500">
          <v-col class="mx-auto" cols="12" lg="12">
            <h2 class="section-title font-weight-bold mb-3">الدورات التدريبية</h2>
            <div
              class="d-flex flex-column flex-lg-row align-center justify-between align-items-center">
              <div class="col">
                <v-tabs v-model="tabs" class="course_types_tabs" flat>
                  <!--                  <v-tab> الأكثر مبيعاً </v-tab>-->
                  <v-tab> أحدث الدورت</v-tab>
                  <v-tab> الدورات المجانية</v-tab>
                  <v-tab> الدورات المدفوعة</v-tab>

                </v-tabs>
              </div>
              <div class="col-auto">
                <Link class="btn btn-outline-primary" href="/all_courses">عرض المزيد</Link>
              </div>
            </div>
          </v-col>
        </v-row>
        <v-tabs-items v-model="tabs" data-aos="fade-up" data-aos-delay="100"
                      data-aos-duration="1500" data-aos-offset="200">
          <v-tab-item>
            <v-row>
              <v-col v-for="item in latest_courses" :key="item.id" cols="12" lg="4">
                <div class="widget_item-course mb-4">
                  <div class="widget_item-image">
                    <Link :href="`/course/${item.id}`"><img
                      :src="`/get_file/course_logos/${item.image}`" alt=""/></Link>
                  </div>
                  <div class="widget_item-content">
                    <h4 class="widget_item-title mb-3 font-weight-bold">
                      <Link :href="`/course/${item.id}`"> {{ item.title }}</Link>
                    </h4>
                    <h5 class="widget_item-desc">المدرب: {{ item.trainer.name }}</h5>
                    <h6 class="widget_item-jop">{{ item.service.name }} </h6>
                  </div>
                </div>
              </v-col>
            </v-row>
          </v-tab-item>
          <v-tab-item>
            <v-row>
              <v-col v-for="item in free_courses" :key="item.id" cols="12" lg="4">
                <div class="widget_item-course mb-4">
                  <div class="widget_item-image">
                    <Link :href="`/course/${item.id}`"><img
                      :src="`/get_file/course_logos/${item.image}`" alt=""/></Link>
                  </div>
                  <div class="widget_item-content">
                    <h4 class="widget_item-title mb-3 font-weight-bold">
                      <Link :href="`/course/${item.id}`"> {{ item.title }}</Link>
                    </h4>
                    <h5 class="widget_item-desc">المدرب: {{ item.trainer.name }}</h5>
                    <h6 class="widget_item-jop">{{ item.service.name }} </h6>
                  </div>
                </div>
              </v-col>
            </v-row>
          </v-tab-item>
          <v-tab-item>
            <v-row>
              <v-col v-for="item in pay_courses" :key="item.id" cols="12" lg="4">
                <div class="widget_item-course mb-4">
                  <div class="widget_item-image">
                    <Link :href="`/course/${item.id}`"><img
                      :src="`/get_file/course_logos/${item.image}`" alt=""/></Link>
                  </div>
                  <div class="widget_item-content">
                    <h4 class="widget_item-title mb-3 font-weight-bold">
                      <Link :href="`/course/${item.id}`"> {{ item.title }}</Link>
                    </h4>
                    <h5 class="widget_item-desc">المدرب: {{ item.trainer.name }}</h5>
                    <h6 class="widget_item-jop">{{ item.service.name }} </h6>
                  </div>
                </div>
              </v-col>
            </v-row>
          </v-tab-item>

        </v-tabs-items>
      </v-container>
    </section>
    <section class="section section-join py-lg-16 py-10">
      <v-container class="py-7">
        <v-row class="text-center" data-aos="fade-up" data-aos-delay="300" data-aos-duration="1500"
               data-aos-offset="300">
          <v-col class="mx-auto" cols="12" lg="12">
            <h2 class="section-title font-weight-bold text-center mb-3 white--text">
              {{ section_nine_item.title }}</h2>
            <h5 class="mb-7 white--text">{{ section_nine_item.paragraph }}</h5>
            <a v-if="section_nine_item.button_text" :href="section_nine_item.button_url"
               class="btn btn-white">{{ section_nine_item.button_text }}</a>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section id="trainers" class="section section-trainer">
      <v-container>
        <v-row class="text-center" data-aos="fade-up" data-aos-delay="200" data-aos-duration="1500"
               data-aos-offset="300">
          <v-col class="mx-auto" cols="12" lg="12">
            <h2 class="section-title font-weight-bold text-center mb-3">
              {{ section_ten_item.title }} </h2>
            <h5 class="text-center mb-3">{{ section_ten_item.paragraph }} </h5>
          </v-col>
        </v-row>
        <div class="position-relative" data-aos="fade-up" data-aos-delay="250"
             data-aos-duration="1500" data-aos-offset="300">
          <v-row class="position-relative">
            <v-col class="position-relative mx-auto" cols="11">
              <swiper :options="swiperOptions1">
                <swiper-slide v-for="item in trainers" :key="item.id">
                  <div class="widget_item-trainer text-center">
                    <div class="widget_item-image mb-4">
                      <img :src="`/get_file/trainer_images/${item.image}`" alt=""/>
                    </div>
                    <div class="widget_item-content">
                      <h4 class="font-weight-bold text-primary mb-1">{{ item.name }}</h4>
                      <h6 class="mb-5">{{ item.job_title }}</h6>
                      <div class="social-media mb-2">
                        <a v-if="item.twitter_url" :href="item.twitter_url" target="_blank">
                          <v-icon class="icon_social" color="#fff"> mdi-twitter</v-icon>
                        </a>
                        <a v-if="item.instagram_url" :href="item.instagram_url" target="_blank">
                          <v-icon class="icon_social" color="#fff"> mdi-instagram</v-icon>
                        </a>
                        <a v-if="item.facebook_url" :href="item.facebook_url" target="_blank">
                          <v-icon class="icon_social" color="#fff"> mdi-facebook</v-icon>
                        </a>
                        <a v-if="item.linked_in_url" :href="item.linked_in_url" target="_blank">
                          <v-icon class="icon_social" color="#fff"> mdi-linkedin</v-icon>
                        </a>
                        <a v-if="item.website_url" :href="item.website_url" target="_blank">
                          <v-icon class="icon_social" color="#fff"> mdi-web</v-icon>
                        </a>
                      </div>
                    </div>
                  </div>
                </swiper-slide>
              </swiper>
            </v-col>
          </v-row>
          <div class="action-swiper d-flex align-center justify-space-between w-100">
            <div slot="button-prev" class="swiper-prev-trainer d-flex align-center justify-center">
              <v-icon>mdi-arrow-right</v-icon>
            </div>
            <div slot="button-next" class="swiper-next-trainer d-flex align-center justify-center">
              <v-icon>mdi-arrow-left</v-icon>
            </div>
          </div>
        </div>
      </v-container>
    </section>
    <section class="section section-guidance py-10 my-10 bg-2 bg-3 reverse-bg">
      <v-container>
        <v-row class="align-center">
          <v-col class="position-relative" cols="12" data-aos="fade-left" data-aos-delay="100"
                 data-aos-duration="1500" data-aos-offset="200" md="6">
            <div class="text-center image">
              <img :src="`/get_file/website_images/${section_eleven_item.image}`" alt=""/>
            </div>
          </v-col>
          <v-col cols="12" data-aos="fade-right" data-aos-delay="100" data-aos-duration="1500"
                 data-aos-offset="200" md="6">
            <h2 class="section-title font-weight-bold mb-4">{{ section_eleven_item.title }}</h2>
            <h5 class="mb-9">
              {{ section_eleven_item.paragraph }}
            </h5>
            <a v-if="section_eleven_item.button_text" :href="section_eleven_item.button_url"
               class="btn btn-primary">{{ section_eleven_item.button_text }}</a>
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
              {{ section_twelve_item.title }}</h2>
          </v-col>
        </v-row>
        <v-row class="position-relative" data-aos="fade-up" data-aos-delay="400"
               data-aos-duration="1500" data-aos-offset="400">
          <v-col cols="12">
            <swiper :options="swiperOptions2" class="pb-4">
              <swiper-slide v-for="item in section_twelve_items" :key="item.id">
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
    <section class="section section-mailing py-4">
      <v-container>
        <v-row class="align-center">
          <v-col cols="12" data-aos="fade-left" data-aos-delay="300" data-aos-duration="1500" data-aos-offset="400"
                 lg="8">
            <h2 class="text--dark font-weight-bold mb-8">
              اشترك معنا في القائمة البريدية ليصلك كل جديد من الدورات والأخبار
            </h2>
            <v-row>
              <v-col cols="12" lg="8">
                <form action="" class="form-mailing">
                  <div class="d-flex">
                    <v-text-field v-model="subscribe_news_form.email"
                                  :error-messages="$page.props.errors.email" outlined
                                  placeholder="ادخل البريد الالكتروني"></v-text-field>
                    <v-btn :loading="subscribe_news_form.processing" color="#A21300" variant="tonal"
                           @click="submit_subscribe_user_news"> اشترك
                    </v-btn>
                  </div>
                </form>
              </v-col>
            </v-row>
          </v-col>
          <v-col class="d-none d-lg-block" cols="12" data-aos="fade-right" data-aos-delay="300"
                 data-aos-duration="1500" data-aos-offset="400" lg="4">
            <img alt="" src="/images/home/bg-11.png"/>
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
    header_items: Array,
    section_one_item: Object,
    section_two_item: Object,
    section_three_items: Array,
    section_three_item: Object,
    section_four_item: Object,
    section_five_items: Array,
    section_five_item: Object,
    section_six_item: Object,
    section_six_items: Array,
    section_seven_item: Object,
    section_seven_items: Array,
    section_eleven_item: Object,
    section_nine_item: Object,
    section_ten_item: Object,
    section_ten_items: Array,
    section_twelve_item: Object,
    section_twelve_items: Array,
    latest_courses: Array,
    free_courses: Array,
    trainers: Array,
    services: Array,
    slider_items: Array,
    footer_items: Array,
    pay_courses: Array
  },
  layout: website_layout,
  data() {
    return {
      show_service_info_data: false,
      service_info: this.$inertia.form({
        title: null,
        paragraph: null,
        button_text: null,
        button_url: null,
        description_image: null
      }),
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
      subscribe_news_form: this.$inertia.form({
        email: null,
      }),
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
  methods: {
    submit_subscribe_user_news() {
      this.subscribe_news_form.post('/news/subscribe', {
        preserveScroll: true,
        onSuccess: () => {
          this.subscribe_news_form.reset()
        }
      })
    },
    show_service_info_section(item) {
      if (item.title != null && item.paragraph != null && item.description_image != null) {
        this.service_info.title = item.title
        this.service_info.paragraph = item.paragraph
        this.service_info.button_text = item.button_text
        this.service_info.button_url = item.button_url
        this.service_info.description_image = item.description_image
        this.show_service_info_data = true
      } else {
        this.show_service_info_data = false
      }

    }
  },
  created() {
    if (this.services[0].title != null && this.services[0].paragraph != null && this.services[0].description_image != null) {
      this.service_info.title = this.services[0].title
      this.service_info.paragraph = this.services[0].paragraph
      this.service_info.button_text = this.services[0].button_text
      this.service_info.button_url = this.services[0].button_url
      this.service_info.description_image = this.services[0].description_image
      this.show_service_info_data = true
    }
  }
}
</script>


<style lang="scss">
.section-home {
  .btn {
    color: #FFF !important;
    border: 1px solid #fff;
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

//

.section-membership {
  background-color: #f3f4f6;
}

.list-items-membership {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
  z-index: 1;
  background: url('/images/home/bg-10.png');
  background-repeat: no-repeat;
  background-position: center bottom;
  background-size: auto;

  &::before {
    position: absolute;
    content: '';
    width: 49%;
    height: 3px;
    background-color: #111827;
    top: 40%;
    right: 48%;
    transform: translate(50%, -50%);
    z-index: -1;
  }

  &::after {
    position: absolute;
    content: '';
    width: 26px;
    height: 26px;
    background-color: #fff;
    border-radius: 50%;
    border: 3px solid #111827;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .widget_item-membership {
    width: 270px;
    padding: 50px 65px 100px 100px;

    &.widget-1 {
      background: url('/images/home/bg-08.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: auto;
    }

    &.widget-2 {
      background: url('/images/home/bg-09.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: auto;
    }
  }

  @media (max-width: 700px) {
    flex-direction: column;
    &::before {
      width: 3px;
      height: 13%;
      top: 44%;
      right: 44%;
    }
    &::after {
      top: 45%;
      left: 56%;
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

.section-join {
  background: linear-gradient(138.9deg, #862216 0%, #b02614 110.44%);
}

.widget_item-course {
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  overflow: hidden;
  margin: 0px 5px;

  .widget_item-image {
    height: 0;
    position: relative;
    padding-top: 75%;
    overflow: hidden;

    img {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      object-fit: cover;
      transition: transform 0.5s ease-in-out;

      &:hover {
        transform: scale(1.1);
      }
    }
  }

  .widget_item-content {
    padding: 20px 16px;

    .widget_item-title {
      a {
        color: #111827;
        transition: color 0.2s ease-in-out;
        text-decoration: none;

        &:hover {
          color: var(--primary);
        }
      }
    }

    .widget_item-jop {
      border-top: 1px solid rgba(209, 213, 219, 0.5);
      color: #a21300;
      margin-top: 10px;
      padding-top: 10px;
    }
  }
}

.section-course {
  .v-tabs {
    &.theme--light:not(.v-tabs--vertical) {
      box-shadow: none !important;
    }

    .v-tabs-slider-wrapper {
      display: none;
    }

    .v-tabs-bar {
      height: auto;

      .v-tab {
        background-color: #ffe9e6;
        border-radius: 30px;
        color: var(--primary) !important;
        padding: 4px 13px;
        font-size: 18px;
        letter-spacing: unset;

        &:not(:last-of-type) {
          margin-inline-end: 20px;
        }

        &.v-tab--active {
          background-color: var(--primary);
          color: #fff !important;
        }
      }
    }
  }

  @media (max-width: 991px) {
    .v-slide-group__content {
      display: block;

      .v-slide-group__prev {
        display: none;
      }

      .v-tab {
        width: 100%;
        margin: 0 0 5px !important;
      }
    }
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

.widget_item-trainer {
  background: #ffffff;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  padding: 20px 10px;
  margin: 20px;
  min-height: 260px;

  .widget_item-image {
    img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }
  }
}

.social-media {
  a {
    background-color: #ff705e;
    font-size: 16px;
    margin: 0px 3px;
    width: 24px;
    height: 24px;
    text-decoration: none;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;

    .v-icon.v-icon {
      font-size: 16px;
    }
  }
}

.action-swiper {
  position: absolute;
  top: 50%;
  right: 50%;
  transform: translate(50%, 50%);
  z-index: 1;
  width: 100%;

  .swiper-prev-trainer,
  .swiper-next-trainer {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: var(--primary);

    .v-icon.v-icon {
      color: #fff;
    }

    &.swiper-button-disabled {
      opacity: 0.3;
    }
  }

  @media (max-width: 991px) {
    top: 95%;
    transform: none;
    right: 0;
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

.section-mailing {
  background-color: #f3f4f6;

  h2 {
    font-size: 24px;
  }
}

.form-mailing {
  .v-text-field--outlined > .v-input__control > .v-input__slot {
    min-height: 50px;
  }

  .v-btn {
    color: #fff;
    min-height: 50px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  .v-input__slot {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    background-color: #fff !important;
  }
}


@media (max-width: 991px) {
  .logo {
    img {
      max-width: 100px;
    }
  }
}

.swiper-service {
  .swiper-pagination {
    bottom: 0px;

    .swiper-pagination-bullet-active {
      background-color: var(--primary);
    }
  }
}

.swiper-service .swiper-wrapper {
  justify-content: center;
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
<style lang="scss">
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

//.bg-1 {
//  background: url('/images/home/bg-01.png');
//  background-repeat: no-repeat;
//  background-position: left bottom;
//  background-size: auto;
//}

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

//

.section-membership {
  background-color: #f3f4f6;
}

.list-items-membership {
  display: flex;
  justify-content: space-between;
  align-items: center;
  position: relative;
  z-index: 1;
  background: url('/images/home/bg-10.png');
  background-repeat: no-repeat;
  background-position: center bottom;
  background-size: auto;

  &::before {
    position: absolute;
    content: '';
    width: 49%;
    height: 3px;
    background-color: #111827;
    top: 40%;
    right: 48%;
    transform: translate(50%, -50%);
    z-index: -1;
  }

  &::after {
    position: absolute;
    content: '';
    width: 26px;
    height: 26px;
    background-color: #fff;
    border-radius: 50%;
    border: 3px solid #111827;
    top: 40%;
    left: 50%;
    transform: translate(-50%, -50%);
  }

  .widget_item-membership {
    width: 270px;
    padding: 50px 65px 100px 100px;

    &.widget-1 {
      background: url('/images/home/bg-08.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: auto;
    }

    &.widget-2 {
      background: url('/images/home/bg-09.png');
      background-repeat: no-repeat;
      background-position: center;
      background-size: auto;
    }
  }

  @media (max-width: 700px) {
    flex-direction: column;
    &::before {
      width: 3px;
      height: 13%;
      top: 44%;
      right: 44%;
    }
    &::after {
      top: 45%;
      left: 56%;
    }
  }
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

.section-join {
  background: linear-gradient(138.9deg, #862216 0%, #b02614 110.44%);
}

.widget_item-course {
  box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
  border-radius: 10px;
  overflow: hidden;
  margin: 0px 5px;

  .widget_item-image {
    height: 0;
    position: relative;
    padding-top: 75%;
    overflow: hidden;

    img {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      object-fit: cover;
      transition: transform 0.5s ease-in-out;

      &:hover {
        transform: scale(1.1);
      }
    }
  }

  .widget_item-content {
    padding: 20px 16px;

    .widget_item-title {
      a {
        color: #111827;
        transition: color 0.2s ease-in-out;
        text-decoration: none;

        &:hover {
          color: var(--primary);
        }
      }
    }

    .widget_item-jop {
      border-top: 1px solid rgba(209, 213, 219, 0.5);
      color: #a21300;
      margin-top: 10px;
      padding-top: 10px;
    }
  }
}

.section-course {
  .v-tabs {
    &.theme--light:not(.v-tabs--vertical) {
      box-shadow: none !important;
    }

    .v-tabs-slider-wrapper {
      display: none;
    }

    .v-tabs-bar {
      height: auto;

      .v-tab {
        background-color: #ffe9e6;
        border-radius: 30px;
        color: var(--primary) !important;
        padding: 4px 13px;
        font-size: 18px;

        &:not(:last-of-type) {
          margin-inline-end: 20px;
        }

        &.v-tab--active {
          background-color: var(--primary);
          color: #fff !important;
        }
      }
    }
  }

  @media (max-width: 991px) {
    .v-slide-group__content {
      display: block;

      .v-slide-group__prev {
        display: none;
      }

      .v-tab {
        width: 100%;
        margin: 0 0 5px !important;
      }
    }
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

.widget_item-trainer {
  background: #ffffff;
  box-shadow: 0px 3px 6px rgba(0, 0, 0, 0.1);
  border-radius: 5px;
  padding: 20px 10px;
  margin: 20px;
  min-height: 260px;

  .widget_item-image {
    img {
      width: 100px;
      height: 100px;
      border-radius: 50%;
    }
  }
}

.social-media {
  a {
    background-color: #ff705e;
    font-size: 16px;
    margin: 0px 3px;
    width: 24px;
    height: 24px;
    text-decoration: none;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;

    .v-icon.v-icon {
      font-size: 16px;
    }
  }
}

.action-swiper {
  position: absolute;
  top: 50%;
  right: 50%;
  transform: translate(50%, 50%);
  z-index: 1;
  width: 100%;

  .swiper-prev-trainer,
  .swiper-next-trainer {
    width: 30px;
    height: 30px;
    border-radius: 50%;
    background-color: var(--primary);

    .v-icon.v-icon {
      color: #fff;
    }

    &.swiper-button-disabled {
      opacity: 0.3;
    }
  }

  @media (max-width: 991px) {
    top: 95%;
    transform: none;
    right: 0;
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

.section-mailing {
  background-color: #f3f4f6;

  h2 {
    font-size: 24px;
  }
}

.form-mailing {
  .v-text-field--outlined > .v-input__control > .v-input__slot {
    min-height: 50px;
  }

  .v-btn {
    color: #fff;
    min-height: 50px;
    border-top-right-radius: 0;
    border-bottom-right-radius: 0;
  }

  .v-input__slot {
    border-top-left-radius: 0;
    border-bottom-left-radius: 0;
    background-color: #fff !important;
  }
}


@media (max-width: 991px) {
  .logo {
    img {
      max-width: 100px;
    }
  }
}

.swiper-service {
  .swiper-pagination {
    bottom: 0px;

    .swiper-pagination-bullet-active {
      background-color: var(--primary);
    }
  }
}

.swiper-service .swiper-wrapper {
  justify-content: center;
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

@media (min-width: 1264px) {
  .section-home .container {
    max-width: 1185px !important;
  }
}

.text_organize {
  white-space: pre-line;
  line-height: 33px;
}

.swiper-service .swiper-wrapper {
  padding-bottom: 5px;
}

</style>









