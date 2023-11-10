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
                    بيانات الشريك (
                    {{ partner_order.company_name }}
                    )
                  </h4>
                </v-col>
                <v-col
                  cols="auto">
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
                              :src="`/get_file/partner_logo/${partner_order.logo}`"/>
                          </v-avatar>
                          <div class="text-center mt-2">
                            <span class="font-weight-bold text-body-2">
                             {{ partner_order.company_name }}
                              </span>
                          </div>
                          <v-chip class="font-weight-bold mt-2" color="accent">
                            شريك مجتمع وورك نت
                          </v-chip>
                          <v-row class="mt-3" dense>
                            <v-col
                              cols="12"
                              lg="2"
                              md="8"
                            >
                              <a
                                :href="this.partner_order.webiste_url  "
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
                                :href="this.partner_order.facebook_url  "
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
                                :href="this.partner_order.instagram_url  "
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
                                :href="this.partner_order.linkedin_url  "
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
                                :href="this.partner_order.twitter_url  "
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
                          <v-chip v-for="item in partner_order_items" :key="item" class="ml-2 mb-2"
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
                          <h3 class="black--text">{{ partner_order.company_info }}</h3>

                        </div>
                        <div>
                          <v-container fluid>
                            <v-row dense>
                              <v-col
                                v-for="(stat, index) in stats"
                                :key="index"
                                cols="12"
                                lg="4"
                                md="12">
                                <v-card class="pa-3 text-center">
                                  <div class="text-h6  mb-3">fg</div>
                                  <div class="overline  mb-3"
                                       style="    font-size: 17px !important;">gfgfgf
                                  </div>
                                </v-card>
                              </v-col>
                            </v-row>
                          </v-container>
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
                          فروع الشريك
                          <v-divider class="mt-3"></v-divider>
                        </div>
                      </v-card-title>
                      <v-card-text class="flex-grow-1">
                        <v-card>
                          <v-data-table
                            :headers="branch_headers"
                            :hide-default-footer="true"
                            :items="partner_order.branches"

                            class="flex-grow-1">
                            <template #[`item.location`]="{item}">
                              <v-tooltip v-if="item.location" bottom color="blue">
                                <template v-slot:activator="{ on, attrs }">
                                       <span v-bind="attrs" v-on="on">
                                           <v-icon
                                             color="blue"
                                             @click="redirect_url(item.location)"
                                           >
                                             mdi-eye
                                    </v-icon>
                                        </span>
                                </template>
                                <span>  عرض  اللوكيشن  </span>
                              </v-tooltip>
                              <span v-else>لا يوجد</span>
                            </template>

                            <template #[`item.name`]="{item}">
                              <span v-if="item.name">{{ item.name }}  </span>
                              <span v-else>لا يوجد</span>
                            </template>
                            <template #[`item.address`]="{item}">
                              <span v-if="item.address">{{ item.address }}  </span>
                              <span v-else>لا يوجد</span>
                            </template>
                          </v-data-table>
                        </v-card>
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
                          خدمات الشريك
                          <v-divider class="mt-3"></v-divider>
                        </div>
                      </v-card-title>
                      <v-card-text class="flex-grow-1">
                        <v-card>
                          <v-data-table
                            :headers="services_headers"
                            :hide-default-footer="true"
                            :items="partner_order.services"

                            class="flex-grow-1">
                            <template #[`item.order_request`]="{item}">
                              <v-btn :disabled="progress" class="btn btn-primary btn-small"
                                     color="primary "
                                     @click="request_service_order(item.id)">طلب الخدمة
                              </v-btn>

                            </template>
                            <template #[`item.final_price`]="{item}">
                              <span  >{{ item.final_price }} دولار </span>
                            </template>

                          </v-data-table>
                        </v-card>
                      </v-card-text>
                      <v-divider></v-divider>
                    </v-card>
                  </v-col>

                </v-row>
                <v-col cols="12">
                  <h3 class="red--text"> جميع البيانات المذكورة أعلاه هي تحت مسؤولية الشريك</h3>
                </v-col>
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
    partner_order: Object
  },
  data() {
    return {
      progress: false,
      partner_order_items: [
        {
          name: 'اسم المؤوسسة',
          icon: 'mdi-rename',
          text: this.partner_order.company_name
        },
        {
          name: 'مجال العمل  ',
          icon: 'mdi-rename',
          text: this.partner_order.company_name
        }, {
          name: 'التصنيف  ',
          icon: 'mdi--format-list-numbered-rtl',
          text: this.partner_order.category.name
        }, {
          name: 'السلوجن  ',
          icon: 'mdi-tag-text',
          text: this.partner_order.slugn
        }, {
          name: 'مسؤول التواصل  ',
          icon: 'mdi-account',
          text: this.partner_order.communication_officer
        }, {
          name: '  رقم الواتس اب',
          icon: 'mdi-whatsapp',
          text: this.partner_order.whatsapp_number
        }, {
          name: 'البريد الإلكتروني  ',
          icon: 'mdi-email',
          text: this.partner_order.email
        }, {
          name: 'الدولة  ',
          icon: 'mdi-home',
          text: this.partner_order.country.name_ar
        }, {
          name: 'المدينة  ',
          icon: 'mdi-home-city',
          text: this.partner_order.city
        }, {
          name: 'العنوان  ',
          icon: 'mdi-rename',
          text: this.partner_order.company_name
        }, {
          name: 'اسم المؤوسسة',
          icon: 'mdi-office-building-marker',
          text: this.partner_order.address
        },
      ],

      branch_headers: [
        {text: 'إسم الفرع', value: 'name'},
        {text: 'مكان الفرع', value: 'address'},
        {text: 'لوكيشن الفرع', value: 'location'},
      ],

      services_headers: [
        {text: 'إسم الخدمة', value: 'name'},
        {text: 'سعر الخدمة', value: 'price'},
        {text: 'نسبة الخصم  ', value: 'discount'},
        {text: 'السعر النهائي    ', value: 'final_price'},
        {text: 'طلب الخدمة ', value: 'order_request'},


      ],
    }
  },
  methods: {
    order_change_status(status) {
      swal({
        title: 'تنويه',
        text: 'هل أنت متأكد من ها الاجراء؟',
        icon: 'warning',
        buttons: {
          button1: {
            text: 'لا',
            value: 2
          },
          button2: {
            text: 'نعم',
            value: 1
          }
        },
        timer: 9000,
      }).then((result) => {
        if (result == 1) {
          if (status == 1) {
            this.accept_progress = true
          } else {
            this.reject_progress = true
          }
          this.$inertia.get('/admin/partner/change_status/' + this.partner_order.id + '/' + status, {
            onSuccess: page => {
              if (status == 1) {
                this.accept_progress = false
              } else {
                this.reject_progress = false
              }
            },
          })

        }
      });

    },
    request_service_order(id) {
      this.progress = true
      this.$inertia.post('/dashboard/user/request_service_order/' + id, '', {
        onSuccess: () => {
          this.progress = false
        }
      })
    },
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
