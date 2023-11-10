<template>
  <v-row>
    <v-col cols="12" md="4">
      <random-message-card :random_message="random_message"></random-message-card>
    </v-col>
    <v-col cols="12" md="8">
      <dashboard-statistics-card :courses_count="courses_count"
                                 :users_count="users_count"></dashboard-statistics-card>
    </v-col>

    <v-col cols="12" md="4" sm="6">
      <total-earning-card :latest_courses="latest_courses"></total-earning-card>
    </v-col>

    <v-col cols="12" md="4" sm="6">
      <latest-courses-card
        :latest_courses="latest_courses"></latest-courses-card>
    </v-col>
    <v-col
      cols="12"
      md="4"
    >
      <v-row class="match-height">
        <v-col
          cols="12"
          sm="6"
        >
          <statistics-vertical-card
            :color="totalCategory.color"
            :icon="totalCategory.icon"
            :stat-title="totalCategory.statTitle"
            :statistics="categories_count"
          ></statistics-vertical-card>
        </v-col>
        <v-col
          cols="12"
          sm="6"
        >
          <statistics-vertical-card
            :color="totalCountry.color"
            :stat-title="totalCountry.statTitle"
            :statistics="countries_count"
            icon="mdi-home"
          ></statistics-vertical-card>
        </v-col>
        <v-col
          cols="12"
          sm="6"
        >
          <statistics-vertical-card
            :color="totalRoles.color"
            :icon="totalRoles.icon"
            :stat-title="totalRoles.statTitle"
            :statistics="roles_count"
          ></statistics-vertical-card>
        </v-col>
        <v-col
          cols="12"
          sm="6"
        >
          <statistics-vertical-card
            :color="totalPermissions.color"
            :icon="totalPermissions.icon"
            :stat-title="totalPermissions.statTitle"
            :statistics="permissions_count"
          ></statistics-vertical-card>
        </v-col>
      </v-row>
    </v-col>
  </v-row>
</template>

<script>
import {mdiCurrencyUsd, mdiHelpCircleOutline, mdiLabelVariantOutline, mdiPoll} from '@mdi/js'
import RandomMessageCard from './others/RandomMassageCard.vue'
import DashboardStatisticsCard from './others/AdminDashboardStatisticsCard.vue'
import LatestCoursesCard from './others/LatestCoursesCard.vue'
import TotalEarningCard from './others/TotalEarningCard.vue'
import StatisticsVerticalCard from './others/StatisticsVerticalCard.vue'

export default {
  props: {
    users_count: Number,
    courses_count: Number,
    latest_courses: Array,
    random_message: String,
    roles_count: Number,
    permissions_count: Number,
    countries_count: Number,
    categories_count: Number,
  },
  components: {
    RandomMessageCard,
    TotalEarningCard,
    LatestCoursesCard,
    StatisticsVerticalCard,
    DashboardStatisticsCard
  },
  setup() {
    const totalCategory = {
      statTitle: 'عدد التصنيفات',
      icon: mdiPoll,
      color: 'success',
      subtitle: 'Weekly Project',
      statistics: '$25.6k',
      change: '+42%',
    }

    const totalCountry = {
      statTitle: 'عدد الدول',
      icon: mdiCurrencyUsd,
      color: 'secondary',
      subtitle: 'Past Month',
      statistics: '$78',
      change: '-15%',
    }

    // vertical card options
    const totalRoles = {
      statTitle: 'عدد الأدوار',
      icon: mdiLabelVariantOutline,
      color: 'primary',
      subtitle: 'Yearly Project',
      statistics: '862',
      change: '-18%',
    }

    const totalPermissions = {
      statTitle: 'عدد الصلاحيات',
      icon: mdiHelpCircleOutline,
      color: 'warning',
      subtitle: 'Last week',
      statistics: '15',
      change: '-18%',
    }

    return {
      totalCategory,
      totalCountry,
      totalRoles,
      totalPermissions,
    }
  },
}
</script>
