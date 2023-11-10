<template>
  <div>
    <v-container fluid>
      <v-row>
        <v-col cols="12" md="12" sm="12">
          <v-card>
            <v-toolbar class="header_title" color="primary" dark>
              <v-row class="justify-space-between  px-2 px-lg-3">
                <v-col>
                  <h4>
                    بيانات الطلب للمؤوسسة (
                    {{ company_service_order.company_name }}
                    )
                  </h4>
                </v-col>
              </v-row>
            </v-toolbar>
            <v-card-text class="grey lighten-5">
              <v-container fluid>
                <v-row dense>
                  <v-col cols="12" md="4">
                    <v-card class="h-full d-flex flex-column">
                      <div class="pa-3 flex-grow-1">
                        <div class="d-flex align-center flex-column">
                          <v-avatar size="120" small>
                            <v-img
                              :src="`/get_file/company_service_order_logo/${company_service_order.logo}`"/>
                          </v-avatar>
                          <div class="text-center mt-2">
                            <span class="font-weight-bold text-body-2">
                             {{ company_service_order.company_name }}
                              </span>
                          </div>
                          <v-chip class="font-weight-bold mt-2" color="accent">
                            مؤوسسة
                          </v-chip>
                          <v-row class="mt-3" dense>
                            <v-col
                              cols="12"
                              lg="2"
                              md="8"
                            >
                              <a
                                :href="this.company_service_order.webiste_url  "
                                class="flex-grow-1"
                                target="_blank">
                                <v-icon color="blue" left>mdi-web</v-icon>
                              </a>
                            </v-col>
                            <v-col
                              cols="12"
                              lg="2"
                              md="8"
                            >
                              <a
                                :href="this.company_service_order.facebook_url  "
                                class="flex-grow-1"
                                target="_blank">
                                <v-icon color="blue" left>mdi-facebook</v-icon>
                              </a>
                            </v-col>
                            <v-col
                              cols="12"
                              lg="2"
                              md="8"
                            >
                              <a
                                :href="this.company_service_order.instagram_url  "
                                class="flex-grow-1"
                                target="_blank">
                                <v-icon color="red" left>mdi-instagram</v-icon>
                              </a>
                            </v-col>
                            <v-col
                              cols="12"
                              lg="2"
                              md="8"
                            >
                              <a
                                :href="this.company_service_order.linkedin_url  "
                                class="flex-grow-1"
                                target="_blank">
                                <v-icon color="blue" left>mdi-linkedin</v-icon>
                              </a>
                            </v-col>
                            <v-col
                              cols="12"
                              lg="2"
                              md="8"
                            >
                              <a
                                :href="this.company_service_order.twitter_url  "
                                class="flex-grow-1"
                                target="_blank">
                                <v-icon color="blue" left>mdi-twitter</v-icon>
                              </a>
                            </v-col>
                          </v-row>
                        </div>
                      </div>
                      <v-divider></v-divider>
                      <div class="d-flex">
                        <v-divider vertical></v-divider>
                      </div>
                    </v-card>
                  </v-col>
                  <v-col cols="12" md="8">
                    <v-card class="h-full d-flex flex-column">
                      <v-card-title class="font-weight-bold">
                        <div class="flex-grow-1 text-truncate">
                          البيانات الاساسية
                          <v-divider class="mt-3"></v-divider>
                        </div>
                      </v-card-title>
                      <v-card-text class="flex-grow-1 ">
                        <div>
                          <v-chip v-for="item in service_order_items" :key="item" class="ml-2 mb-2"
                                  color="primary" outlined>
                            <v-tooltip bottom color="primary">
                              <template v-slot:activator="{ on, attrs }">
                               <span v-bind="attrs" v-on="on">
                                <v-icon>{{ item.icon }}</v-icon>
                                <span class="mr-1  ml-1">{{ item.text }}</span>
                               </span>
                              </template>
                              <span>   {{ item.name }}  </span>
                            </v-tooltip>
                          </v-chip>
                          <v-divider class="mt-3 mb-3 "></v-divider>
                          <h3 class="black--text">{{ company_service_order.company_info }}</h3>

                        </div>

                      </v-card-text>
                      <v-divider></v-divider>
                    </v-card>
                  </v-col>
                </v-row>
                <v-row dense>
                  <v-col cols="12" md="12">
                    <v-card class="h-full d-flex flex-column">
                      <v-card-title class="font-weight-bold">
                        <div class="flex-grow-1 text-truncate">
                        بيانات الخدمة الطلوبة
                          <v-divider class="mt-3"></v-divider>
                        </div>
                      </v-card-title>
                      <v-card-text class="flex-grow-1">
                        <v-card>
                          <v-simple-table>
                            <thead>
                            <tr>
                              <th  >
                                اسم الخدمة
                              </th>
                              <th  >
                                الفئة المستهدفة
                              </th>
                              <th  >
                                العدد المستهدف
                              </th>
                              <th  >
                                الفئة العمرية
                              </th>
                              <th  >
                                مدة التدريب
                              </th>
                            </tr>
                            </thead>
                            <tbody>
                            <tr >
                              <td>
                                 <span v-if="company_service_order.service == 1">استشارات</span>
                                <span v-if="company_service_order.service == 2">تدريب</span>
                                <span v-if="company_service_order.service == 3">احتضان</span>
                                <span v-if="company_service_order.service == 4">فرص عمل</span>
                                <span v-if="company_service_order.service == 5">أخرى</span>
                              </td>

                              <td>
                                <span v-if="company_service_order.category == 1">طلاب</span>
                                <span v-if="company_service_order.category == 2">موظفين</span>
                                <span v-if="company_service_order.category == 3">أيتام</span>
                                 <span v-if="company_service_order.category == 4">أخرى</span>
                              </td>

                              <td>
                                <span v-if="company_service_order.target_number == 1">أقل من 10</span>
                                <span v-if="company_service_order.target_number == 2">10-50</span>
                                <span v-if="company_service_order.target_number == 3">50-100</span>
                                <span v-if="company_service_order.target_number == 4">100-200</span>
                                <span v-if="company_service_order.target_number == 5">أكثر من 200</span>

                              </td>
                              <td>
                                <span v-if="company_service_order.age_group == 1">15-18</span>
                                <span v-if="company_service_order.age_group == 2">19-24</span>
                                <span v-if="company_service_order.age_group == 3">25-35</span>
                                <span v-if="company_service_order.age_group == 4">أخرى</span>
                              </td>

                              <td>
                             <span>{{company_service_order.training_time}}</span>
                              </td>
                            </tr>
                            </tbody>
                            </v-simple-table>
                        </v-card>
                      </v-card-text>
                      <v-divider></v-divider>
                    </v-card>
                  </v-col>
                  <v-col cols="12" md="12">
                    <v-card class="h-full d-flex flex-column">
                      <v-card-title class="font-weight-bold">
                        <div class="flex-grow-1 text-truncate">
                           وصف الخدمة الطلوبة
                          <v-divider class="mt-3"></v-divider>
                        </div>
                      </v-card-title>
                      <v-card-text class="flex-grow-1">
                        {{company_service_order.service_description}}
                      </v-card-text>
                      <v-divider></v-divider>
                    </v-card>
                  </v-col>
                </v-row>
              </v-container>
            </v-card-text>
          </v-card>
        </v-col>
      </v-row>
    </v-container>
  </div>


