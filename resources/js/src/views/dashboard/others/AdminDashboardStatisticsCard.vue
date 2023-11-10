<template>
  <v-card>
    <v-card-title class="align-start">
      <span class="font-weight-semibold">احصائيات عامة</span>
      <v-spacer></v-spacer>
      <v-btn
        class="me-n3 mt-n2"
        icon
        small
      >
        <!--        <v-icon>-->
        <!--          {{ icons.mdiDotsVertical }}-->
        <!--        </v-icon>-->
      </v-btn>
    </v-card-title>

    <v-card-subtitle class="mb-8 mt-n5">
      <span>😎 معدل النمو</span>

      <span class="font-weight-semibold text--primary me-1">لهذا الشهر 46.6%</span>
    </v-card-subtitle>

    <v-card-text>
      <v-row>
        <v-col
          v-for="data in statisticsData"
          :key="data.title"
          class="d-flex align-center"
          cols="6"
          md="3"
        >
          <v-avatar
            :color="data.color"
            class="elevation-1"
            rounded
            size="44"
          >
            <v-icon
              color="white"
              dark
              size="30"
            >
              {{ data.icon }}
            </v-icon>
          </v-avatar>
          <div class="ms-3">
            <h4 class="text-xs mb-0">
              {{ data.title }}
            </h4>
            <h3 class="text-xl font-weight-semibold">
              {{ data.total }}
            </h3>
          </div>
        </v-col>
      </v-row>
    </v-card-text>
  </v-card>
</template>

<script>
// eslint-disable-next-line object-curly-newline

export default {
  props: {
    events_count: Number,
    users_count: Number,
    multakas_count: Number
  },
  data() {
    return {
      statisticsData: [
        {
          title: 'المبيعات',
          total: '245$',
          icon: 'mdi-cash-100',
          color: '#9155FD'


        },
        {
          title: 'المشتركين',
          total: this.users_count,
          icon: 'mdi-account-group-outline',
          color: 'green'


        },
        {
          title: 'الملتقيات',
          total: this.multakas_count,
          icon: 'mdi-format-list-bulleted',
          color: 'warning'


        },
        {
          title: 'الفعاليات',
          total: this.events_count,
          icon: 'mdi-bookmark-box-multiple-outline',
          color: 'blue'

        },
      ]

    }
  }
}
</script>
