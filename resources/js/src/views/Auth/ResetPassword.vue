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
              max-height="30px"
              max-width="30px"
            ></v-img>

            <h2 class="text-2xl font-weight-semibold">{{ this.$page.props.logo_settings.text }}</h2>
          </router-link>
        </v-card-title>

        <!-- title -->
        <v-card-text>
          <p class="text-2xl font-weight-semibold text--primary mb-2">مرحبا بكم في ملتقيات! 👋🏻</p>
          <p class="mb-2">استرجاع كلمة المرور </p>
        </v-card-text>

        <!-- login form -->
        <v-card-text>
          <v-alert v-if="status"
                   type="success"
          >{{ status }}
          </v-alert>
          <v-form @submit.prevent="submit">
            <v-text-field
              v-model="form.email"
              :error-messages="$page.props.errors.email"
              label="البريد الإلكتروني"
              outlined
              placeholder="john@example.com"

            ></v-text-field>
            <v-text-field id="password" v-model="form.password"
                          :error-messages="this.$page.props.errors.password" autocomplete="password"
                          label="كلمة المرور" outlined
                          required
                          type="password"></v-text-field>
            <v-text-field id="password" v-model="form.password_confirmation"
                          :error-messages="this.$page.props.errors.password_confirmation"
                          autocomplete="password_confirmation"
                          label="تأكيد كلمة المرور"
                          outlined required
                          type="password"></v-text-field>


            <v-btn :loading="form.processing" block
                   class="mt-4 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default "
                   color="blue"
                   type="submit">
              تأكيد
            </v-btn>

          </v-form>
        </v-card-text>

        <!-- create new account  -->
        <v-card-text class="d-flex align-center justify-center flex-wrap mt-2">
          <span class="me-2">جديد على منصتنا؟</span>
          <Link href="/register" style="color:blue">إنشاء حساب جديد</Link>
        </v-card-text>

        <!-- divider -->
        <v-card-text class="d-flex align-center mt-2">
          <v-divider></v-divider>
          <span class="mx-5">أو</span>
          <v-divider></v-divider>
        </v-card-text>

        <!-- social links -->
        <v-card-actions class="d-flex justify-center">
          <v-btn v-for="link in socialLink" :key="link.icon" class="ms-1" icon>
            <v-icon :color="$vuetify.theme.dark ? link.colorInDark : link.color">
              {{ link.icon }}
            </v-icon>
          </v-btn>
        </v-card-actions>
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
import {mdiEyeOffOutline, mdiEyeOutline, mdiFacebook, mdiGoogle, mdiTwitter} from '@mdi/js'
import Blank from "../../layouts/dashboard/Blank";

export default {
  layout: Blank,
  props: {
    errors: Object,
    status: String,
    email: String,
    token: String,


  },
  data() {
    return {
      form: this.$inertia.form({
        password_confirmation: null,
        password: null,
        token: this.token,
        email: this.email,
      }),
      isPasswordVisible: null,
      socialLink: [
        {
          icon: mdiFacebook,
          color: '#4267b2',
          colorInDark: '#4267b2',
        },
        {
          icon: mdiTwitter,
          color: '#1da1f2',
          colorInDark: '#1da1f2',
        },
        // {
        //   icon: mdiGithub,
        //   color: '#272727',
        //   colorInDark: '#fff',
        // },
        {
          icon: mdiGoogle,
          color: '#db4437',
          colorInDark: '#db4437',
        },
      ],
      icons: {
        mdiEyeOutline,
        mdiEyeOffOutline,
      },
    }
  },
  methods: {


    submit() {
      this.form.post('/reset_password')
    },

  }

}
</script>

<style lang="scss">
@import '~@resources/sass/preset/pages/auth.scss';


//.swal-icon {
//  width: 166px;
//  height: 55px;
//}

</style>
