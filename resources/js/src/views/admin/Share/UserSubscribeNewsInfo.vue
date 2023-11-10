<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>
          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                تفاصيل المشتركين بالنشرة البريدية
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
                    :items="user_subscribe_info"
                    :search="search"
                    class="elevation-1"
                    sort-by="calories"

                  >
                    <template v-slot:top>
                      <v-toolbar
                        flat
                      >
                        <v-toolbar-title>المشتركين</v-toolbar-title>

                      </v-toolbar>
                    </template>
                    <template v-slot:no-data>
                      <div
                        color="primary"
                      >
                        لا يوجد بيانات
                      </div>
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
    user_subscribe_info: Array
  },
  data() {
    return {
      headers: [
        {text: 'البريد الإلكتروني', value: 'email'},
        {text: 'تاريخ الإشتراك', value: 'created_at'},
      ],
    }
  }
}
</script>
