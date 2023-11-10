<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                تفاصيل الرسائل التحفيزية
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
                    :items="messages"
                    :search="search"
                    class="elevation-1"
                    sort-by="calories"
                  >
                    <template v-slot:top>
                      <v-toolbar
                        flat
                      >
                        <v-toolbar-title>الرسائل</v-toolbar-title>
                        <v-divider
                          class="mx-4"
                          inset
                          vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                        <template>
                          <Link
                            class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg v-size--default "
                            dark
                            href="/admin/motivational_message/create"
                            style="background-color: #0007a5;  color: white;"
                          >
                            إضافة رسالة جديد
                          </Link>

                        </template>
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

                    <template #[`item.actions`]="{item}">
                      <v-tooltip bottom color="blue">
                        <template v-slot:activator="{ on, attrs }">
                         <span v-bind="attrs" v-on="on">
                      <v-icon
                        class="mr-2"
                        color="blue"
                        @click="editItem(item)"
                      >
                       mdi-account-edit
                      </v-icon>
                          </span>
                        </template>
                        <span>  تعديل </span>
                      </v-tooltip>
                      <v-tooltip bottom color="red">
                        <template v-slot:activator="{ on, attrs }">
                       <span v-bind="attrs" v-on="on">
                         <v-icon
                           color="red"
                           @click="deleteItem(item)"
                         >
                            mdi-delete-outline
                      </v-icon>
                         </span>
                        </template>
                        <span>  حذف </span>
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
    messages: Array
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
        {text: 'العنوان', value: 'title'},
        {text: 'تاريخ الإنشاء', value: 'created_at'},
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
      this.form.delete('/admin/motivational_message/' + this.form.id, {
        onSuccess: page => {
          this.dialogDelete = false
        },
      })
    },
    editItem(item) {
      this.$inertia.get('/admin/motivational_message/' + item.id + '/edit')
    },
    get_color(role) {
      return role == 'user' ? '#9155fd' : 'blue';

    },
    change_status(item) {
      this.$inertia.post('/admin/motivational_message/change_status/' + item.id)
    },
    showItem(item) {
      this.$inertia.get('/admin/motivational_message/' + item.id)

    }

  },

}
</script>
