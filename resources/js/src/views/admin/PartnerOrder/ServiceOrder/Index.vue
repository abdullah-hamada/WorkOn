<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                طلبات الخدمات
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
                    :headers="headers"
                    :items="service_orders"
                    class="elevation-1"
                    sort-by="calories"
                  >
                    <template v-slot:top>
                      <v-toolbar
                        flat
                      >
                        <v-toolbar-title> طلبات الخدمات
                        </v-toolbar-title>
                        <v-divider
                          class="mx-4"
                          inset
                          vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                      </v-toolbar>
                    </template>
                    <template v-slot:no-data>
                      <v-btn
                        color="primary"
                        @click="initialize"
                      >
                        لا يوجد بيانات
                      </v-btn>
                    </template>

                    <template #[`item.status`]="{item}">
                      <v-chip v-if="item.status==3" class="font-weight-medium" color="blue" small>
                        قيد الدراسة
                      </v-chip>
                      <v-chip v-if="item.status==2" class="font-weight-medium" color="red" small>
                        مرفوض
                      </v-chip>
                      <v-chip v-if="item.status==1" class="font-weight-medium" color="green" small>
                        مقبول
                      </v-chip>
                    </template>


                    <template #[`item.created_at`]="{item}">
                   <span>{{ item.created_at }}
                   بتوقيت {{ time_zone }}
                   </span>
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

export default {
  props: {
    service_orders: Array, time_zone: String

  },
  data() {
    return {
      headers: [
        {text: 'إسم الخدمة', value: 'service.name'},
        {text: 'إسم  طالب الخدمة', value: 'user.name'},
        {text: 'البريد الالكتروني', value: 'user.email'},
        {text: 'رقم الواتس اب', value: 'user.whatsapp_number'},
        {text: 'إسم  مقدم الخدمة', value: 'partner.company_name'},

        {text: 'تاريخ طلب الخدمة', value: 'created_at'},
        {text: 'الحالة', value: 'status'},

      ],
    }
  },
  methods: {
    change_status(item, status) {
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
      })
        .then((result) => {
          if (result == 1) {
            this.$inertia.post('/dashboard/partner/service_order/' + item.id + '/change_status/' + status)
          }
        });
    },
  }


}
</script>
