<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                طلبات الغاء الشراكة
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
                    :items="cancel_order_requests"
                    class="elevation-1"
                    sort-by="calories"
                  >
                    <template v-slot:top>
                      <v-toolbar
                        flat
                      >
                        <v-toolbar-title> طلبات الغاء الشراكة</v-toolbar-title>
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
                      <v-chip v-if="item.status==4 && item.cancel_order_request == 1"
                              class="font-weight-medium" color="green" small>مقبول
                      </v-chip>
                      <v-chip v-if="item.status!=4 && item.cancel_order_request == 0"
                              class="font-weight-medium" color="red" small> مرفوض
                      </v-chip>
                      <v-chip v-if="item.status!=4 && item.cancel_order_request == 1"
                              class="font-weight-medium" color="blue" small>قيد الدراسة
                      </v-chip>

                    </template>


                    <template #[`item.actions`]="{item}">
                      <v-tooltip bottom color="blue">
                        <template v-slot:activator="{ on, attrs }">
                         <span v-bind="attrs" v-on="on">
                          <v-icon
                            class="mr-2"
                            color="blue"
                            @click="$inertia.get('/admin/partner_order_info/' + item.id)">
                         mdi-eye
                        </v-icon>
                        </span>
                        </template>
                        <span>  عرض بيانات الشريك </span>
                      </v-tooltip>
                      <v-tooltip v-if="item.status!=4 && item.cancel_order_request == 1" bottom
                                 color="green">
                        <template v-slot:activator="{ on, attrs }">
                          <v-icon
                            class="mr-2" color="green" v-bind="attrs"
                            @click="change_status(item ,1)"
                            v-on="on"
                          >
                            mdi-call-made
                          </v-icon>
                        </template>
                        <span>  قبول </span>
                      </v-tooltip>
                      <v-tooltip v-if="item.status!=4 && item.cancel_order_request== 1" bottom
                                 color="red">
                        <template v-slot:activator="{ on, attrs }">
                          <v-icon
                            class="mr-2"
                            color="red"
                            v-bind="attrs"
                            @click="change_status(item ,2)" v-on="on"
                          >
                            mdi-close-outline
                          </v-icon>
                        </template>
                        <span>  رفض </span>
                      </v-tooltip>


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
    cancel_order_requests: Array
  },
  data() {
    return {
      dialog: false,
      dialogDelete: false,
      editMode: false,
      form: this.$inertia.form({
        id: null
      }),
      headers: [
        {text: 'إسم المؤسسة', value: 'company_name'},
        {text: 'مجال العمل', value: 'employment_filed'},
        {text: 'مسؤول التواصل', value: 'communication_officer'},
        {text: 'رقم الواتس اب', value: 'whatsapp_number'},
        {text: 'الدولة', value: 'country.name_ar'},
        {text: 'الحالة', value: 'status'},
        {text: 'إجراءات', value: 'actions'},
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
            this.$inertia.post('/admin/partner/cancel_partner_order/' + item.id + '/change_status/' + status)
          }
        });
    },
  }

}
</script>
