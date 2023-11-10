<template>
  <div>
    <h1 class="text-h4 black--text"> الاشعارات</h1>
    <v-divider class="my-2"></v-divider>
    <v-container fluid>
      <div v-if="all_notification.length > 0">
        <v-card v-for="(item,i) in all_notification" :key="i"
                class="pa-2" style="margin-bottom: 11px;">
          <Link :href="`${item.link}`" class="d-flex align-center text-decoration-none">
            <div class="col-auto">
              <div class="icon-notification">
                <v-icon color="blue">mdi-bell-badge-outline</v-icon>
              </div>
            </div>
            <div class="col">
              <h4 class="black--text mb-2">{{ item.title }} </h4>
              <h5 class="secondary--text"> {{ item.text }}
                <span style="float: left">{{ item.created_at }}</span>
              </h5>
            </div>
          </Link>
        </v-card>
      </div>
      <div v-else>
        <v-alert prominent type="error">
          <v-row align="center">
            <v-col class="grow">
              لا يوجد اشعارات
            </v-col>
          </v-row>
        </v-alert>
      </div>
    </v-container>
  </div>
</template>
<script>

export default {
  name: "Notification",
  props: {
    all_notification: Array
  }


}
</script>

<style scoped>

</style>
