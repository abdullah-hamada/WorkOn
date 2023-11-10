<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>

          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                تفاصيل الخدمات
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
                    :items="services"
                    :search="search"
                    class="elevation-1"
                    sort-by="calories">
                    <template v-slot:top>
                      <v-toolbar
                        flat
                      >
                        <v-toolbar-title>الخدمات</v-toolbar-title>
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
                          label="البحث عن خدمة"
                          single-line
                        ></v-text-field>

                        <template>
                          <Link
                            class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg v-size--default "
                            dark
                            href="/admin/services/create"
                            style="background-color: #0007a5;  color: white;"
                          >
                            إضافة خدمة جديدة
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
                    <template #[`item.status`]="{item}">
                      <v-chip v-if="item.status == 0"
                              class="font-weight-medium"
                              color="red"
                              small>
                        مجمد
                      </v-chip>
                      <v-chip v-if="item.status == 1"
                              class="font-weight-medium"
                              color="green"
                              small>
                        مفعل
                      </v-chip>
                    </template>
                    <template #[`item.image`]="{item}">
                      <img :src="item.preview_image"
                           style="margin: 10px; border-radius: 49px; height: 48px; width: 58px;">
                    </template>

                    <template #[`item.actions`]="{item}">
                      <v-tooltip bottom color="green">
                        <template v-slot:activator="{ on, attrs }">
                          <span v-bind="attrs" v-on="on">
                          <v-icon v-if="item.status==0"
                                  class="mr-2"
                                  color="green"
                                  @click="change_status(item)">
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
                                  @click="change_status(item)">
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
                          @click="editItem(item)">
                     {{ mdiAccountEdit }}
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
    services: Array
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
      headers: [
        // {text: 'الصورة', value: 'image'},
        {text: 'الإسم', value: 'name'},
        {text: 'الصورة', value: 'image'},

        {text: 'تاريخ الإنشاء', value: 'created_at'},
        {text: '  الحالة', value: 'status'},
        {text: 'إجراءات', value: 'actions'},
      ],
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
      this.form.delete('/admin/services/' + this.form.id, {
        onSuccess: page => {
          this.dialogDelete = false
        },
      })
    },
    editItem(item) {
      this.$inertia.get('/admin/services/' + item.id + '/edit')
    },
    change_status(item) {
      this.$inertia.post('/admin/services/change_status/' + item.id)
    },
  },
}
</script>
