<template>
  <div class="pa-5">
    <h3 class="text-h4 primary--text text-center">
      🌟بيانات الدورة :
      {{ course.title }}
    </h3>
    <v-divider class="my-2"></v-divider>

    <v-row>
      <v-col lg="4">
        <v-card>
          <v-list class="list-info-cource">
            <v-list-item>
              <v-list-item-title class="align-center d-flex"><span class="font-weight-medium ml-2"> صورة الدورة :</span>
                <img :src="`/get_file/course_logos/${course.image}`" alt="" class="image-cource">
              </v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title><span
                class="font-weight-medium ml-2">العنوان : </span>{{ course.title }}
              </v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title><span class="font-weight-medium ml-2">مدرب الدورة : </span>
                {{ course.trainer.name }}
              </v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title><span
                class="font-weight-medium ml-2">الخدمة التابع لها الدورة : </span>
                {{ course.service.name }}
              </v-list-item-title>
            </v-list-item>

            <v-list-item>
              <v-list-item-title><span class="font-weight-medium ml-2">الوصف : </span>
                {{ course.brief_explanation }}
              </v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title><span class="font-weight-medium ml-2">تاريح الانعقاد </span>
                <span class="font-weight-medium"> من :</span> {{ course.date_from_in_time_zone }}
                {{ timezone }}
              </v-list-item-title>
            </v-list-item>

            <v-list-item>
              <v-list-item-title><span class="font-weight-medium ml-2">تاريح الانعقاد </span>
                <span class="font-weight-medium">الى :</span> {{ course.date_to_in_time_zone }}
                {{ timezone }}
              </v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title><span class="font-weight-medium ml-2">سعر الدورة : </span>
                <v-chip v-if="course.price_type ==1"
                        class="font-weight-medium" color="red" small>
                  مدفوع
                </v-chip>
                <v-chip v-if="course.price_type == 2" class="font-weight-medium" color="blue" small>
                  مجاني
                </v-chip>
              </v-list-item-title>
            </v-list-item>
            <v-list-item v-if="course.price_type == 1">
              <v-list-item-title><span class="font-weight-medium ml-2">السعر قبل الخصم : </span>
                {{ course.price_before_discount }} $
              </v-list-item-title>
            </v-list-item>

            <v-list-item v-if="course.price_type == 1">
              <v-list-item-title><span class="font-weight-medium ml-2">السعر بعد الخصم : </span>
                {{ course.price_after_discount }} $
              </v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-title><span class="font-weight-medium ml-2">حالة الدورة : </span>
                <v-chip v-if="course.status == 0"
                        class="font-weight-medium"
                        color="red"
                        small
                >
                  مجمد
                </v-chip>

                <v-chip v-if="course.status == 1"
                        class="font-weight-medium"
                        color="green"
                        small
                >
                  مفعل
                </v-chip>
              </v-list-item-title>
            </v-list-item>


            <v-list-item>
              <v-list-item-title><span
                class="font-weight-medium ml-2"> عدد المشاركين بالدورة : </span>
                {{ course.subscriber_users_count }} مشترك
              </v-list-item-title>
            </v-list-item>

            <v-list-item>
              <v-list-item-title><span class="font-weight-medium ml-2"> عرض صفحة  الدورة : </span>
                <a :href="`/course/${course.id}`" target="_blank">
                  <v-icon color="blue">mdi-eye</v-icon>
                </a>
              </v-list-item-title>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>
      <v-col lg="8">
        <v-card class="mb-4 d-flex  justify-space-between  ">
          <h3 class="primary--text px-2 py-3 ">عدد المشتركين : <span
            class="text-h6 black--text">{{ course.subscriber_users_count }} مشترك</span></h3>
          <v-tooltip bottom color="green">
            <template v-slot:activator="{ on, attrs }">
                       <span v-bind="attrs" v-on="on">
                         <a :href="`/admin/export_course_subscriber_info/${course.id}`"
                            class="text-decoration-none">
                          <v-icon class="px-2 py-3 " color="green" style="font-size: 29px">
                            mdi-microsoft-excel
                          </v-icon>
                        </a>
                      </span>
            </template>
            <span>  تصدير بيانات المشتركين  </span>
          </v-tooltip>


        </v-card>
        <v-card>
          <v-data-table
            :headers="headers"
            :items="course.subscriber_users"
            :items-per-page="30"
            class="elevation-1">

            <template #[`item.actions`]="{item}">
              <v-tooltip bottom color="blue">
                <template v-slot:activator="{ on, attrs }">
                 <span v-bind="attrs" v-on="on">
                  <v-icon
                    class="mr-2"
                    color="blue"
                    @click="ShowUserInfo(item)"
                  >
                  mdi-information
                </v-icon>
                    </span>
                </template>
                <span>  عرض بيانات المشترك </span>
              </v-tooltip>
            </template>

          </v-data-table>
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  props: {
    course: Object,
    timezone: String
  },
  data() {
    return {
      tabs: null,
      headers: [
        {text: 'الإسم', value: 'name'},
        // {text: 'البريد الإلكتروني', value: 'email'},
        {text: 'رقم الواتس اب', value: 'whatsapp_number'},
        {text: 'مبلغ الدفع', value: 'pivot.amount'},
        {text: 'الدولة', value: 'country.name_ar'},
        {text: 'التخصص', value: 'category.name_ar'},
        // {text: 'تاريخ الاشتراك', value: 'pivot.created_at'},
        {text: 'بيانات المشترك', value: 'actions'},
      ],
    }
  },
  methods: {
    ShowUserInfo(item) {
      this.$inertia.get('/admin/users/' + item.user_id)

    }
  }
}
</script>


<style lang="scss" scoped>
.boxed-container {
  max-width: 100% !important;
}

.v-application .pa-6 {
  padding: 0px !important;
}

//
* {
  box-sizing: border-box;
}

@import url('https://fonts.googleapis.com/css2?family=Tajawal:wght@400;500;700;800;900&display=swap');


body,
.v-application.theme--light {
  font-family: 'Tajawal', sans-serif;
}

.image-cource {
  width: 70px;
  border-radius: 4px;
}

.list-info-cource {
  .v-list-item {
    &:not(:last-of-type) {
      .v-list-item__title {
        border-bottom: 1px solid #d0d0d0;
        padding-bottom: 7px;
      }
    }
  }
}

</style>









