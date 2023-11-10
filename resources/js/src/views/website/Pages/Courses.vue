<template>
  <div>
    <section id="courses" class="section section-course">
      <v-container>
        <v-row>
          <v-col class="mx-auto" cols="12" lg="12">
            <h2 class="section-title font-weight-bold mb-3">الدورات التدريبية</h2>
            <div class="d-flex justify-between align-items-center">
              <div class="col">
                <v-tabs v-model="tabs" flat>
                  <!--                  <v-tab> الأكثر مبيعاً </v-tab>-->
                  <v-tab> أحدث الدورت</v-tab>
                  <v-tab> الدورات المجانية</v-tab>
                  <v-tab> الدورات المدفوعة</v-tab>

                </v-tabs>
              </div>
            </div>
          </v-col>
        </v-row>
        <v-tabs-items v-model="tabs">
          <v-tab-item>
            <v-row>
              <v-col v-for="item in latest_courses.data" :key="item.id" cols="12" lg="4">
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
            <div class="text-center">
              <v-pagination
                v-model="latest_courses_pagination.current"
                :length="latest_courses_pagination.total"
                @input="onLatestCoursePageChange"
              ></v-pagination>
            </div>
          </v-tab-item>
          <v-tab-item>
            <v-row>
              <v-col v-for="item in free_courses.data" :key="item.id" cols="12" lg="4">
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
            <div class="text-center">
              <v-pagination
                v-model="free_courses_pagination.current"
                :length="free_courses_pagination.total"
                @input="onFreeCoursesPageChange"
              ></v-pagination>
            </div>
          </v-tab-item>
          <v-tab-item>
            <v-row>
              <v-col v-for="item in pay_courses.data" :key="item.id" cols="12" lg="4">
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
            <div class="text-center">
              <v-pagination
                v-model="pay_courses_pagination.current"
                :length="pay_courses_pagination.total"
                @input="onPayCoursesPageChange"
              ></v-pagination>
            </div>
          </v-tab-item>

        </v-tabs-items>
      </v-container>
    </section>
  </div>
</template>

<script>
import 'swiper/css/swiper.css'

import website_layout from "../../../layouts/website_layout/layout";

export default {
  layout: website_layout,
  created() {
    this.axios.get('/get_all_courses')
      .then(res => {
        this.latest_courses = res.data.latest_courses
        this.free_courses = res.data.free_courses
        this.pay_courses = res.data.pay_courses
        this.latest_courses_pagination.current = this.latest_courses.current_page;
        this.latest_courses_pagination.total = this.latest_courses.last_page;
        this.free_courses_pagination.current = this.free_courses.current_page;
        this.free_courses_pagination.total = this.free_courses.last_page;
        this.pay_courses_pagination.current = this.pay_courses.current_page;
        this.pay_courses_pagination.total = this.pay_courses.last_page;
      })
  },

  data() {
    return {
      latest_courses: [],
      free_courses: [],
      pay_courses: [],
      tabs: null,
      latest_courses_pagination: {
        current: 1,
        total: 0,
      },
      free_courses_pagination: {
        current: 1,
        total: 0,
      },
      pay_courses_pagination: {
        current: 1,
        total: 0,
      },
    }
  },
  methods: {
    onLatestCoursePageChange() {
      this.axios.get('/get_all_courses' + '?page=' + this.latest_courses_pagination.current + "&type=latest_courses")
        .then(res => {
          this.latest_courses = res.data.latest_courses
          this.latest_courses_pagination.current = this.latest_courses.current_page;
        })
    },
    onFreeCoursesPageChange() {
      this.axios.get('/get_all_courses' + '?page=' + this.free_courses_pagination.current + "&type=free_courses")
        .then(res => {
          this.free_courses = res.data.free_courses
          this.free_courses_pagination.current = this.free_courses.current_page;
        })
    },
    onPayCoursesPageChange() {
      this.axios.get('/get_all_courses' + '?page=' + this.free_courses_pagination.current + "&type=pay_courses")
        .then(res => {
          this.pay_courses = res.data.pay_courses
          this.pay_courses_pagination.current = this.pay_courses.current_page;
        })
    },

  },
}
</script>


<style lang="scss">
.boxed-container {
  max-width: 100% !important;
}

.v-application .pa-6 {
  padding: 0px !important;
}

//
* {
  box-sizing: border-box;
}

@import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap');

:root {
  --primary: #cb1800;
  --secondar: #000000;
}

