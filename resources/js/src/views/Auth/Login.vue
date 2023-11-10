<template>
  <div class="auth-wrapper auth-v1">
    <div class="auth-inner">
      <v-card class="auth-card">
        <!-- logo -->
        <v-card-title class="d-flex align-center justify-center py-7">
          <router-link class="d-flex align-center" to="/">
            <v-img
              :src="`/get_file/work_net_logo/${this.$page.props.logo_settings.logo}`"
              alt="logo"
              class="me-3"
              contain
              max-height="116px"
            ></v-img>

            <!--            <h2 class="text-2xl font-weight-semibold">{{this.$page.props.logo_settings.text}}</h2>-->
          </router-link>
        </v-card-title>

        <!-- title -->
        <v-card-text>
          <p class="text-2xl font-weight-semibold text--primary mb-2">مرحبا بكم في ورك نت ! 👋🏻</p>
          <p class="mb-2">يرجى تسجيل الدخول إلى حسابك </p>
        </v-card-text>

        <!-- login form -->
        <v-card-text>
          <v-form @submit.prevent="submit">
            <v-text-field
              v-model="form.email"
              :error-messages="$page.props.errors.email"
              class="mb-3"
              label="البريد الإلكتروني"
              outlined
              placeholder="john@example.com"
            ></v-text-field>

            <v-text-field
              v-model="form.password"
              :append-icon="isPasswordVisible ? 'mdi-eye-off-outline': 'mdi-eye-outline'"
              :error-messages="$page.props.errors.password"
              :type="isPasswordVisible ? 'text' : 'password'"
              label="كلمة المرور"
              outlined
              placeholder="············"
              @click:append="isPasswordVisible = !isPasswordVisible"
            ></v-text-field>

            <div class="d-flex align-center justify-space-between flex-wrap">
              <v-checkbox v-model="form.remember" class="me-3 mt-1" hide-details
                          label=" تذكرني  "></v-checkbox>

              <!-- forgot link -->
              <Link class="mt-1" href="forgot-password"> هل نسيت كلمة المرور؟</Link>
            </div>

            <v-btn :loading="form.processing" block
                   class="mt-6   v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default "
                   color="blue"
                   type="submit">
              تسجيل الدخول
            </v-btn>

          </v-form>
        </v-card-text>

        <!-- create new account  -->
        <v-card-text class="d-flex align-center justify-center flex-wrap mt-2">
          <span class="me-2">جديد على منصتنا؟</span>
          <Link href="/register" style="color:blue">إنشاء حساب جديد</Link>
        </v-card-text>

        <!--        &lt;!&ndash; divider &ndash;&gt;-->
        <!--        <v-card-text class="d-flex align-center mt-2">-->
        <!--          <v-divider></v-divider>-->
        <!--          <span class="mx-5">أو</span>-->
        <!--          <v-divider></v-divider>-->
        <!--        </v-card-text>-->

        <!--        &lt;!&ndash; social links &ndash;&gt;-->
        <!--        <v-card-actions class="d-flex justify-center">-->
        <!--          <v-btn v-for="link in socialLink" :key="link.icon" @click="redirect(link.driver)"  icon class="ms-1">-->
        <!--            <v-icon :color="$vuetify.theme.dark ? link.colorInDark : link.color">-->
        <!--              {{ link.icon }}-->
        <!--            </v-icon>-->
        <!--          </v-btn>-->


        <!--        </v-card-actions>-->
      </v-card>
    </div>

    <!-- background triangle shape  -->
    <img
      :src="require(`@/assets/images/misc/mask-${$vuetify.theme.dark ? 'dark' : 'light'}.png`).default"
      class="auth-mask-bg"
      height="173"
    />

    <!-- tree -->
    <v-img :src="require('@/assets/images/misc/tree.png').default" class="auth-tree" height="185"
           width="247"></v-img>

    <!-- tree  -->
    <v-img
      :src="require('@/assets/images/misc/tree-3.png').default"
      class="auth-tree-3"
      height="289"
      width="377"
    ></v-img>
  </div>
</template>

<script>
// eslint-disable-next-line object-curly-newline
import Blank from "../../layouts/dashboard/Blank";

export default {
  layout: Blank,
  data() {
    return {
      form: this.$inertia.form({
        email: null,
        password: null,
        remember: null
      }),
      isPasswordVisible: null,
      socialLink: [
        {
          icon: 'mdi-facebook',
          color: '#4267b2',
          colorInDark: '#4267b2',
          driver: 'facebook'
        },
        // {
        //   icon: mdiTwitter,
        //   color: '#1da1f2',
        //   colorInDark: '#1da1f2',
        // },

        {
          icon: 'mdi-google',
          color: '#db4437',
          colorInDark: '#db4437',
          driver: 'google'


        },
        {
          icon: 'mdi-linkedin',
          color: '#4267b2',
          colorInDark: '#fff',
          driver: 'linkedin'


        },
      ],
    }
  },
  methods: {

    submit() {
      this.form.post('login', {
        onSuccess: page => {
          // if( this.$page.props.roles[0]["name"] == "user"){
          //   swal({
          //     title: 'أهلا وسهلا بك في ملتقيات',
          //     text:  this.$page.props.random_message ,
          //     icon:`/get_file/multaka_logo/${this.$page.props.logo_settings.logo}`,
          //     buttons: false,
          //     timer: 5000,
          //   });
          // }
        }
      })
    },
    redirect(driver) {
      window.location.href = '/login/' + driver;
    }
  }

}
</script>

<style lang="scss" scoped>
@import '~@resources/sass/preset/pages/auth.scss';


//.swal-icon {
//  width: 166px;
//  height: 55px;
//}

</style>
