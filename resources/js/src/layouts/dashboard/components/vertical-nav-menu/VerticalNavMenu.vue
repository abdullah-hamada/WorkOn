<template>
  <v-navigation-drawer v-if="this.$page.props.auth.user"
                       :right="$vuetify.rtl"
                       :value="isDrawerOpen"
                       app
                       class="app-navigation-menu"
                       floating
                       width="260"
                       @input="val => $emit('update:is-drawer-open', val)"
  >
    <!-- Navigation Header -->
    <div class="vertical-nav-header d-flex items-center ps-6 pe-5 pt-5 pb-2">
      <router-link class="d-flex align-center text-decoration-none" to="/">
        <v-img
          :src="`/get_file/work_net_logo/${this.$page.props.logo_settings.logo}`"
          alt="logo"
          class="app-logo me-3"
          contain
          eager
          max-height='96px'
          max-width='212px'
        ></v-img>
        <v-slide-x-transition>
          <!--          <h2 class="app-title text&#45;&#45;primary">{{ this.$page.props.logo_settings.text }}</h2>-->
        </v-slide-x-transition>
      </router-link>
    </div>

    <!-- Navigation Items -->
    <v-list class="vertical-nav-menu-items pr-5" expand shaped>
      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'"
                     :class="this.$inertia.page.url =='/admin/dashboard' ? 'router-link-active router-link-exact-active' : ''"
                     :icon="icons.mdiHomeOutline"

                     :to="`/admin/dashboard`" title="لوحة التحكم"></nav-menu-link>
      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'user'"
                     :class="this.$inertia.page.url =='dashboard' ? 'router-link-active router-link-exact-active' : ''"
                     :icon="icons.mdiHomeOutline"

                     :to="`/dashboard`" title="لوحة التحكم"></nav-menu-link>
      <nav-menu-link :to="`/`" icon="mdi-web" target="_blank" title="الموقع"></nav-menu-link>

      <nav-menu-group v-if="this.$page.props.roles[0]['name'] == 'admin'" icon="mdi-playlist-check"
                      title="الموقع">
        <nav-menu-link :to="`/admin/main_page_control`" icon="mdi-format-list-bulleted-type" target="_blank"
                       title="الصفحة الرئيسية"></nav-menu-link>
        <nav-menu-link :to="`/admin/partner_page_control`" icon="mdi-format-list-bulleted-type" target="_blank"
                       title="صفحة الشركاء"></nav-menu-link>
        <!--        <nav-menu-link title="صفحة " :to="`/admin/prize_page_control`" target="_blank"-->
        <!--                       icon="mdi-leaf-circle-outline"></nav-menu-link>-->

      </nav-menu-group>
      <nav-menu-group v-if="this.$page.props.roles[0]['name'] == 'admin'" icon="mdi-cog-outline"
                      title="الإعدادات">


        <nav-menu-link :to="`/admin/logo_setting`" icon="mdi-ember" target="_blank"
                       title="الشعار"></nav-menu-link>
        <nav-menu-link :to="`/admin/motivational_message`" icon="mdi-message-text-outline" target="_blank"
                       title="الرسائل التحفيزية"></nav-menu-link>

        <nav-menu-link :to="`/admin/countries`" icon="mdi-home" target="_blank"
                       title="الدول"></nav-menu-link>
        <nav-menu-link :to="`/admin/categories`" icon="mdi-account-school" target="_blank"
                       title="التخصصات"></nav-menu-link>


        <nav-menu-link :to="`/admin/parent_categories`" icon="mdi-account-school" target="_blank"
                       title="تخصصات الشركاء"></nav-menu-link>
      </nav-menu-group>


      <!--      <nav-menu-link-->
      <!--        title="الصفحة الشخصية"-->
      <!--        :to="{ name: 'pages-account-settings' }"-->
      <!--        :icon="icons.mdiAccountCogOutline"-->
      <!--      ></nav-menu-link>-->

      <nav-menu-section-title title="الصفحات"></nav-menu-section-title>
      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" :class="this.$inertia.page.url =='/admin/users' ? 'router-link-active router-link-exact-active' : ''"
                     :to="`/admin/users`"
                     icon="mdi-account-details-outline" title="المستخدمين"></nav-menu-link>


      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" :class="this.$inertia.page.url =='/admin/trainers' ? 'router-link-active router-link-exact-active' : ''"
                     :to="`/admin/trainers`"
                     icon="mdi-human-male-board" title="المدربين"></nav-menu-link>

      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" :class="this.$inertia.page.url =='/admin/services' ? 'router-link-active router-link-exact-active' : ''"
                     :to="`/admin/services`"
                     icon="mdi-account-wrench-outline" title="الخدمات"></nav-menu-link>
      <nav-menu-link
        v-if="this.$page.props.roles[0]['name'] == 'admin'"
        :class="this.$inertia.page.url =='/admin/courses' ? 'router-link-active router-link-exact-active' : ''" :to="`/admin/courses`"
        icon="mdi-order-bool-ascending-variant"
        title=" الدورات "></nav-menu-link>

      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" :class="this.$inertia.page.url =='/admin/partners_order' ? 'router-link-active router-link-exact-active' : ''"
                     :to="`/admin/partners_order`"
                     icon="mdi-account-wrench-outline"
                     title="طلبات الشراكة"></nav-menu-link>
      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'"
                     :class="this.$inertia.page.url =='/admin/partner/cancel_order_requests' ? 'router-link-active router-link-exact-active' : ''"
                     :to="`/admin/partner/cancel_order_requests`"
                     icon="mdi-account-wrench-outline"
                     title="طلبات  الغاء الشراكة"></nav-menu-link>
      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" :class="this.$inertia.page.url =='/admin/partner/service_orders' ? 'router-link-active router-link-exact-active' : ''"
                     :icon="icons.mdiTable"
                     :to="`/admin/partner/service_orders`" title="طلبات الخدمات "></nav-menu-link>

      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" :class="this.$inertia.page.url =='/admin/company_service_order' ? 'router-link-active router-link-exact-active' : ''"
                     :icon="icons.mdiTable"
                     :to="`/admin/company_service_order`" title="طلبات المؤوسسات "></nav-menu-link>

      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" :class="this.$inertia.page.url =='/admin/subscribe_user_in_news' ? 'router-link-active router-link-exact-active' : ''"
                     :to="`/admin/subscribe_user_in_news`"
                     icon="mdi-email-fast-outline"
                     title="النشرة البريدية"></nav-menu-link>


      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" :class="this.$inertia.page.url =='/admin/contact_us' ? 'router-link-active router-link-exact-active' : ''"
                     :to="`/admin/contact_us`"
                     icon="mdi-chat-question-outline" title="طلبات تواصل معنا "></nav-menu-link>


      <!--      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" title="Role" :to="`/roles`" :icon="icons.mdiAccountCogOutline"></nav-menu-link>-->
      <!--      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" title="Permission" :to="`/permissions`" :icon="icons.mdiEyeOutline"></nav-menu-link>-->

      <!--      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" title="النشرة البريدية"-->
      <!--                     :class="this.$inertia.page.url =='/admin/subscribe_user_in_news' ? 'router-link-active router-link-exact-active' : ''"-->
      <!--                     :to="`/admin/subscribe_user_in_news`" icon="mdi-email-fast-outline"></nav-menu-link>-->


      <!--      <nav-menu-group title="الطلبات" icon="mdi-list-box"-->
      <!--&lt;!&ndash;                      v-if="this.$page.props.roles[0]['name'] == 'admin'">&ndash;&gt;-->


      <!--        <nav-menu-link-->
      <!--          :class="this.$inertia.page.url =='/admin/multaka_speaker_order' ? 'router-link-active router-link-exact-active' : ''"-->
      <!--          v-if="this.$page.props.roles[0]['name'] == 'admin'" title="  المتحدثين "-->
      <!--          :to="`/admin/multaka_speaker_order`"-->
      <!--          icon="mdi-bullhorn"></nav-menu-link>-->


      <!--      </nav-menu-group>-->


      <nav-menu-link
        v-if="this.$page.props.roles[0]['name'] == 'user'"
        :class="this.$inertia.page.url =='/courses' ? 'router-link-active router-link-exact-active' : ''" :to="`/courses`" icon="mdi-order-bool-ascending-variant"
        title=" الدورات "></nav-menu-link>


      <!--      <nav-menu-group title="طلباتي" icon="mdi-list-box"-->
      <!--                      v-if="this.$page.props.roles[0]['name'] == 'user'">-->

      <!--        <nav-menu-link-->
      <!--          :class="this.$inertia.page.url =='/multaka_speaker_order' ? 'router-link-active router-link-exact-active' : ''"-->
      <!--          v-if="this.$page.props.roles[0]['name'] == 'user'" title="  المتحدثين "-->
      <!--          :to="`/multaka_speaker_order`"-->
      <!--          icon="mdi-bullhorn"></nav-menu-link>-->

      <!--        <nav-menu-link-->
      <!--          :class="this.$inertia.page.url =='/multaka_participant_exhibition' ? 'router-link-active router-link-exact-active' : ''"-->
      <!--          v-if="this.$page.props.roles[0]['name'] == 'user'" title="  المشاركة "-->
      <!--          :to="`/multaka_participant_exhibition`"-->
      <!--          icon="mdi-account-convert"></nav-menu-link>-->
      <!--        <nav-menu-link-->
      <!--          :class="this.$inertia.page.url =='/multaka_material_order' ? 'router-link-active router-link-exact-active' : ''"-->
      <!--          v-if="this.$page.props.roles[0]['name'] == 'user'" title="  المواد الدعائية "-->
      <!--          :to="`/multaka_material_order`"-->
      <!--          icon="mdi-account-convert"></nav-menu-link>-->


      <!--        <nav-menu-link-->
      <!--          :class="this.$inertia.page.url =='/multaka_quest_order' ? 'router-link-active router-link-exact-active' : ''"-->
      <!--          v-if="this.$page.props.roles[0]['name'] == 'user'" title="  الضيوف  "-->
      <!--          :to="`/multaka_quest_order`"-->
      <!--          icon="mdi-account-child-circle"></nav-menu-link>-->
      <!--      </nav-menu-group>-->

      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'user'" :class="this.$inertia.page.url =='/user_subscribers' ? 'router-link-active router-link-exact-active' : ''"
                     :icon="icons.mdiTable"
                     :to="`/user_subscribers`" title="الإشتراكات"></nav-menu-link>

      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'user'" :class="this.$inertia.page.url =='/dashboard/user/partners' ? 'router-link-active router-link-exact-active' : ''"
                     :icon="icons.mdiTable"
                     :to="`/dashboard/user/partners`" title="شركاء وورك نت "></nav-menu-link>
      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'user'" :class="this.$inertia.page.url =='/dashboard/user/service_orders' ? 'router-link-active router-link-exact-active' : ''"
                     :icon="icons.mdiTable"
                     :to="`/dashboard/user/service_orders`" title="طلبات الخدمات "></nav-menu-link>
      <!--      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'admin'" title="الصلاحيات (قريبا)"-->
      <!--                     :to="``"-->
      <!--                     icon="mdi-account-multiple-plus-outline"></nav-menu-link>-->

      <!--      <nav-menu-link title="المحادثات (قريبا)" :to="``" icon="mdi-chat"></nav-menu-link>-->
      <!--      <nav-menu-link title="التقويم (قريبا)" :to="``"-->
      <!--                     icon="mdi-calendar-month-outline"></nav-menu-link>-->


      <!--      <nav-menu-link title="Typography" :to="{ name: 'typography' }" :icon="icons.mdiAlphaTBoxOutline"></nav-menu-link>-->
      <!--      <nav-menu-link title="Icons" :to="{ name: 'icons' }" :icon="icons.mdiEyeOutline"></nav-menu-link>-->
      <!--      <nav-menu-link title="Cards" :to="`/cards`" :icon="icons.mdiCreditCardOutline"></nav-menu-link>-->
      <!--      <nav-menu-link title="Form Layouts" :to="{ name: 'form-layouts' }" :icon="icons.mdiFormSelect"></nav-menu-link>-->


      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'partner'" :class="this.$inertia.page.url =='/dashboard/partner' ? 'router-link-active router-link-exact-active' : ''"
                     :to="`/dashboard/partner`"
                     icon="mdi-account-wrench-outline" title="بيانات الشريك"></nav-menu-link>
      <nav-menu-link v-if="this.$page.props.roles[0]['name'] == 'partner'" :class="this.$inertia.page.url =='/dashboard/partner/service_orders' ? 'router-link-active router-link-exact-active' : ''"
                     :icon="icons.mdiTable"
                     :to="`/dashboard/partner/service_orders`"
                     title="طلبات الخدمات "></nav-menu-link>
    </v-list>


    <!--    <a-->
    <!--      href="https://themeselection.com/products/materio-vuetify-vuejs-laravel-admin-template"-->
    <!--      target="_blank"-->
    <!--      rel="nofollow"-->
    <!--    >-->
    <!--      <v-img-->
    <!--        :src="require(`@/assets/images/pro/upgrade-banner-${$vuetify.theme.dark ? 'dark' : 'light'}.png`).default"-->
    <!--        alt="upgrade-banner"-->
    <!--        transition="scale-transition"-->
    <!--        class="upgrade-banner mx-auto"-->
    <!--        max-width="230"-->
    <!--      ></v-img>-->
    <!--    </a>-->
  </v-navigation-drawer>