body,
.v-application.theme--light {
  background-color: #fff;
  font-size: 14px;
  color: #111827 !important;
  font-family: 'Tajawal', sans-serif;
}

body .theme--light.v-application {
  color: #111827 !important;
}

.text-primary {
  color: var(--primary);
}

img {
  max-width: 100%;
}

h1,
h2,
h3,
h4,
h5,
h6 {
  font-weight: 400;
}

h6 {
  font-size: 14px;
}

h5 {
  font-size: 16px;
}

h4 {
  font-size: 18px;
}

h3 {
  font-size: 20px;
}

h2 {
  font-size: 28px;
}

.rounded-5 {
  border-radius: 5px;
}

@media (min-width: 1264px) {
  .container {
    max-width: 1300px !important;
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

header {
  &.main-header.v-toolbar {
    max-height: 80px;
    height: 80px !important;
    position: relative;
    width: 100%;
    top: 0;
    right: 0;
    background-color: transparent !important;
    box-shadow: none !important;
    z-index: 3;

    .v-toolbar__content {
      height: 80px !important;
    }

    .v-toolbar__items {
      align-items: center;
      flex: 0 0 auto;

      .v-btn {
        box-shadow: none;
        color: #000000;
        height: auto !important;
        padding: 9px 6px;
        border-radius: 30px;
        box-shadow: none !important;

        &:not(.btn-primary-2) {
          background-color: transparent !important;
        }

        &:hover {
          color: #a21300;
          background-color: transparent;
        }
      }
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
      background: url(/images/home/vector-home.png);
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
  background: url(/images/home/bg-01.png);
  background-repeat: no-repeat;
  background-position: left bottom;
  background-size: auto;
}

.widget_item-serv {
  background-color: #ffe9e6;
  border-radius: 16px;
  padding: 17px 5px;
  height: 100%;

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
    background: url(/images/home/bg-02.png);
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
    background: url(/images/home/bg-03.png);
    background-repeat: no-repeat;
    background-position: left bottom;
    background-size: auto;
    height: 195px;
    width: 162px;
  }
}

.section-info {
  background: url(/images/home/bg-07.png);
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
      background: url(/images/home/bg-04.png);
      background-repeat: no-repeat;
      background-position: center;
      background-size: auto;
    }
  }

  &.widget-2 {
    .widget_item-icon {
      background: url(/images/home/bg-05.png);
      background-repeat: no-repeat;
      background-position: center;
      background-size: auto;
    }
  }

  &.widget-3 {
    .widget_item-icon {
      background: url(/images/home/bg-06.png);
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
  background: url(/images/home/bg-10.png);
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
      background: url(/images/home/bg-08.png);
      background-repeat: no-repeat;
      background-position: center;
      background-size: auto;
    }

    &.widget-2 {
      background: url(/images/home/bg-09.png);
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
  background: linear-gradient(138.9deg, #862216 0%, #b02614 110.44%);
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

.main-footer {
  background-color: #510900;
  padding: 40px 0;

  .menu-mobile {
    list-style: none;
    padding: 0;

    li {
      a {
        display: inline-block;
        color: #fff;
        font-size: 18px;
        margin-bottom: 15px;
        text-decoration: none;

        &:hover {
          text-decoration: underline;
        }
      }
    }
  }
}

.social-app {
  a {
    background-color: #fff;
    font-size: 16px;
    margin: 0px 3px;
    width: 24px;
    height: 24px;
    text-decoration: none;
    border-radius: 50%;
    display: inline-flex;
    align-items: center;
    justify-content: center;
    margin: 0px 4px;

    .v-icon.v-icon {
      font-size: 16px;
      color: #510900;
    }
  }
}

.form-footer {
  .v-input__slot {
    background-color: #fff !important;
    margin-bottom: 0 !important;
  }

  .v-text-field--outlined > .v-input__control > .v-input__slot {
    min-height: 45px;
  }
}

.v-navigation-drawer {
  .v-navigation-drawer__content {
    .v-toolbar__items {
      flex-direction: column;
      padding: 20px 0;
      height: auto;

      a:not(.btn-primary-2) {
        display: block;
        padding: 13px 10px !important;
        background-color: #fff !important;
        color: #000;
        border-bottom: 1px solid #eee;
        box-shadow: none !important;
        height: auto !important;
        justify-content: flex-start;
      }

      .v-btn:not(.v-btn--round).v-size--default {
        height: auto !important;
        justify-content: flex-start;
        padding: 12px 26px !important;
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
</style>