</template>

<script>
export default {
  name: "Show",
  props: {
    company_service_order: Object
  },
  data() {
    return {
      accept_progress: false,
      reject_progress: false,
      service_order_items: [
        {
          name: 'اسم المؤوسسة',
          icon: 'mdi-rename',
          text: this.company_service_order.company_name
        },
        {
          name: 'مجال العمل  ',
          icon: 'mdi-rename',
          text: this.company_service_order.employment_filed
        },  {
          name: 'السلوجن  ',
          icon: 'mdi-tag-text',
          text: this.company_service_order.slugn
        }, {
          name: 'مسؤول التواصل  ',
          icon: 'mdi-account',
          text: this.company_service_order.communication_officer
        }, {
          name: '  رقم الواتس اب',
          icon: 'mdi-whatsapp',
          text: this.company_service_order.whatsapp_number
        }, {
          name: 'البريد الإلكتروني  ',
          icon: 'mdi-email',
          text: this.company_service_order.email
        }, {
          name: 'الدولة  ',
          icon: 'mdi-home',
          text: this.company_service_order.country.name_ar
        }, {
          name: 'المدينة  ',
          icon: 'mdi-home-city',
          text: this.company_service_order.city
        }, {
          name: 'العنوان  ',
          icon: 'mdi-rename',
          text: this.company_service_order.company_name
        }, {
          name: 'اسم المؤوسسة',
          icon: 'mdi-office-building-marker',
          text: this.company_service_order.address
        },
      ],
      service_order: [
        {text: 'إسم الخدمة ', value: 'name'},
        {text: 'الفئة المستهدفة', value: 'category'},
        {text: 'العدد المستهدف', value: 'target_number'},
        {text: 'الفئة العمرية', value: 'age_group'},
        {text: 'مدة التدريب ', value: 'training_time'},

      ],

    }
  },
  methods: {
     redirect_url(url) {
      window.open(url);
    }
  }
}
</script>


<style lang="scss">
.table, th, .table td {
  border: 1px solid #fff;
  font-weight: 400;
}

.table {
  border-collapse: separate;
  border-spacing: 0px;
  border-width: 1px 0 0 1px;
  margin-bottom: 24px;
  width: 100%;
  font-size: 14px;
  text-align: right;

  td {
    border-width: 0 1px 1px 0;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
  }

  td, th {
    padding: 10px 8px;
  }

  thead th {
    color: #cb1800 !important;
    border-bottom: 1px solid rgba(0, 0, 0, 0.1);
    font-weight: 500;
  }
}

.btn {
  padding: 9px 25px;
  border-radius: 4px;
  font-size: 14px;

  &.btn-small {
    padding: 8px 8px;
    font-size: 12px;
  }
}

.btn-primary {
  background-color: #cb1800;
  color: #FFF;
}

.btn-success {
  background-color: #00cb00;
  color: #FFF;
}

.btn-danger {
  background-color: #ff1e00;
  color: #FFF;
}

.h-60 {
  height: 60px;
}

.col-border-bottom {
  border-bottom: 1px solid #EEE;
}

.v-card__title {
  color: black !important;

}
</style>
