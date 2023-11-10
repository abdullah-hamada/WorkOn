<template>
  <div class="pa-5">
    <h3 class="text-h4 primary--text text-center">
      🌟بيانات المشترك :
      {{ user.name }}
    </h3>
    <v-divider class="my-2"></v-divider>
    <v-row>
      <v-col lg="4">
        <v-card>
          <v-list>
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-account-outline</v-icon>
              </v-list-item-icon>
              <v-list-item-title>الاسم : {{ user.name }}</v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-email-outline</v-icon>
              </v-list-item-icon>
              <v-list-item-title>البريد الالكتروني : {{ user.email }}</v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-whatsapp</v-icon>
              </v-list-item-icon>
              <v-list-item-title> رقم الواتساب : {{ user.whatsapp_number }}</v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-flag-variant-outline</v-icon>
              </v-list-item-icon>
              <v-list-item-title> الدولة : {{ user.country.name_ar }}</v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-briefcase-outline</v-icon>
              </v-list-item-icon>
              <v-list-item-title> التخصص :{{ user.category.name_ar }}</v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-check</v-icon>
              </v-list-item-icon>
              <v-list-item-title>
                الحالة :
                <v-chip v-if="user.status == 0"
                        class="font-weight-medium"
                        color="red"
                        small
                >
                  مجمد
                </v-chip>
                <v-chip v-if="user.status == 1"
                        class="font-weight-medium"
                        color="green"
                        small
                >
                  مفعل
                </v-chip>
              </v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-clipboard-text-clock</v-icon>
              </v-list-item-icon>
              <v-list-item-title> تاريخ الإشتراك :{{ user.created_at }}</v-list-item-title>
            </v-list-item>
            <v-list-item>
              <v-list-item-icon>
                <v-icon>mdi-playlist-plus</v-icon>
              </v-list-item-icon>
              <v-list-item-title> الدورات المشترك بها : {{ user.courses_count }}</v-list-item-title>
            </v-list-item>
          </v-list>
        </v-card>
      </v-col>
      <v-col lg="8">
        <v-card>
          <!--          <v-tabs class="v&#45;&#45;tabs" v-model="tabs" flat>-->
          <!--            <v-tab> الدورات المجانية </v-tab>-->
          <!--            <v-tab> الدورات  المدفوعة المشترك بها </v-tab>-->
          <!--          </v-tabs>-->
          <!--          <v-tabs-items v-model="tabs">-->
          <!--            <v-tab-item>-->
          <v-data-table
            :headers="headers"
            :items="user.courses"
            :items-per-page="30"
            class="elevation-1"
          >
            <template #[`item.amount`]="{item}">
              <span> {{ item.pivot.amount ? item.pivot.amount + '$' : 'مجاني' }} </span>

            </template>
            <template #[`item.actions`]="{item}">
              <v-tooltip bottom color="blue">
                <template v-slot:activator="{ on, attrs }">
                 <span v-bind="attrs" v-on="on">
                  <v-icon
                    class="mr-2"
                    color="blue"
                    @click="ShowCourseInfo(item)"
                  >
                  mdi-information
                </v-icon>
                    </span>
                </template>
                <span>  عرض بيانات الدورة </span>
              </v-tooltip>
            </template>


          </v-data-table>
          <!--            </v-tab-item>-->
          <!--            <v-tab-item>-->
          <!--              22-->
          <!--            </v-tab-item>-->
          <!--          </v-tabs-items>-->
        </v-card>
      </v-col>
    </v-row>
  </div>
</template>

<script>
export default {
  props: {
    user: Object
  },
  data() {
    return {
      tabs: null,
      headers: [
        {text: 'عنوان الدورة', value: 'title', width: '250px'},
        {text: 'مبلغ الدفع', value: 'amount'},
        {text: '  تاريخ الاشتراك', value: 'pivot.created_at'},
        {text: 'بيانات الدورة', value: 'actions'},

      ],

    }
  },

  methods: {
    ShowCourseInfo(item) {
      this.$inertia.get('/admin/courses/' + item.id)

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

.v-tabs.v--tabs {
  .v-tab {
    flex: 1 1 0;
    max-width: unset;
  }
}


</style>









