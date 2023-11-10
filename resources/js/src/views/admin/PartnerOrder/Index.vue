<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                طلبات الشراكة
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
                    :items="partners_order"
                    class="elevation-1"
                    sort-by="calories"
                  >
                    <template v-slot:top>
                      <v-toolbar
                        flat
                      >
                        <v-toolbar-title> طلبات الشراكة</v-toolbar-title>
                        <v-divider
                          class="mx-4"
                          inset
                          vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                        <v-dialog v-model="dialogDelete" max-width="500px">
                          <v-card>
                            <v-card-title class="text-h5"> هل أنت متأكد من الحذف؟
                            </v-card-title>
                            <v-card-actions>
                              <v-spacer></v-spacer>
                              <v-btn color="blue darken-1" text @click="closeDelete">إلغاء</v-btn>
                              <v-btn :loading="form.processing" color="blue darken-1"
                                     text @click="deleteItemConfirm">حفظ
                              </v-btn>
                              <v-spacer></v-spacer>
                            </v-card-actions>
                          </v-card>
                        </v-dialog>
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
                      <v-chip v-if="item.status==4" class="font-weight-medium" color="red" small>تم
                        الغاء الشراكة
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
    partners_order: Array
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
    closeDelete() {
      this.dialogDelete = false
    },
    deleteItem(item) {
      this.form.id = item.id
      this.dialogDelete = true

    },
    deleteItemConfirm() {
      this.form.delete('/admin/categories/' + this.form.id, {
        onSuccess: page => {
          this.dialogDelete = false
        },
      })
    },
    editItem(item) {
      this.$inertia.get('/admin/categories/' + item.id + '/edit')
    },
    get_color(role) {
      return role == 'user' ? '#9155fd' : 'blue';
    },
  },

}
</script>
