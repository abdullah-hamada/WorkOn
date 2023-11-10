<template>
  <v-card class="greeting-card">
    <v-row class="ma-0 pa-0">
      <v-col cols="8">
        <v-card-title class="pt-1 ps-2"> {{ random_message }} 🥳</v-card-title>
        <v-card-subtitle class="text-no-wrap ps-2">{{ this.$page.props.auth.user.name }}
        </v-card-subtitle>
        <v-card-text class="d-flex align-center mt-2 pb-2 ps-2">
          <div>
            <p v-if="this.$page.props.roles[0]['name'] == 'admin'"
               class="text-xl font-weight-semibold primary--text mb-2">المدير </p>
            <p v-if="this.$page.props.roles[0]['name'] == 'user'"
               class="text-xl font-weight-semibold primary--text mb-2">مشترك</p>
            <v-btn v-if="this.$page.props.roles[0]['name'] == 'user'" color="primary" small
                   to="/events">عرض الفعاليات
            </v-btn>
            <v-btn v-if="this.$page.props.roles[0]['name'] == 'admin'" color="primary" small
                   to="/admin/events">عرض الأحداث
            </v-btn>
          </div>
        </v-card-text>
      </v-col>

      <v-col cols="4">
        <v-img
          :src="require(`@/assets/images/misc/triangle-${$vuetify.theme.dark ? 'dark' : 'light'}.png`).default"
          class="greeting-card-bg"
          contain
          height="180"
          width="159"
        ></v-img>
        <v-img
          :src="require('@/assets/images/misc/trophy.png').default"
          class="greeting-card-trophy"
          contain
          height="108"
          max-width="83"
        ></v-img>
      </v-col>
    </v-row>
  </v-card>
</template>

<script>


export default {
  props: {

    random_message: String
  },
  setup() {

  },
}
</script>

<style lang="scss" scoped>
.greeting-card {
  position: relative;

  .greeting-card-bg {
    position: absolute;
    bottom: 0;
    right: 0;
  }

  .greeting-card-trophy {
    position: absolute;
    bottom: 10%;
    right: 8%;
  }
}

// rtl
.v-application {
  &.v-application--is-rtl {
    .greeting-card-bg {
      right: initial;
      left: 0;
      transform: rotateY(180deg);
    }

    .greeting-card-trophy {
      left: 8%;
      right: initial;
    }
  }
}
</style>
