<template>
  <v-app :class="{ 'navigation-closed': !show_menu }">
    <vertical-nav-menu :is-drawer-open.sync="isDrawerOpen"></vertical-nav-menu>

    <v-app-bar v-if="this.$page.props.auth.user"
               absolute
               app
               color="transparent"
               flat
    >
      <div class="boxed-container w-full">
        <div class="d-flex align-center mx-6" style="background-color: white;
              padding: 10px;
              border-radius: 8px;
              margin-top: 17px;">
          <!-- Left Content -->
          <v-app-bar-nav-icon
            class="d-block d-lg-none me-2"
            @click="isDrawerOpen = !isDrawerOpen"
          ></v-app-bar-nav-icon>

          <v-icon class="ml-2" @click="show_menu = !show_menu">
            mdi-menu
          </v-icon>
          <v-text-field
            :prepend-inner-icon="icons.mdiMagnify"
            class="app-bar-search flex-grow-0"
            dense
            hide-details
            outlined
            rounded
          ></v-text-field>

          <v-spacer></v-spacer>

          <!-- Right Content -->
          <!--          <a-->
          <!--            href="https://github.com/themeselection/materio-vuetify-vuejs-laravel-admin-template-free"-->
          <!--            target="_blank"-->
          <!--            rel="nofollow"-->
          <!--          >-->
          <!--            <v-icon class="ms-6 me-4">-->
          <!--              {{ icons.mdiGithub }}-->
          <!--            </v-icon>-->
          <!--          </a>-->
          <!--          <theme-switcher></theme-switcher>-->
          <v-btn class="ms-3"
                 icon
                 small
                 @click="show_logout_dialog"
          >
            <v-icon>
              mdi-logout-variant
            </v-icon>
          </v-btn>


          <AppBarNotificationMenu></AppBarNotificationMenu>
          <app-bar-user-menu></app-bar-user-menu>
        </div>
      </div>
    </v-app-bar>
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
    <v-main>
      <div class="app-content-container boxed-container pa-6">
        <slot></slot>
        <FlashMessage></FlashMessage>
      </div>
    </v-main>

    <v-footer v-if="this.$page.props.auth.user"
              absolute
              app
              class="px-0"
              color="transparent"
              height="56"
              inset
    >
      <div class="boxed-container w-full">
        <div class="mx-6 d-flex justify-space-between">
          <span>
           <a
             class="text-decoration-none"
             href=""
             target="_blank"
           >موقع ورك نت</a> &copy; 2023 </span>
          <span class="d-sm-inline d-none">
            <a
              class="me-6 text--secondary text-decoration-none"
              href="/"
              target="_blank"
            >جميع الحقوق محفوظة لشركة ورك نت</a>

          </span>
        </div>
      </div>
    </v-footer>
  </v-app>
</template>

<script>
import {ref} from '@vue/composition-api'
import {mdiBellOutline, mdiGithub, mdiMagnify} from '@mdi/js'
import VerticalNavMenu from './components/vertical-nav-menu/VerticalNavMenu.vue'
import ThemeSwitcher from './components/ThemeSwitcher.vue'
import AppBarUserMenu from './components/AppBarUserMenu.vue'
import AppBarNotificationMenu from './components/AppBarNotificationMenu.vue'
import FlashMessage from "../../Sahred/FlashMessage";

export default {
  components: {
    VerticalNavMenu,
    ThemeSwitcher,
    AppBarUserMenu, FlashMessage, AppBarNotificationMenu
  },
  data() {
    const isDrawerOpen = ref(null)

    return {
      isDrawerOpen,
      LogoutDialog: false,
      show_menu: true,
      // Icons
      icons: {
        mdiMagnify,
        mdiBellOutline,
        mdiGithub,
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
  mounted(){
    document.querySelector("html").setAttribute("class", "light");
  }
}
</script>

<style lang="scss">
.swal-text {
  background-color: #FEFAE3;
  padding: 17px;
  border: 1px solid #F0E1A1;
  display: block;
  margin: 22px;
  text-align: center;
  color: #61534e;
}


.swal-text {
  font-size: 20px;
  color: green;
  direction: rtl;
}

.swal-title {
  font-family: Tajawal;
  direction: rtl;
}

//.swal-icon {
//  width: 166px !important;
//  height: 55px !important;
//}


.swal-footer {
  text-align: center !important;


}

.swal-button {
  background-color: #605ae4 !important;
}

.swal-icon img {
  width: 166px !important;
  height: 55px !important;
}

.v-app-bar ::v-deep {
  .v-toolbar__content {
    padding: 0;

    .app-bar-search {
      .v-input__slot {
        padding-left: 18px;
      }
    }
  }
}

.boxed-container {
  max-width: 1440px;
  margin-left: auto;
  margin-right: auto;
}

th {
  color: black !important;
  font-size: 13px;

}

.v-card__title {
  color: black !important;
}

.theme--light.app-navigation-menu {
  background-color: white !important;
}

.v-navigation-drawer__content::-webkit-scrollbar {
  width: 6px;
}

.v-navigation-drawer__content::-webkit-scrollbar-track {
  background: #f1f1f1;
}

.v-navigation-drawer__content::-webkit-scrollbar-thumb {
  background: #888;
}


.app-navigation-menu .v-list-item_title, .app-navigation-menu .v-list-groupheader_append-icon {
  transition: all .2s ease-in-out;
}

.app-navigation-menu {
  transition: all .2s ease-in-out;
}

@media (min-width: 1264px) {

  .navigation-closed .app-navigation-menu {
    width: 74px !important;
  }

  .navigation-closed .vertical-nav-menu-items {
    padding-right: 8px !important;
  }

  .navigation-closed .app-navigation-menu .v-list-item__title,
  .navigation-closed .app-navigation-menu .v-list-group_header_append-icon {
    opacity: 0;
    flex-grow: 1;
  }

  .navigation-closed .v-navigation-drawer.app-navigation-menu .theme--light.v-list-item:before,
  .navigation-closed .v-navigation-drawer.app-navigation-menu .theme--light.v-list-item {
    border-radius: 5px !important;
  }

  .navigation-closed .vertical-nav-header {
    padding: 5px !important;
  }
  .navigation-closed .v-image__image {
    right: 0;
    width: 30% !important;
  }

  .v-main, header.v-toolbar {
    transition: all .2s ease-in-out;
  }

  .navigation-closed .v-main {
    padding-inline-start: 90px !important;
  }

  .navigation-closed header.v-toolbar {
    right: 90px !important;
  }
}
</style>