</template>

<script>
// eslint-disable-next-line object-curly-newline
import {
  mdiAccountCogOutline,
  mdiAlphaTBoxOutline,
  mdiCreditCardOutline,
  mdiEyeOutline,
  mdiFileOutline,
  mdiFormSelect,
  mdiHomeOutline,
  mdiTable,
} from '@mdi/js'
import NavMenuSectionTitle from './components/NavMenuSectionTitle.vue'
import NavMenuGroup from './components/NavMenuGroup.vue'
import NavMenuLink from './components/NavMenuLink.vue'

export default {
  components: {
    NavMenuSectionTitle,
    NavMenuGroup,
    NavMenuLink,
  },
  props: {
    isDrawerOpen: {
      type: Boolean,
      default: null,
    },
  },
  setup() {
    return {
      icons: {
        mdiHomeOutline,
        mdiAlphaTBoxOutline,
        mdiEyeOutline,
        mdiCreditCardOutline,
        mdiTable,
        mdiFileOutline,
        mdiFormSelect,
        mdiAccountCogOutline,
      },
    }
  },
}
</script>

<style lang="scss" scoped>
@import '@resources/sass/preset/mixins.scss';

.app-title {
  font-size: 1.25rem;
  font-weight: 700;
  font-stretch: normal;
  font-style: normal;
  line-height: normal;
  letter-spacing: 0.3px;
}

