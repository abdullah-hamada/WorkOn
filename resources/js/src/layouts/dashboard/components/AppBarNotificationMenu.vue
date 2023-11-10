<template>
  <v-menu left offset-y transition="slide-y-transition">
    <template v-slot:activator="{ on }">
      <v-badge v-if="$page.props.notifications_count"
               :content="$page.props.notifications_count"
               bordered
               offset-x="22"
               offset-y="22"
      >
        <v-btn icon v-on="on">
          <v-icon>mdi-bell-outline</v-icon>
        </v-btn>
      </v-badge>
      <v-badge v-else
               bordered
               content="0"
               offset-x="22"
               offset-y="22"
      >
        <v-btn icon v-on="on">
          <v-icon>mdi-bell-outline</v-icon>
        </v-btn>
      </v-badge>
    </template>

    <!-- dropdown card -->
    <v-card class="px-3">
      <v-list dense max-width="400" three-line>
        <v-subheader class="pa-2 font-weight-bold">الاشعارات</v-subheader>
        <div v-for="(item, index) in notifications" :key="index">
          <v-divider v-if="index > 0 && index < notifications.length" inset></v-divider>

          <Link id="list-item-103" class="v-list-item v-list-item--link theme--light" role="menuitem" tabindex="0"
                @click="go(item)">
            <v-list-item-avatar :color="item.color" size="32">
              <v-icon color="green" dark small>mdi-email-outline</v-icon>
            </v-list-item-avatar>

            <v-list-item-content>
              <v-list-item-title v-text="item.title"></v-list-item-title>
              <v-list-item-subtitle class="caption"
                                    v-text="item.text.substring(0,30)"></v-list-item-subtitle>
            </v-list-item-content>
            <v-list-item-action class="align-self-center">
              <v-list-item-action-text v-text="item.created_at"></v-list-item-action-text>
            </v-list-item-action>
          </Link>
        </div>
      </v-list>

      <div class="text-center py-2">
        <Link class="mb-2 v-btn v-btn--is-elevated v-btn--has-sm   v-btn    primary px-2" href="/notifications"
              type="button">
          <span class="">   مشاهدة الكل</span></Link>
      </div>
    </v-card>
  </v-menu>
</template>

<script>
/*
|---------------------------------------------------------------------
| Toolbar Notifications Component
|---------------------------------------------------------------------
|
| Quickmenu to check out notifications
|
*/

export default {
  data() {
    return {
      notifications: this.$page.props.notifications,

    }
  }, methods: {
    go(item) {
      let self = this
      this.axios.get('/make_notification_as_read', {
        params: {
          'notify_id': item.id
        }
      }).then(function () {
        self.$inertia.visit(item.link)
      })

    }
  }
}
</script>


<style scoped>
.v-list-item--dense .v-list-item__title, .v-list-item--dense .v-list-item__subtitle, .v-list--dense .v-list-item .v-list-item__title, .v-list--dense .v-list-item .v-list-item__subtitle {
  font-size: 0.975rem;
  font-weight: 500;

}

.v-list-item__title {
  font-size: 0.8125rem;
  font-weight: 500;
  line-height: 2rem !important;
}

/*.v-menu__content:not(.list-style) .v-list.v-list--dense .v-list-item {*/
/*  min-height: 3rem;*/
/*  height: 2rem;*/
/*}*/
.v-menu__content:not(.list-style) .v-list.v-list--dense .v-list-item {
  min-height: 5rem;
  height: 2rem;
}

</style>
