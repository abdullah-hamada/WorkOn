<template>
  <v-row>
    <v-col cols="12" md="4">
      <random-message-card :random_message="random_message"></random-message-card>
    </v-col>
    <v-col cols="12" md="8">
      <dashboard-statistics-card
        :courses_count="courses.length"
        :notification_count="notification_count"
        :subscribe_courses_count="this.subscribe_courses_count"
      ></dashboard-statistics-card>
    </v-col>
    <v-col cols="12">
      <CourseSlider :courses="courses"></CourseSlider>
    </v-col>
  </v-row>
</template>

<script>
// eslint-disable-next-line object-curly-newline
// demos
import StatisticsVerticalCard from './others/StatisticsVerticalCard.vue'
import RandomMessageCard from './others/RandomMassageCard.vue'
import DashboardStatisticsCard from './others/UserDashboardStatisticsCard.vue'
import TotalEarningCard from './others/TotalEarningCard.vue'
import CourseSlider from "./others/CourseSlider.vue";

export default {
  props: {
    courses: Array,
    subscribe_courses_count: Number,
    notification_count: Number,
    random_message: String,
  },
  components: {
    RandomMessageCard,
    StatisticsVerticalCard,
    DashboardStatisticsCard,
    TotalEarningCard,
    CourseSlider
  },
}
</script>
