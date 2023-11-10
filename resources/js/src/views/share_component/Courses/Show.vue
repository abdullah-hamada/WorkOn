<template>
  <div>
    <section
      :style="{ 'background': 'url(/get_file/course_logos/' + course.image +')' + 'center no-repeat' }"
      class="section"
      style="
           background-repeat: no-repeat;
          background-size: cover;
        "
    >
      <v-container class="mt-12">
        <v-row dense>
          <v-col class="mx-auto" cols="12" lg="9">
            <div class="bg-white pa-12 text-center rounded-10">
              <h2 class="section-title mb-11 font-weight-bold">{{ course.title }}</h2>
              <h4>
                {{ course.brief_explanation }}
              </h4>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section v-if="course.promotional_video_url" class="section">
      <v-container>
        <v-row class="mb-2">
          <v-col cols="12">
            <h2 class="section-title font-weight-bold text-center">
              {{ course.promotional_video_title }}
            </h2>
          </v-col>
        </v-row>
        <v-row class="mb-2">
          <v-col class="mx-auto text-center" cols="12" lg="9">

            <div class="image-video position-relative">
              <img
                :src="`/get_file/course_promotional_video_images/${course.promotional_video_image}`"
                alt="" class="w-100 rounded-10"/>
              <a :href="course.promotional_video_url" class="btn-play-video" data-fancybox>
                <v-icon>mdi-play</v-icon>
              </a>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section
      class="section"
      style="
          background: url(/images//home/bg-13.png) center no-repeat;
          background-repeat: no-repeat;
          background-size: cover;
        "
    >
      <div class="section__overlay"></div>
      <v-container>
        <v-row class="mb-2 ">
          <v-col cols="12" lg="7">
            <div
              class="section-join-left text-center bg-white pa-10 mb-5 d-flex justify-center rounded-5">
              <div v-for="time in times">
                <div class="d-flex flex-column countDown">
                  <div class="countDown__time">
                    {{ time.time }}
                  </div>
                  <div class="countDown__title">
                    {{ time.text }}
                  </div>
                </div>
              </div>
            </div>

            <h2 class="section-title font-weight-bold white--text">
              <span v-if="course.price_type == 1">
              هذا الخصم لفترة محدودة وبعد أيام سيعود السعر الأصلي لذا استثمر هذه الفرصة الآن!
                </span>
              <span v-else>
                  فرصتك  مازالت متاحة  للاشتراك بالكورس الآن
                 </span>
            </h2>
          </v-col>
          <v-col cols="12" lg="5">
            <div class="bg-white pa-10 text-center rounded-5">
              <h2 class="section-title font-weight-bold">عرض خاص ولفترة محدودة</h2>
              <h2 v-if="course.price_type == 1" class="font-weight-bold red--text mb-8">
                {{ course.price_after_discount }} $ فقط بدلاً من
                {{ course.price_before_discount }}$</h2>
              <h2 v-else class="font-weight-bold red--text mb-8"> مجاني</h2>
              <a v-if="!course.is_finish_apply" :href="`/tap-payment/${course.id}`"
                 class="btn btn-primary">
                <span v-if="course.price_type == 1">
                   اشترك الآن واستفد من الخصم
                </span>
                <span v-else>
                   اشترك الآن
                </span>
              </a>
              <a v-else style="font-size:16px;color:red">
                تم انتهاء وقت الاشتراك
              </a>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <div v-if="course.articles && course.articles.length> 0" class="list-section-about">
      <section v-for="item in course.articles" :key="item.id" class="section">
        <v-container>
          <v-row>
            <v-col cols="12" lg="6">
              <img :src="`/get_file/course_articles/${item.image}`" alt="" class="rounded-10"/>
            </v-col>
            <v-col cols="12" lg="6">
              <h2 class="section-title font-weight-bold text-center mb-4">{{ item.title }}</h2>
              <h5 class="text-center">
                {{ item.paragraph }}
              </h5>
            </v-col>
          </v-row>
        </v-container>
      </section>
    </div>
    <section
      class="section"
      style="
          background: url(/images//home/bg-14.jpg) center no-repeat;
          background-repeat: no-repeat;
          background-size: cover;
        "
    >
      <div class="section__overlay"></div>
      <v-container>
        <v-row class="mb-2">
          <v-col class="mx-auto text-center" cols="12" lg="7">
            <h2 class="section-title font-weight-bold white--text mb-5">
              <div v-if="!course.is_finish_apply">
                <span v-if="course.price_type == 1">
              فرصتك  مازالت متاحة أمامك لتستفيد من الخصم عند اشتراكك بالكورس الآن
                </span>
                <span v-else>
              فرصتك  مازالت متاحة  للاشتراك بالكورس الآن
                </span>
                <a :href="`/tap-payment/${course.id}`" class="btn btn-white mt-3">
                  <span v-if="course.price_type == 1">
                       اشترك الآن واستفد من الخصم
                    </span>
                  <span v-else>
                     اشترك الآن
                  </span>
                </a>
              </div>
              <div v-else>
               <span>
                 تم انتهاء وقت الاشتراك
               </span>
              </div>
            </h2>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section
      v-if="course.reasons_for_participating_in_course && course.reasons_for_participating_in_course.length> 0"
      class="section py-6">
      <v-container>
        <v-row class="text-center mb-4">
          <v-col cols="12" lg="12">
            <h2 class="section-title font-weight-bold text-center mb-3">لماذا عليك أن تشترك في
              التدريب الآن؟</h2>
          </v-col>
        </v-row>
        <v-row class="justify-center">
          <v-col v-for="item in course.reasons_for_participating_in_course" :key="item.id" cols="12"
                 lg="3"
                 md="6">
            <div class="widget_itme-serv2 text-center">
              <div class="widget_itme-icon mb-4">
                <img :src="`/get_file/course_participating_reason_images/${item.image}`" alt=""/>
              </div>
              <h3 class="widget_itme-title font-weight-bold">{{ item.title }}</h3>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section v-if="course.course_sections && course.course_sections.length> 0" class="section py-6">
      <v-container>
        <v-row class="text-center mb-4">
          <v-col cols="12" lg="12">
            <h2 class="section-title font-weight-bold text-center">يتكون التدريب من
              {{ course.course_sections.length }} وحدات وأقسام ..</h2>
          </v-col>
        </v-row>
        <v-row class="text-center mb-4">
          <v-col cols="12" lg="12">
            <v-expansion-panels class="expansion-panels">
              <v-expansion-panel v-for="item in course.course_sections" :key="item.id">
                <v-expansion-panel-header>
                  <div class="d-flex align-items-center">
                    <h3 class="expansion-panel-title">{{ item.title }}</h3>
                  </div>
                </v-expansion-panel-header>
                <v-expansion-panel-content>
                  <div
                    v-if="course.price_type==2 && !$page.props.auth.user || (course.price_type==1 && !$page.props.auth.user) || ( $page.props.auth.user && !user_auth_subscribe_course)  ">
                    <h6 class="expansion-panel-desc" style="filter: blur(3px);">
                      ***********************************
                    </h6>
                    <Link v-if="course.price_type==2 && !$page.props.auth.user"
                          class="red--text text-decoration-none"
                          href="/login" style="font-size: 20px">
                      سجل دخولك لمشاهدة التفاصيل
                    </Link>
                    <Link v-else-if="course.price_type==1 && !$page.props.auth.user"
                          class="red--text text-decoration-none"
                          href="/login" style="font-size: 20px">
                      سجل دخولك لمشاهدة التفاصيل
                    </Link>
                    <a
                      v-if="$page.props.auth.user && !user_auth_subscribe_course"
                      :href="`/tap-payment/${course.id}`" class="red--text text-decoration-none"
                      style="font-size: 20px">
                      اشترك بالدورة لمشاهدة التفاصيل
                    </a>
                  </div>
                  <div v-else>
                    <h6 v-if="checkIfURL(item.paragraph)" class="expansion-panel-desc">
                      <a :href="item.paragraph" class="cursor-pointer" target="_blank">
                        {{ item.paragraph }} </a>
                    </h6>
                    <h6 v-else class="expansion-panel-desc">
                      {{ item.paragraph }}
                    </h6>
                  </div>
                </v-expansion-panel-content>
              </v-expansion-panel>
            </v-expansion-panels>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section
      class="section"
      style="
          background: url(/images//home/bg-14.jpg) center no-repeat;
          background-repeat: no-repeat;
          background-size: cover;
        "
    >
      <div class="section__overlay"></div>
      <v-container>
        <v-row class="mb-2">
          <v-col class="mx-auto text-center" cols="12" lg="7">
            <h2 class="section-title font-weight-bold white--text mb-5">
              <div>
                <span>
            رابط المحاضرات الخاص بهذه الدورة
                </span>
              </div>
            </h2>
            <div
              v-if=" !$page.props.auth.user
                || ($page.props.auth.user && !user_auth_subscribe_course)  ">
              <h6 class="expansion-panel-desc" style="filter: blur(3px);">
                ***********************************
              </h6>
              <Link v-if="!$page.props.auth.user" class="white--text text-decoration-none"
                    href="/login" style="font-size: 20px">
                سجل دخولك لمشاهدة التفاصيل
              </Link>
              <a
                v-if="$page.props.auth.user && !user_auth_subscribe_course"
                :href="`/tap-payment/${course.id}`" class="white--text text-decoration-none"
                style="font-size: 20px">
                اشترك بالدورة لمشاهدة التفاصيل
              </a>
            </div>
            <div v-else>
              <h6 class="expansion-panel-desc">
                <a :href="course.lectures_link" class="btn btn-white mt-3" target="_blank"><span>
                   رابط المحاضرات
                  </span></a>
              </h6>
            </div>

          </v-col>
        </v-row>
      </v-container>
    </section>
    <section v-if="course.users_benefit_course && course.users_benefit_course.length> 0"
             class="section py-6">
      <v-container>
        <v-row class="text-center mb-4">
          <v-col class="mx-auto" cols="12" lg="12">
            <h2 class="section-title font-weight-bold text-center mb-3">من يستطيع الاستفادة من هذا
              التدريب؟</h2>
          </v-col>
        </v-row>
        <v-row class="justify-center">
          <v-col v-for="item in course.users_benefit_course" :key="item.id" cols="12" lg="4" md="6">
            <div class="widget_itme-benefit text-center mb-4">
              <div class="widget_itme-image">
                <img :src="`/get_file/course_benefit_type_images/${item.image}`" alt=""/>
              </div>
              <div class="widget_itme-overlay">
                <h3 class="widget_itme-title font-weight-bold white--text">{{ item.title }}</h3>
              </div>
            </div>
          </v-col>
        </v-row>
        <var>
          <v-col cols="12">
            <div class="text-center">
              <Link v-if="!course.is_finish_apply" :href="`/tap-payment/${course.id}`"
                    class="btn btn-primary" href="">اشترك الآن ولا تفوت العرض
              </Link>
              <a v-else style="font-size:16px;color:red">
                تم انتهاء وقت الاشتراك
              </a>
            </div>
          </v-col>
        </var>
      </v-container>
    </section>
    <section
      v-if="course.course_opinion_participants && course.course_opinion_participants.length> 0"
      class="section py-10">
      <v-container>
        <v-row class="mb-4">
          <v-col cols="12" lg="12">
            <h2 class="section-title font-weight-bold">رأي المشاركين في الدورات التدريبية:</h2>
          </v-col>
        </v-row>
        <v-row class="mb-2 justify-center">
          <v-col v-for="item in course.course_opinion_participants" :key="item.id" cols="12" lg="6">
            <div class="widget_item-video position-relative mb-4">
              <a :href="item.video_url" class="btn-play-video" data-fancybox="gallery">
                <v-icon>mdi-play</v-icon>
              </a>
              <div class="widget_item-image">
                <img :src="`/get_file/course_opinion_participants_video_images/${item.image}`"
                     alt=""/>
              </div>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section
      class="section section-man py-10"
      style="
          background: url(/images//home/bg-14.jpg) center no-repeat;
          background-repeat: no-repeat;
          background-size: cover;
        "

    >
      <div class="section__overlay"></div>
      <v-container>
        <v-row class="mb-2">
          <v-col cols="12" lg="6">
            <h2 class="section-title font-weight-bold white--text mb-2">مقدم الكورس:
              {{ course.trainer.name }}</h2>
            <h3 class="font-weight-bold white--text">
              {{ course.trainer.job_title }}
            </h3>
            <v-divider class="my-7" light/>
            <ul class="px-5 px-lg-7 white--text mb-3  ">

              <li class="white--text mb-3 text-decoration-none"
                  style="white-space:pre-line;line-height:33px;list-style:none"><strong>
                {{ course.trainer.description }} </strong></li>

              <!--                <li class="white&#45;&#45;text mb-3 text-decoration-none"><strong>شريك مؤسس ومدير العمليات في شركة ديتور </strong></li>-->
              <!--                <li class="white&#45;&#45;text mb-3"><strong>مدير التسويق في شركات سعودية ( منتجات رقمية) </strong></li>-->
              <!--                <li class="white&#45;&#45;text mb-3"><strong> مستشار تسويق لمؤسسات غير ربحية </strong></li>-->
              <!--                <li class="white&#45;&#45;text mb-3"><strong> مستشار تطوير مشاريع ريادية مع حاضنات أعمال </strong></li>-->
              <!--                <li class="white&#45;&#45;text mb-3">-->
              <!--                  <strong> مؤسس البرنامج التدريبي " قائد تسويقي فعّال" المخصص لمدراء التسويق </strong>-->
              <!--                </li>-->
              <!--                <li class="white&#45;&#45;text mb-3"><strong> مدرب معتمد في مؤسسات دولية </strong></li>-->
            </ul>
          </v-col>
          <v-col cols="12" lg="6">
            <div class="image">
              <img :src="`/get_file/trainer_images/${course.trainer.image}`" alt=""/>
            </div>
          </v-col>
        </v-row>
      </v-container>
    </section>
    <section v-if="course.course_slider_images && course.course_slider_images.length> 0"
             class="section section-trainer">
      <v-container>
        <div class="position-relative">
          <v-row class="position-relative">
            <v-col class="position-relative mx-auto" cols="10">
              <swiper :options="swiperOptions3">
                <swiper-slide v-for="item in course.course_slider_images" :key="item.id">
                  <div class="widget_item-imgProject text-center">
                    <div class="widget_item-image">
                      <img :src="`/get_file/course_slider_images/${item.image}`" alt=""/>
                    </div>
                    <div class="widget_item-content">
                      <h4 class="font-weight-bold widget_item-title white--text">
                        {{ item.title }}
                      </h4>
                    </div>
                  </div>
                </swiper-slide>
              </swiper>
            </v-col>
          </v-row>
          <div class="action-swiper d-flex align-center justify-space-between w-100">
            <div slot="button-prev"
                 class="swiper-prev-imgProject d-flex align-center justify-center">
              <v-icon>mdi-arrow-right</v-icon>
            </div>
            <div slot="button-next"
                 class="swiper-next-imgProject d-flex align-center justify-center">
              <v-icon>mdi-arrow-left</v-icon>
            </div>
          </div>
        </div>
      </v-container>
    </section>
    <section v-if="course.course_questions && course.course_questions.length> 0"
             class="section py-6">
      <v-container>
        <v-row class="text-center mb-4">
          <v-col cols="12" lg="12">
            <!--              <h2 class="section-title font-weight-bold text-center">يتكون التدريب من 5 وحدات وأقسام ..</h2>-->
          </v-col>
        </v-row>
        <v-row class="text-center mb-4">
          <v-col cols="12" lg="12">
            <v-expansion-panels class="expansion-panels">
              <v-row>
                <v-col v-for="item in course.course_questions" :key="item.id" cols="12" md="6">
                  <v-expansion-panel>
                    <v-expansion-panel-header>
                      <div class="d-flex align-items-center">
                        <h3 class="expansion-panel-title">{{ item.question }}</h3>
                      </div>
                    </v-expansion-panel-header>
                    <v-expansion-panel-content>
                      <h6 class="expansion-panel-desc">
                        {{ item.answer }}
                      </h6>
                    </v-expansion-panel-content>
                  </v-expansion-panel>
                </v-col>

              </v-row>
            </v-expansion-panels>
          </v-col>
        </v-row>
        <v-row class="text-center mb-4">
          <v-col cols="12" lg="12">
            <h2 class="section-title font-weight-bold text-center">هل تخطر هذه الأسئلة في بالك الآن
              ؟</h2>
          </v-col>
        </v-row>
      </v-container>
    </section>
  </div>
</template>
<script>
import {directive, Swiper, SwiperSlide} from 'vue-awesome-swiper'
import '@fancyapps/ui/dist/fancybox.css'

import 'swiper/css/swiper.css'
import logo_white from '@/assets/images/home/logo-white.png'
import logo from '@/assets/images/home/logo.png'
import website_layout from "../../../layouts/website_layout/layout";

export default {
  layout: website_layout,
  props: {
    course: Object,
    user_auth_subscribe_course: Boolean
  },
  data() {
    return {
      startTime: this.course.date_from_in_time_zone,
      endTime: this.course.date_from_in_time_zone,
      times: [
        {id: 0, text: "ايام", time: 1},
        {id: 1, text: "ساعات", time: 1},
        {id: 2, text: "دقائق", time: 1},
        {id: 3, text: "ثواني", time: 1},
      ],
      progress: 100,
      timeinterval: undefined,
      videoOptions: {
        autoplay: true,
        controls: true,
        preload: true,
        fluid: true,
        sources: [
          {
            src:
              'https://www.tutorialspoint.com/videos/myVideo.mp4',
            type: 'video/mp4'
          }
        ]
      },
      sidebar: false,
      logo_white: logo_white,
      logo: logo,
      menuItems: [
        {title: 'حاضنة العمل الحر', path: '/'},
        {title: 'الخدمات', path: '/'},
        {title: 'توجيه وارشاد', path: '/'},
        {title: 'العضويات', path: '/'},
        {title: 'الدورات التدريبية', path: '/'},
        {title: 'مدربينا المحترفين', path: '/'},
        {title: 'أرقامنا', path: '/'},
        {title: 'قالوا عنا', path: '/'},
      ],
      menuItems2: [
        {title: 'حساب جديد', path: '/', class: 'btn btn-primary-2 ml-lg-3 mb-3 mb-lg-0'},
        {title: 'تسجيل الدخول', path: '/', class: 'btn btn-outline-primary'},
      ],
      swiperOptions3: {
        slidesPerView: 1,
        speed: 1500,
        autoplay: {
          delay: 2500,
          disableOnInteraction: false,
        },
        spaceBetween: 50,
        navigation: {
          nextEl: '.swiper-next-imgProject',
          prevEl: '.swiper-prev-imgProject',
        },
      },
    }
  },
  components: {Swiper, SwiperSlide},
  methods: {
    checkIfURL(text) {
      const urlPattern = /^(ftp|http|https):\/\/[^ "]+$/;
      return urlPattern.test(text);
    },
    updateTimer() {
      if (
        this.times[3].time > 0 ||
        this.times[2].time > 0 ||
        this.times[1].time > 0 ||
        this.times[0].time > 0
      ) {
        this.getTimeRemaining();
        this.updateProgressBar();
      } else {
        clearTimeout(this.timeinterval);
        // this.times[3].time = this.times[2].time = this.times[1].time = this.times[0].time = 0;
        this.progress = 0;
      }
    },
    getTimeRemaining() {
      let t = Date.parse(new Date(this.endTime)) - Date.parse(new Date());
      if (t >= 0) {
        this.times[3].time = Math.floor((t / 1000) % 60); //seconds
        this.times[2].time = Math.floor((t / 1000 / 60) % 60); //minutes
        this.times[1].time = Math.floor((t / (1000 * 60 * 60)) % 24); //hours
        this.times[0].time = Math.floor(t / (1000 * 60 * 60 * 24)); //days
      } else {
        this.times[3].time =
          this.times[2].time =
            this.times[1].time =
              this.times[0].time =
                0;
        this.progress = 0;
      }
    },
    updateProgressBar() {
      let startTime = Date.parse(new Date(this.startTime));
      let currentTime = Date.parse(new Date());
      let endTime = Date.parse(new Date(this.endTime));
      let interval = parseFloat(
        ((currentTime - startTime) / (endTime - startTime)) * 100
      ).toFixed(2);
      this.progress = 100 - interval;
    },

  },
  directives: {
    swiper: directive,
  },
  created() {
    this.updateTimer();
    this.timeinterval = setInterval(this.updateTimer, 1000);
  },
}
</script>
<style lang="scss">
.countDown {
  margin: 0px 10px;
}

.countDown__time {
  background-color: rgba(0, 0, 0, 0.07);
  padding: 10px 40px;
  color: #161E2A;
  font-weight: bold;
  margin-bottom: 10px;
  font-size: 60px;
}

.countDown__title {
  font-size: 20px;
  color: #595959;
}


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


.section-title {
  @media (min-width: 992px) {
    font-size: 36px;
  }
}

//
.section {
  position: relative;
  z-index: 1;
}

.section__overlay {
  position: absolute;
  width: 100%;
  height: 100%;
  left: 0;
  top: 0;
  background-color: #cb1800c7;
  z-index: -1;
}

.rounded-10 {
  border-radius: 10px;
}

.bg-gray {
  background-color: #ecf0f1;
}

.bg-white {
  background-color: #fff;
}

.widget_itme-serv2 {
  .widget_itme-icon {
    img {
      width: 160px;
    }
  }
}

.section-man {
  ul {
    li {
      font-size: 16px;
    }
  }

  .theme--light.v-divider {
    border-color: rgb(255 255 255 / 79%);
  }

  .image {
    img {
      border-radius: 15px;
    }
  }
}

.expansion-panels.v-expansion-panels {
  .v-expansion-panel {
    margin: 10px 0 !important;
    border-radius: 10px;
    overflow: hidden;

    &::after {
      border: none !important;
    }

    .expansion-panel-title {
      font-size: 20px;
      color: var(--primary);
      font-weight: 400;
      transition: color 0.2s ease-in-out;
      margin: 12px 0;
    }

    .expansion-panel-desc {
      font-size: 15px;
    }

    &:not(.v-expansion-panel--active) {
      background-color: #e8eff1;
      transition: background-color 0.2s ease-in-out;

      &:hover {
        background-color: var(--primary);

        .expansion-panel-title {
          color: #fff;
        }

        .v-expansion-panel-header__icon {
          .v-icon {
            color: #fff;
          }
        }
      }
    }

    &.v-expansion-panel--active {
      box-shadow: 0px 4px 4px rgba(0, 0, 0, 0.07);

      .expansion-panel-title {
        font-weight: 700;
      }
    }
  }
}

.widget_itme-benefit {
  position: relative;
  overflow: hidden;
  border-radius: 10px;

  .widget_itme-image {
    position: relative;
    height: 0;
    padding-top: 66%;

    img {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
    }
  }

  .widget_itme-title {
    font-size: 26px;
  }

  .widget_itme-overlay {
    z-index: 1;
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    background-color: #a21300a3;
    opacity: 0;
    visibility: hidden;
    transition: all 0.2s ease-in-out;
  }

  &:hover {
    .widget_itme-overlay {
      opacity: 1;
      visibility: visible;
    }
  }
}

.widget_item-imgProject {
  position: relative;
  overflow: hidden;
  border-radius: 14px;

  .widget_item-image {
    position: relative;
    height: 0;
    padding-top: 61%;

    img {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      object-fit: cover;
    }
  }

  .widget_item-content {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    background-color: rgba(0, 0, 0, 0.33);
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 20px 60px;

    .widget_item-title {
      font-size: 40px;
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

.image-video {
  img {
    max-height: 550px;
    object-fit: cover;
  }
}

.btn-play-video {
  cursor: pointer;
  height: 80px;
  box-shadow: none;
  width: 125px;
  background-color: var(--primary);
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  z-index: 1;
  display: flex;
  align-items: center;
  justify-content: center;
  text-decoration: none;

  .v-icon.v-icon {
    color: #fff;
    font-size: 54px;
  }
}

.widget_item-video {
  .widget_item-image {
    position: relative;
    height: 0;
    padding-top: 66%;

    img {
      position: absolute;
      width: 100%;
      height: 100%;
      top: 0;
      left: 0;
      object-fit: cover;
    }
  }
}

//

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

.video {
  position: relative;
  height: 0;
  padding-top: 66%;
  border-radius: 10px;
  overflow: hidden;

  video {
    position: absolute;
    width: 100%;
    height: 100%;
    top: 0;
    left: 0;
    object-fit: cover;
  }
}

.list-section-about {
  > .section {
    &:nth-child(even) {
      background-color: #ecf0f1;

      .row {
        flex-direction: row-reverse;
      }
    }
  }
}

@media(max-width: 991px) {
  .countDown__time {
    font-size: 30px;
    padding: 5px 20px;
  }
  .countDown__title {
    font-size: 13px;
  }
  .widget_itme-benefit .widget_itme-overlay {
    opacity: 1;
    visibility: visible;
  }
}
</style>


<style lang="scss" scoped>
html.dark {
  body, .v-application.theme--light {
    background-color: #56565E;
    color: #FFF !important;

    header.main-header.v-toolbar {
      background-color: #3A3A3A !important;

      .v-toolbar__items .v-btn {
        color: #FFF;
      }
    }

    .section-guidance,
    .section-membership,
    .widget_item-trainer,
    .widget_item-course,
    .widget_item-testimonial,
    .section-mailing, .bg-white,
    .expansion-panels.v-expansion-panels .v-expansion-panel:not(.v-expansion-panel--active),
    .theme--light.v-expansion-panels .v-expansion-panel,
    .list-section-about > .section:nth-child(2n) {
      background-color: #424248;
    }

    .theme--light.v-tabs > .v-tabs-bar {
      background-color: #56565e;
    }

    .theme--light.v-tabs-items {
      background-color: transparent;
    }

    .countDown__time {
      background-color: #484848;
    }
  }

  .bg-white {
    background-color: #424248;
  }

  .countDown__time,
  .theme--light.v-expansion-panels .v-expansion-panel-content__wrap,
  .countDown__title,
  .widget_item-info .widget_item-title,
  .widget_item-course .widget_item-content .widget_item-title a,
  .theme--light.v-expansion-panels .v-expansion-panel-header .v-expansion-panel-header__icon .v-icon,
  .expansion-panels.v-expansion-panels .v-expansion-panel .expansion-panel-title {
    color: #ffffff;
  }
}

.switch {
  position: relative;
  display: inline-block;
  width: 40px;
  height: 22px;
}

/* Hide default HTML checkbox */
.switch input {
  opacity: 0;
  width: 0;
  height: 0;
}

/* The slider */
.slider {
  position: absolute;
  cursor: pointer;
  top: 0;
  left: 0;
  right: 0;
  bottom: 0;
  background-color: #fff;
  -webkit-transition: 0.4s;
  transition: 0.4s;
}

.slider:before {
  position: absolute;
  content: "";
  height: 18px;
  width: 18px;
  left: 0px;
  bottom: 4px;
  top: 0;
  bottom: 0;
  margin: auto 0;
  -webkit-transition: 0.4s;
  transition: 0.4s;
  box-shadow: 0 0px 15px #2020203d;
  background: white url('/images/home/moon.svg');
  background-repeat: no-repeat;
  background-position: center;
}

input:checked + .slider {
  background-color: #f1f1f1;
}

input:checked + .slider:before {
  -webkit-transform: translateX(24px);
  -ms-transform: translateX(24px);
  transform: translateX(24px);
  background: white url('/images/home/sun.svg');
  background-repeat: no-repeat;
  background-position: center;
}

/* Rounded sliders */
.slider.round {
  border-radius: 34px;
}

.main-header {
  height: 55px;
  background-color: var(--body-color);
  border-bottom: 1px solid var(--border-color-1);
  display: flex;
  align-items: center;
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  z-index: 3;
  transition: background-color 0.5s ease-in-out;
}

.slider.round:before {
  border-radius: 50%;
}

</style>

