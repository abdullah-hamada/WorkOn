<template>
  <div>
    <v-menu content-class="user-profile-menu-content" left min-width="230" nudge-bottom="14"
            offset-y>
      <template v-slot:activator="{ on, attrs }">
        <v-badge bottom class="ms-4" color="success" dot offset-x="12" offset-y="12" overlap>
          <v-avatar size="40px" v-bind="attrs" v-on="on">
            <v-img :src="user_image"></v-img>
          </v-avatar>
        </v-badge>
      </template>
      <v-list>
        <div class="pb-3 pt-2">
          <v-badge bottom class="ms-4" color="success" dot offset-x="12" offset-y="12" overlap>
            <v-avatar size="40px">
              <v-img :src="user_image"></v-img>
            </v-avatar>
          </v-badge>
          <div class="d-inline-flex flex-column justify-center ms-3" style="vertical-align: middle">
            <span
              class="text--primary font-weight-semibold mb-n1"> {{ this.$page.props.auth.user.name }} </span>
            <small v-if="this.$page.props.roles[0]['name'] == 'admin'"
                   class="text--disabled text-capitalize">المدير العام</small>
          </div>
        </div>

        <v-divider></v-divider>

        <!-- Profile -->
        <v-list-item v-if="this.$page.props.roles[0]['name'] == 'user'" link
                     @click="$inertia.get('/profile')">
          <v-list-item-icon class="me-2">
            <v-icon size="22">
              {{ icons.mdiAccountOutline }}
            </v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>الملف الشخصي</v-list-item-title>
          </v-list-item-content>
        </v-list-item>

        <!--        &lt;!&ndash; Email &ndash;&gt;-->
        <!--        <v-list-item link>-->
        <!--          <v-list-item-icon class="me-2">-->
        <!--            <v-icon size="22">-->
        <!--              {{ icons.mdiEmailOutline }}-->
        <!--            </v-icon>-->
        <!--          </v-list-item-icon>-->
        <!--          <v-list-item-content>-->
        <!--            <v-list-item-title>البريد الوارد</v-list-item-title>-->
        <!--          </v-list-item-content>-->
        <!--        </v-list-item>-->

        <!--        &lt;!&ndash; Chat &ndash;&gt;-->
        <!--        <v-list-item link>-->
        <!--          <v-list-item-icon class="me-2">-->
        <!--            <v-icon size="22">-->
        <!--              {{ icons.mdiChatOutline }}-->
        <!--            </v-icon>-->
        <!--          </v-list-item-icon>-->
        <!--          <v-list-item-content>-->
        <!--            <v-list-item-title>المحادثات</v-list-item-title>-->
        <!--          </v-list-item-content>-->

        <!--          &lt;!&ndash;        <v-list-item-action>&ndash;&gt;-->
        <!--          &lt;!&ndash;          <v-badge inline color="error" content="2"> </v-badge>&ndash;&gt;-->
        <!--          &lt;!&ndash;        </v-list-item-action>&ndash;&gt;-->
        <!--        </v-list-item>-->

        <!--        <v-divider class="my-2"></v-divider>-->

        <!-- Settings -->
        <v-list-item v-if="this.$page.props.roles[0]['name'] == 'admin'" link
                     @click="$inertia.get('/admin/main_page_control')">
          <v-list-item-icon class="me-2">
            <v-icon size="22">
              {{ icons.mdiCogOutline }}
            </v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>الإعدادات</v-list-item-title>
          </v-list-item-content>
        </v-list-item>
        <v-divider class="my-2"></v-divider>


        <!--        &lt;!&ndash; FAQ &ndash;&gt;-->
        <!--        <v-list-item link>-->
        <!--          <v-list-item-icon class="me-2">-->
        <!--            <v-icon size="22">-->
        <!--              {{ icons.mdiHelpCircleOutline }}-->
        <!--            </v-icon>-->
        <!--          </v-list-item-icon>-->
        <!--          <v-list-item-content>-->
        <!--            <v-list-item-title>الأسئلة الشائعة</v-list-item-title>-->
        <!--          </v-list-item-content>-->
        <!--        </v-list-item>-->

        <!--        <v-divider class="my-2"></v-divider>-->

        <!-- Logout -->
        <a class="v-list-item v-list-item--link theme--light" @click="show_logout_dialog">
          <v-list-item-icon class="me-2">
            <v-icon size="22">
              {{ icons.mdiLogoutVariant }}
            </v-icon>
          </v-list-item-icon>
          <v-list-item-content>
            <v-list-item-title>تسجيل الخروج</v-list-item-title>
          </v-list-item-content>
        </a>

      </v-list>
    </v-menu>
    <v-dialog
      v-model="LogoutDialog"
      :style="{ zIndex: 200 }"
      max-width="400px"
      @keydown.esc="cancel"
    >
      <v-card>
        <v-toolbar color="warning" dark dense flat>
          <v-toolbar-title class="text-body-1 font-weight-bold black--text">
            <h3 style="color:rgba(94, 86, 105, 0.87)  !important"> رسالة تأكيد</h3>

          </v-toolbar-title>
        </v-toolbar>
        <v-card-text
          class="pa-4 fs-3 black--text"
        >
          <h3>هل أنت متأكد من تسجيل الخروج ؟</h3>
        </v-card-text>
        <v-card-actions class="pt-3">
          <v-spacer></v-spacer>

          <v-btn
            class="body-2 font-weight-bold"
            color="primary"
            outlined
            @click.native="LogoutConfirm"
          >نعم
          </v-btn
          >
          <v-btn
            class="body-2 font-weight-bold"
            color="red"
            outlined
            @click.native="closeDialog"
          >لا
          </v-btn
          >
        </v-card-actions>
      </v-card>
    </v-dialog>
  </div>
</template>

<script>
import {
  mdiAccountOutline,
  mdiChatOutline,
  mdiCheckboxMarkedOutline,
  mdiCogOutline,
  mdiCurrencyUsd,
  mdiEmailOutline,
  mdiHelpCircleOutline,
  mdiLogoutVariant,
} from '@mdi/js'

export default {
  data() {
    return {
      user_image: this.$page.props.user_image,
      LogoutDialog: false,
      icons: {
        mdiAccountOutline,
        mdiEmailOutline,
        mdiCheckboxMarkedOutline,
        mdiChatOutline,
        mdiCogOutline,
        mdiCurrencyUsd,
        mdiHelpCircleOutline,
        mdiLogoutVariant,
      },
    }
  },
  methods: {
    closeDialog() {
      this.LogoutDialog = false
    },
    show_logout_dialog() {
      this.LogoutDialog = true
    },
    LogoutConfirm() {
      this.LogoutDialog = false
      location.href = '/logout'
    },
  },
  mounted() {
    this.$root.$on('ChangeImage', () => {
      this.user_image = this.$page.props.user_image;
    })
  }
}
</script>

<style lang="scss">
.user-profile-menu-content {
  .v-list-item {
    min-height: 2.5rem !important;
  }
}
</style>
