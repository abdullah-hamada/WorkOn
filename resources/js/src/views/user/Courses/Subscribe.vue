<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                الاشتراكات
              </h3>
              <v-col style="padding-left:20px">
              </v-col>
            </v-row>
          </v-toolbar>
          <v-card-text class="grey lighten-5 mt-3">
            <v-row>
              <v-col cols="12">
                <v-card>
                  <v-data-table
                    :expanded.sync="expanded"
                    :headers="headers"
                    :items="user_subscribes"
                    :search="search"
                    item-key="course.id"
                    show-expand
                    single-expand>
                    <template v-slot:expanded-item="{ headers, item }">
                      <td :colspan="headers.length">
                        <v-row dense>
                          <v-col class="mx-auto" cols="12" lg="12">
                            <v-row class="item-row py-4" dense>
                              <v-col cols="12" lg="6">
                                <v-row class="no-gutters" dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    عنوان الدورة :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.course.title }}

                                    (<a :href="`/course/${item.course.id}`"
                                        class="text-decoration-none"
                                        target="_blank"> تفاصيل الدورة</a>)
                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row class="no-gutters" dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    مدرب الدورة :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.course.trainer.name }}
                                  </v-col>
                                </v-row>
                              </v-col>

                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    تاريخ الانعقاد من :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.course.date_from_in_time_zone }} {{ timezone }}
                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    تالايخ الانعقاد الى :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.course.date_to_in_time_zone }} {{ timezone }}
                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    الخدمة التابعة اليها الدورة :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.course.service.name }}
                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    مبلغ الاشتراك :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.amount != null ? item.amount + ' Dolar' : 'مجاني'
                                    }}

                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    تاريخ الاشتراك :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.created_at }} {{ timezone }}
                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    دفع بواسطة :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.card ? item.card : 'مجاني' }}
                                  </v-col>
                                </v-row>
                              </v-col>

                            </v-row>
                          </v-col>
                        </v-row>
                      </td>
                    </template>
                    <template #[`item.price_type`]="{item}">
                      <v-chip v-if="item.course.price_type ==1"
                              class="font-weight-medium"
                              color="blue"
                              small
                      >
                        مدفوع
                      </v-chip>
                      <v-chip v-if="item.course.price_type == 2"
                              class="font-weight-medium"
                              color="green"
                              small
                      >
                        مجاني
                      </v-chip>
                    </template>
                    <template #[`item.actions`]="{item}">
                      <a :href="`/course/${item.course_id}`" target="_blank">
                        <v-icon class="mr-2" color="blue">
                          {{ mdiAccountEdit }}
                        </v-icon>
                      </a>
                    </template>
                    <template #[`item.date_from_in_time_zone`]="{item}">
                      {{ item.course.date_from_in_time_zone }} {{ timezone }}
                    </template>

                    <template #[`item.date_to_in_time_zone`]="{item}">
                      {{ item.course.date_to_in_time_zone }} {{ timezone }}
                    </template>
                    <template #[`item.created_at`]="{item}">
                      {{ item.created_at }} {{ timezone }}
                    </template>
                  </v-data-table>

                </v-card>
              </v-col>
            </v-row>

          </v-card-text>
        </v-card>
      </v-col>
    </v-row>
  </v-container>

</template>

<script>
import {mdiAccountEdit, mdiDeleteOutline, mdiDotsVertical, mdiSquareEditOutline} from '@mdi/js'

export default {
  props: {
    user_subscribes: Array,
    timezone: String
  },
  data() {
    return {
      mdiDeleteOutline: mdiDeleteOutline,
      mdiAccountEdit: mdiAccountEdit,
      search: '',
      dialog: false,
      dialogDelete: false,

      headers: [
        {text: 'الدورة', value: 'course.title', width: '250px'},
        {text: 'تاريخ الإنعقاد من ', value: 'date_from_in_time_zone'},
        {text: 'تاريخ الإنعقاد الى', value: 'date_to_in_time_zone'},
        {text: 'نمط الدفع', value: 'price_type'},
        {text: 'تاريخ الاشتراك', value: 'created_at'},
        {text: 'عرض    ', value: 'actions'},
      ],

      icons: {
        mdiSquareEditOutline,
        mdiDotsVertical,
      },
    }
  },
  methods: {
    showItem(item) {
      this.$inertia.get('/course/' + item.course_id)

    }
  },

}
</script>
<style type="scss">
.item-row {

> [class*="col-"] {

&
:not(:nth-last-of-type(-n+2)) {
  border-bottom: 1px solid #EEE;
}

&
:nth-child(odd) {
  border-left: 1px solid #EEE;
}

&
:nth-child(even) {
  padding-inline-start: 10px;
}

}
}
</style>
