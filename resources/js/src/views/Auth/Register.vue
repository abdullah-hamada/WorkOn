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
            <!--            <h2 class="text-2xl ظfont-weight-semibold">{{this.$page.props.logo_settings.text}}</h2>-->
          </router-link>
        </v-card-title>

        <!-- title -->
        <v-card-text>
          <p class="text-2xl font-weight-semibold text--primary mb-2">تبدأ المغامرة هنا 🚀</p>
          <!--          <p class="mb-2">اجعل إدارة تطبيقك سهلة وممتعة!</p>-->
        </v-card-text>

        <!-- login form -->
        <v-card-text>
          <v-form @submit.prevent="submit">
            <v-text-field
              v-model="form.username"
              :error-messages="$page.props.errors.username"
              class="mb-1"
              label="الإسم"
              outlined
              placeholder="مستخدم"
            ></v-text-field>

            <v-text-field
              v-model="form.email"
              :error-messages="$page.props.errors.email"
              class="mb-1"
              label="البريد الإلكتروني"
              outlined
              placeholder="john@example.com"
            ></v-text-field>

            <v-select v-model="form.country_id" :error-messages="$page.props.errors.country_id"
                      :items="countries"
                      :menu-props="{ contentClass: 'v-select-menu' }" item-text="name_ar"
                      item-value="id"
                      label="الدولة"
                      outlined

                      prepend-inner-icon="mdi-home-city"
            ></v-select>
            <v-select v-model="form.category_id" :error-messages="$page.props.errors.category_id"
                      :items="categories"
                      :menu-props="{ contentClass: 'v-select-menu' }" item-text="name_ar"
                      item-value="id"
                      label="التخصص"
                      outlined
                      prepend-inner-icon="mdi-account-school"
            ></v-select>


            <v-text-field
              v-model="form.whatsapp_number"
              :error-messages="$page.props.errors.whatsapp_number"
              class="mb-1"
              label="أدخل رقم الواتساب مع مقدمة الدولة مثال 00965"
              outlined
              placeholder="+960595056829"
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

            <!--            <v-checkbox hide-details class="mt-1">-->
            <!--              <template #label>-->
            <!--&lt;!&ndash;                <div class="d-flex align-center flex-wrap">&ndash;&gt;-->
            <!--&lt;!&ndash;                  <span class="me-2">I agree to</span><a href="javascript:void(0)">privacy policy&ndash;&gt;-->
            <!--&lt;!&ndash;                  &amp; terms</a>&ndash;&gt;-->
            <!--&lt;!&ndash;                </div>&ndash;&gt;-->
            <!--              </template>-->
            <!--            </v-checkbox>-->
            <v-btn :loading="form.processing" block
                   class="mt-6 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default "
                   color="blue"
                   type="submit"
            > تسجيل
            </v-btn>


          </v-form>
        </v-card-text>

        <!-- create new account  -->
        <v-card-text class="d-flex align-center justify-center flex-wrap mt-2">
          <span class="me-2"> هل لديك حساب؟ </span>
          <Link href="/login" style="color:blue"> قم بتسجيل الدخول بدلاً من ذلك</Link>

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
      height="190"
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

import Blank from "../../layouts/dashboard/Blank";

export default {
  layout: Blank,
  props: {
    categories: Array,
    countries: Array,
    user_type: String
  },
  data() {
    return {
      form: this.$inertia.form({
        username: null,
        email: null,
        password: null,
        whatsapp_number: null,
        category_id: null,
        country_id: null,
        type: this.user_type
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
      this.form.post('/register')
    },
    redirect(driver) {
      window.location.href = '/login/' + driver;
    }
  }
}
</script>

<style lang="scss">
@import '~@resources/sass/preset/pages/auth.scss';

.v-select-menu.v-menu__content {
  overflow-y: auto;
  overflow-x: hidden;
  contain: content;
}

.v-messages__message {
  margin-bottom: 12px;
}
</style>
