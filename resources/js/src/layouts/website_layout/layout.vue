<template>
  <v-app app>
    <v-navigation-drawer v-model="sidebar" app>
      <v-toolbar-items>
        <a v-for="item in this.$page.props.header_items"
           :key="item.title"
           :href="item.url"
           class="v-btn v-btn--is-elevated v-btn--has-bg v-btn--router theme--light v-size--default"
        >
          {{ item.title }}
        </a>


      </v-toolbar-items>
      <v-toolbar-items class="pa-2">
        <v-btn v-if="!this.$page.props.auth.user"
               class="btn-1 btn btn-primary-2 ml-lg-3 mb-3 mb-lg-0'"
               flat to="/register">
          حساب جديد
        </v-btn>
        <v-btn v-if="!this.$page.props.auth.user" class="btn-2 btn btn-outline-primary"
               flat to="/login">
          تسجيل الدخول
        </v-btn>

        <a v-if="this.$page.props.auth.user && this.$page.props.roles[0]['name'] == 'admin'"
           class="btn-1 btn btn-primary-2 ml-lg-3   mb-lg-0'"
           href="/admin/dashboard"
           target="_blank">
          لوحة التحكم
        </a>
        <a
          v-if="this.$page.props.auth.user && (this.$page.props.roles[0]['name'] == 'user' || this.$page.props.roles[0]['name'] == 'partner')"
          class="btn-1 btn btn-primary-2 ml-lg-3   mb-lg-0'"
          href="/dashboard"
          target="_blank">
          لوحة التحكم
        </a>


      </v-toolbar-items>

    </v-navigation-drawer>
    <v-toolbar app class="main-header">
      <v-container class="d-flex align-center">
        <v-toolbar-title>
          <Link class="d-flex pt-1 logo" href="/" tag="span">
            <img v-if="this.light_theme" :src="`/images/home/logo.png`" alt="" width="250px"/>
            <img v-else :src="`/images/home/dark_logo.png`" alt="" width="250px"/>
          </Link>
        </v-toolbar-title>
        <v-spacer></v-spacer>
        <v-toolbar-items class="d-none d-lg-block menu">
          <Link v-for="item in this.$page.props.header_items"
             :key="item.title"
             :href="item.url"
             class="v-btn v-btn--is-elevated v-btn--has-bg v-btn--router theme--light v-size--default"
          >
            {{ item.title }}
          </Link>
        </v-toolbar-items>


        <v-spacer></v-spacer>
        <v-toolbar-items class="d-none d-lg-block">
          <!--          <v-btn flat v-for="item in menuItems2" :key="item.title" :to="item.path" :class="item.class">-->
          <!--            {{ item.title }}-->
          <!--          </v-btn>-->

        </v-toolbar-items>
        <v-toolbar-items class="d-none d-md-block">
          <a v-if="!this.$page.props.auth.user" class="btn-1 btn btn-primary-2 ml-lg-3 mb-lg-0' v-btn v-btn--is-elevated v-btn--has-bg v-btn--router theme--light v-size--default"
             target="_blank"    href="/register">
            حساب جديد
          </a>
          <a v-if="!this.$page.props.auth.user" class="btn-2 btn btn-outline-primary  v-btn v-btn--is-elevated v-btn--has-bg v-btn--router theme--light v-size--default"
             target="_blank"  href="/login">
            تسجيل الدخول
          </a>


          <a v-if="this.$page.props.auth.user && this.$page.props.roles[0]['name'] == 'admin'"
             class="btn-1 btn btn-primary-2 ml-lg-3   mb-lg-0'"
             href="/admin/dashboard"
             target="_blank">
            لوحة التحكم
          </a>
          <a
            v-if="this.$page.props.auth.user && (this.$page.props.roles[0]['name'] == 'user' || this.$page.props.roles[0]['name'] == 'partner')"

            class="btn-1 btn btn-primary-2 ml-lg-3   mb-lg-0'" href="/dashboard"
            target="_blank">
            لوحة التحكم
          </a>
        </v-toolbar-items>
        <div class="mx-2">
          <label id="switch" class="switch">
            <input id="slider" v-model="light_theme" type="checkbox">
            <span class="slider round"></span>
          </label>


        </div>

        <span class="d-lg-none">
          <v-toolbar-side-icon @click="sidebar = !sidebar">
            <v-icon>mdi-menu</v-icon>
          </v-toolbar-side-icon>
        </span>
      </v-container>
    </v-toolbar>
    <v-content class="app-content">
      <slot></slot>
      <FlashMessage></FlashMessage>
    </v-content>
    <footer class="main-footer">
      <v-container>
        <v-row>
          <v-col cols="12" lg="4">
            <img alt="" class="mb-3" src="/images/home/logo-white.png"/>
            <h5 class="white--text mb-8" style="text-align: justify">
              {{ this.$page.props.footer_item.paragraph }}
            </h5>
            <div class="social-app d-flex">

              <a v-for="item in this.$page.props.social_media_items" :href="item.url"
                 class="text-decoration-none" target="_blank">
                <v-icon v-if="item.title==1" class="icon_social" color="blue darken-2 ">
                  mdi-facebook
                </v-icon>
                <v-icon v-if="item.title==2" class="icon_social" color="blue darken-2 ">
                  mdi-instagram
                </v-icon>
                <v-icon v-if="item.title==3" class="icon_social" color="blue darken-2">
                  mdi-whatsapp
                </v-icon>
                <v-icon v-if="item.title==4" class="icon_social" color="blue darken-2">
                  mdi-linkedin
                </v-icon>
                <v-icon v-if="item.title==5" class="icon_social" color="blue darken-2">
                  mdi-twitter
                </v-icon>
                <v-icon v-if="item.title==6" class="icon_social" color="blue darken-2 ">
                  mdi-youtube
                </v-icon>
              </a>

            </div>
          </v-col>
          <v-col cols="12" lg="3">
            <ul class="menu-mobile">
              <li v-for="item in this.$page.props.footer_items" v-if="item.button_text"
                  :key="item.id">
                <Link :href="item.button_url">{{ item.button_text }}</Link>
              </li>

            </ul>
          </v-col>
          <v-col cols="12" lg="5">
            <h4 class="font-weight-bold white--text">هل لديك سؤال؟</h4>
            <h5 class="white--text mb-3">ارسل لنا سؤال وسنرد عليك بأقرب وقت</h5>
            <form action="" class="form-footer">
              <v-row dense>
                <v-col cols="12">
                  <v-textarea v-model="contact_us_form.description"
                              :error-messages="$page.props.errors.description" outlined placeholder="اكتب استفسارك هنا"
                              rows="3"></v-textarea>
                </v-col>
                <v-col cols="12" lg="6">
                  <v-text-field v-model="contact_us_form.name"
                                :error-messages="$page.props.errors.name" outlined
                                placeholder="الاسم"></v-text-field>
                </v-col>
                <v-col cols="12" lg="6">
                  <v-text-field v-model="contact_us_form.email"
                                :error-messages="$page.props.errors.email" outlined
                                placeholder="البريد الالكتروني"></v-text-field>
                </v-col>
                <v-col cols="12">
                  <div class="text-left">
                    <v-btn :loading="contact_us_form.processing" color="#fff" variant="tonal"
                           @click="submit_contact_us"> اشترك
                    </v-btn>
                  </div>
                </v-col>
              </v-row>
            </form>
          </v-col>
        </v-row>
      </v-container>
    </footer>
  </v-app>
