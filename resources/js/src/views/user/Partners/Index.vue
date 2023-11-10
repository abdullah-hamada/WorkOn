<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                شركاء وورك نت
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
                        <v-toolbar-title> شركاء وورك نت</v-toolbar-title>
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

                    <template #[`item.actions`]="{item}">
                      <v-tooltip bottom color="blue">
                        <template v-slot:activator="{ on, attrs }">
                         <span v-bind="attrs" v-on="on">
                          <v-icon
                            class="mr-2"
                            color="blue"
                            @click="$inertia.get('/dashboard/user/show_partner/' + item.id)">
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
        {text: 'عرض بيانات الشريك', value: 'actions'},
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
