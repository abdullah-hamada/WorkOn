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
      </v-btn>
    </v-card-title>
    <v-card-subtitle class="mb-8 mt-n5">
      <span class="font-weight-semibold text--primary me-1"> احصائات عامة عن المشترك 😎</span>
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
import {
  mdiAccountOutline,
  mdiCurrencyUsd,
  mdiDotsVertical,
  mdiLabelOutline,
  mdiTrendingUp
} from '@mdi/js'

export default {
  props: {
    subscribe_event_count: Number,
    notification_count: Number,
    event_count: Number,
    multakas_count: Number

  },
  data() {
    return {
      statisticsData: [
        {
          title: 'عدد الاشتراكات',
          total: this.subscribe_event_count,
          icon: 'mdi-numeric',
          color: '#9155FD'
        },
        {
          title: 'عدد الفعاليات',
          total: this.event_count,
          icon: 'mdi-bookmark-box-multiple-outline',
          color: 'green'


        },
        {
          title: 'عدد الملتقيات',
          total: this.multakas_count,
          icon: 'mdi-format-list-bulleted',
          color: 'warning'


        },
        {
          title: 'عدد الاشعارات',
          total: this.notification_count,
          icon: 'mdi-bell-badge-outline',
          color: 'blue'


        },
      ],
      resolveStatisticsIconVariation: data => {
        if (data === 'Sales') return {icon: 'mdi-numeric', color: 'primary'}
        if (data === 'Customers') return {icon: mdiAccountOutline, color: 'success'}
        if (data === 'Product') return {icon: mdiLabelOutline, color: 'warning'}
        if (data === 'Revenue') return {icon: mdiCurrencyUsd, color: 'info'}

        return {icon: mdiAccountOutline, color: 'success'}
      },
      icons: {
        mdiDotsVertical,
        mdiTrendingUp,
        mdiAccountOutline,
        mdiLabelOutline,
        mdiCurrencyUsd,
      },

    }
  },

}
</script>