</template>

<script>
import 'swiper/css/swiper.css'
import throttle from "lodash/throttle";
import FlashMessage from "../../Sahred/FlashMessage";

export default {
  layout: 'null',
  data() {
    return {
      sidebar: false,
      light_theme: localStorage.getItem("theme") == 'light' ? true : false,
      tabs: null,
      contact_us_form: this.$inertia.form({
        email: null,
        name: null,
        description: null,

      }),
    }
  },
  components: {
    FlashMessage
  },
  methods: {
    submit_contact_us() {
      this.contact_us_form.post('/save_contact_us', {
        preserveScroll: true,
        onSuccess: () => {
          this.contact_us_form.reset()

        }
      })
    },
    toggleTheme() {
      if (this.light_theme == false) {
        document.querySelector("html").setAttribute("class", "dark");
        localStorage.setItem("theme", "dark");
      } else {
        document.querySelector("html").setAttribute("class", "light");
        localStorage.setItem("theme", "light");
      }
    },

  },
  created() {
    this.toggleTheme()

  },
  watch: {
    light_theme: {
      deep: true,
      handler: throttle(function () {
        this.toggleTheme()
      }, 150),
    },
  },

}
</script>


<style lang="scss">
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

html {
  scroll-behavior: smooth;
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
      color: #510900 !important;
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

header {
  &.main-header.v-toolbar {
    position: sticky !important;
    max-height: 80px;
    height: 80px !important;
    position: relative;
    width: 100%;
    top: 0;
    right: 0;
    background-color: #Fff !important;
    box-shadow: none !important;
    z-index: 3;

    .v-toolbar__content {
      height: 80px !important;
      margin: auto;
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
        letter-spacing: unset;
      }

      .btn-outline-primary {
        background-color: transparent;
      }

      &.menu {
        .v-btn {
          background-color: transparent !important;

          &:hover {
            color: #a21300;
            background-color: transparent;
          }
        }
      }
    }
  }
}

@media(max-width: 991px) {
  .widget_item-imgProject .widget_item-content {
    padding: 20px 10px;
  }
  .widget_item-imgProject .widget_item-content .widget_item-title {
    font-size: 20px;
  }
}


</style>

<style lang="scss">

html.dark {
  section-home {
    .btn {
      color: #FFF;
    }
  }

  .v-tabs-bar__content {
    background-color: #56565E !important;
  }

  .btn {
    // border: 1px solid #fff;
  }

  body, .v-application.theme--light {
    background-color: #56565E !important;
    color: #FFF !important;

    header.main-header.v-toolbar {
      background-color: #3A3A3A !important;

      .v-toolbar__items .v-btn {
        color: #FFF;
      }
    }

    .v-slide-group__content {
      background-color: red;

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





