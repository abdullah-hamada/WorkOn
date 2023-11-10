<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>
          <v-toolbar class="header_title" color="primary" dark>
            <v-row class="justify-space-between  px-2 px-lg-3">
              <v-col>
                تفاصيل المستخدمين
              </v-col>
              <v-col cols="auto">
                <div class="d-flex align-center ml-3">
                  <v-tooltip bottom color="blue">
                    <template v-slot:activator="{ on, attrs }">
                       <span v-bind="attrs" v-on="on">
                         <a class="text-decoration-none" href="/admin/export_users">
                          <v-icon style="font-size: 29px">
                            mdi-microsoft-excel
                          </v-icon>
                        </a>
                      </span>
                    </template>
                    <span>  تصدير بيانات المستخدمين </span>
                  </v-tooltip>
                </div>
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
                    :items="users"
                    :search="search"
                    item-key="id"
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
                                    اسم المستخدم :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.name }}
                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    البريد الالكتروني :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.email }}

                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    رقم الواتس اب :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.whatsapp_number }}

                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    دولة المستخدم :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.country.name_ar }}

                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    تخصص المستخدم :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.category ? item.category.name_ar : '' }}

                                  </v-col>
                                </v-row>
                              </v-col>
                              <v-col cols="12" lg="6">
                                <v-row dense>
                                  <v-col class="py-6 font-weight-bold" lg="6">
                                    عدد الدورات المشترك بها :
                                  </v-col>
                                  <v-col class="py-6" lg="6">
                                    {{ item.courses_count }}

                                  </v-col>
                                </v-row>
                              </v-col>
                            </v-row>
                          </v-col>
                        </v-row>
                      </td>
                    </template>
                    <template v-slot:top>
                      <v-toolbar
                        flat
                      >
                        <v-toolbar-title>المستخدمين</v-toolbar-title>
                        <v-divider
                          class="mx-4"
                          inset
                          vertical
                        ></v-divider>
                        <v-spacer></v-spacer>
                        <v-text-field
                          v-model="search"
                          append-icon="mdi-magnify"
                          class="ml-3"
                          hide-details
                          label="البحث عن مستخدم"
                          single-line
                        ></v-text-field>

                        <template>
                          <Link
                            class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg v-size--default "
                            dark
                            href="/admin/users/create"
                            style="background-color: #0007a5;  color: white;"
                          >
                            إضافة مستخدم جديد
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
                    <template #[`item.role`]="{item}">
                      <v-chip
                        :color="get_color(item.roles[0]['name'])"
                        class="font-weight-medium"
                        small
                      >
                        {{ item.roles[0]['name'] }}
                      </v-chip>
                    </template>
                    <template #[`item.status`]="{item}">
                      <v-chip v-if="item.status == 0"
                              class="font-weight-medium"
                              color="red"
                              small
                      >
                        مجمد
                      </v-chip>

                      <v-chip v-if="item.status == 1"
                              class="font-weight-medium"
                              color="green"
                              small
                      >
                        مفعل
                      </v-chip>
                    </template>
                    <template #[`item.actions`]="{item}">
                      <v-tooltip bottom color="green">
                        <template v-slot:activator="{ on, attrs }">
                         <span v-bind="attrs" v-on="on">
                           <v-icon v-if="item.status==0"
                                   class="mr-2"
                                   color="green"
                                   @click="change_status(item)"
                           >
                           mdi-call-made
                        </v-icon>
                        </span>
                        </template>
                        <span>  تفعيل </span>
                      </v-tooltip>

                      <v-tooltip bottom color="red">
                        <template v-slot:activator="{ on, attrs }">
                             <span v-bind="attrs" v-on="on">
                              <v-icon v-if="item.status==1"
                                      class="mr-2"
                                      color="red"
                                      @click="change_status(item)"
                              >
                          mdi-close-outline
                        </v-icon>
                            </span>
                        </template>
                        <span>  تجميد </span>
                      </v-tooltip>
                      <v-tooltip bottom color="blue">
                        <template v-slot:activator="{ on, attrs }">
                             <span v-bind="attrs" v-on="on">
                              <v-icon
                                class="mr-2"
                                color="blue"
                                @click="editItem(item)"
                              >
                          {{ mdiAccountEdit }}
                        </v-icon>
                            </span>
                        </template>
                        <span>  تعديل </span>
                      </v-tooltip>
                      <v-tooltip bottom color="#ff3bea">
                        <template v-slot:activator="{ on, attrs }">
                           <span v-bind="attrs" v-on="on">
                            <v-icon
                              class="mr-2"
                              color="#ff3bea"
                              @click="showItem(item)"
                            >
                       mdi-eye
                      </v-icon>
                          </span>
                        </template>
                        <span>  عرض  بيانات المستخدم </span>
                      </v-tooltip>
                      <v-tooltip bottom color="red">
                        <template v-slot:activator="{ on, attrs }">
                             <span v-bind="attrs" v-on="on">
                               <v-icon
                                 color="red"
                                 @click="deleteItem(item)"
                               >
                          {{ mdiDeleteOutline }}
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
import {mdiAccountEdit, mdiDeleteOutline, mdiDotsVertical, mdiSquareEditOutline} from '@mdi/js'

export default {
  props: {
    users: Array
  },
  data() {
    return {
      subscribe_dialog: false,
      mdiDeleteOutline: mdiDeleteOutline,
      mdiAccountEdit: mdiAccountEdit,
      search: '',
      dialog: false,
      dialogDelete: false,
      editMode: false,
      form: this.$inertia.form({
        id: null
      }),
      statusColor: {
        /* eslint-disable key-spacing */
        Current: 'primary',
        Professional: 'success',
        Rejected: 'error',
        Resigned: 'warning',
        Applied: 'info',
        /* eslint-enable key-spacing */
      },
      headers: [
        {text: 'الإسم', value: 'name'},
        {text: 'البريد الإلكتروني', value: 'email'},
        {text: 'رقم الواتس اب', value: 'whatsapp_number'},
        {text: 'الدور', value: 'role'},
        {text: 'تاريخ الإنشاء', value: 'created_at'},
        {text: '  الحالة', value: 'status'},
        {text: 'إجراءات', value: 'actions'},
      ],
      status: {
        1: 'Current',
        2: 'Professional',
        3: 'Rejected',
        4: 'Resigned',
        5: 'Applied',
      },
      icons: {
        mdiSquareEditOutline,
        mdiDotsVertical,
      },
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
      this.form.delete('/admin/users/' + this.form.id, {
        onSuccess: page => {
          this.dialogDelete = false
        },
      })
    },
    editItem(item) {
      this.$inertia.get('/admin/users/' + item.id + '/edit')
    },
    get_color(role) {
      return role == 'user' ? '#9155fd' : 'blue';

    },
    change_status(item) {
      this.$inertia.post('/admin/user/change_status/' + item.id)
    },
    showItem(item) {
      this.$inertia.get('/admin/users/' + item.id)

    },
    rowClick(item, row) {
      this.$inertia.get('/admin/users/' + item.id)

    },
    ShowDialogSubscribeItem() {
      this.subscribe_dialog = true

    },
    close_subscribe_dialog() {
      this.subscribe_dialog = false
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