// ? Adjust this `translateX` value to keep logo in center when vertical nav menu is collapsed (Value depends on your logo)
.app-logo {
  transition: all 0.18s ease-in-out;

  .v-navigation-drawer--mini-variant & {
    transform: translateX(-4px);
  }
}

@include theme(app-navigation-menu) using($material) {
  background-color: map-deep-get($material, 'background');
}

.app-navigation-menu {
  .v-list-item {
    &.vertical-nav-menu-link {
      ::v-deep .v-list-item__icon {
        .v-icon {
          transition: none !important;
        }
      }
    }
  }
}

// You can remove below style
// Upgrade Banner
.app-navigation-menu {
  .upgrade-banner {
    position: absolute;
    bottom: 13px;
    left: 50%;
    transform: translateX(-50%);
  }
}


.router-link-exact-active {
  background: linear-gradient(-72.47deg, rgb(25, 10, 213) 22.16%, rgba(25, 10, 213, .7) 76.47%) !important;
  color: white !important;
  //box-shadow: 0 3px 3px -2px var(--v-shadow-key-umbra-opacity, rgba(0, 0, 0, .2)),0 3px 4px 0 var(--v-shadow-key-penumbra-opacity, rgba(0, 0, 0, .14)),0 1px 8px 0 var(--v-shadow-key-penumbra-opacity, rgba(0, 0, 0, .12));
}
</style>
