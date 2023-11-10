<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>
          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                التحكم بالصفحة الرئيسية
              </h3>
              <v-col style="padding-left:20px">
              </v-col>
            </v-row>
          </v-toolbar>
          <v-form class="multi-col-validation" @submit.prevent="submit">
            <v-card-text class="grey lighten-5 mt-3">
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center mb-3">
                      <v-card-title>التحكم بالهيدر</v-card-title>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row v-for="(item,index) in form.header_items" :key="index">

                          <v-col
                            cols="3">
                            <v-text-field
                              v-model="item.title"
                              :error-messages="$page.props.errors['header_items.' + index + '.title']"
                              dense
                              label="العنوان"
                              outlined
                              placeholder="العنوان"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="3">
                            <v-text-field
                              v-model="item.order"
                              :error-messages="$page.props.errors['header_items.' + index + '.order']"
                              dense
                              label="الترتيب"
                              outlined
                              placeholder="الترتيب"
                              prepend-inner-icon="mdi-order-numeric-descending"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="3">
                            <v-text-field
                              v-model="item.url"
                              :error-messages="$page.props.errors['header_items.' + index + '.url']"
                              dense
                              label="الرابط"
                              outlined
                              placeholder="الرابط"
                              prepend-inner-icon="mdi-link-variant"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="2"
                          >
                            <v-btn
                              class="mb-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                              color="red"
                              dark
                              @click="deleteItem(index)"
                            >
                              <v-icon>
                                mdi-delete-forever

                              </v-icon>
                              حذف
                            </v-btn>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>

              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center  mb-3">
                      <v-card-title>التحكم بالسلايدر</v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_slider_item"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة سلايدر جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row v-for="(item,index) in form.slider_items" :key="index">

                          <div class="image-input mb-2">
                            <div
                              :style="
                                  item.preview_image != undefined
                                    ? { 'background-image': `url(${item.preview_image})` }
                                    : { 'background-image': `url(${item.preview_image})` }
                                "
                              class="image-input-wrapper"
                            ></div>

                            <label class="btn-icon btn-add" data-original-title="Change avatar">
                              <svg
                                height="12"
                                viewBox="0 0 512 512"
                                width="12"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                  fill="#6e6d6d"/>
                              </svg>
                              <input
                                accept=".png, .jpg, .jpeg ,.svg"
                                name="profile_avatar"
                                type="file"
                                @change="previewSliderImage($event , index)"
                              />

                              <input name="profile_avatar_remove" type="hidden"/>
                            </label>
                          </div>
                          <div v-if="$page.props.errors['slider_items.' + index + '.image']"
                               class="error--text">
                            {{ $page.props.errors['slider_items.' + index + '.image'] }}
                          </div>

                          <v-col
                            cols="2"
                          >

                            <v-textarea
                              v-model="item.title"
                              :error-messages="$page.props.errors['slider_items.' + index + '.title']"
                              label="العنوان"
                              outlined
                              prepend-inner-icon="mdi-format-title"
                              rows="1"
                            ></v-textarea>
                          </v-col>
                          <v-col
                            cols="4"
                          >

                            <v-textarea
                              v-model="item.paragraph"
                              :error-messages="$page.props.errors['slider_items.' + index + '.paragraph']"
                              label="الفقرة"
                              outlined
                              prepend-inner-icon="mdi-comment"
                              rows="1"
                            ></v-textarea>
                          </v-col>
                          <v-col
                            cols="2"
                          >
                            <v-text-field
                              v-model="item.button_text"
                              :error-messages="$page.props.errors['slider_items.' + index + '.button_text']"
                              dense
                              label="عنوان الزر"
                              outlined
                              placeholder="عنوان الزر"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="2"
                          >
                            <v-text-field
                              v-model="item.button_url"
                              :error-messages="$page.props.errors['slider_items.' + index + '.button_url']"
                              dense
                              label="رابط الزر"
                              outlined
                              placeholder="رابط الزر"
                              prepend-inner-icon="mdi-button-cursor"
                            ></v-text-field>
                          </v-col>

                          <v-btn
                            class="mt-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                            color="red"
                            dark
                            @click="deleteSliderItem(index)"
                          >حذف
                          </v-btn>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>


              <!--              <v-row class="match-height">-->
              <!--                <v-col-->
              <!--                  cols="12"-->
              <!--                  md="12"-->
              <!--                >-->
              <!--                  <v-card>-->
              <!--                    <div class="d-flex justify-space-between align-center mb-3">-->
              <!--                      <v-card-title>التحكم بالسيكشن الأول</v-card-title>-->
              <!--                    </div>-->
              <!--                    <v-card-text>-->
              <!--                      <div id="rows">-->
              <!--                        <div class="text-center  mb-5">-->
              <!--                          <div class="image-input">-->
              <!--                            <div-->
              <!--                              :style="-->
              <!--                                  form.section_one_item.preview_image != undefined-->
              <!--                                    ? { 'background-image': `url(${ form.section_one_item.preview_image})` }-->
              <!--                                    : { 'background-image': `url(${ form.section_one_item.preview_image})` }-->
              <!--                                "-->
              <!--                              class="image-input-wrapper"-->
              <!--                            ></div>-->

              <!--                            <label class="btn-icon btn-add" data-original-title="Change avatar">-->
              <!--                              <svg-->
              <!--                                height="12"-->
              <!--                                viewBox="0 0 512 512"-->
              <!--                                width="12"-->
              <!--                                xmlns="http://www.w3.org/2000/svg"-->
              <!--                              >-->
              <!--                                <path-->
              <!--                                  d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"-->
              <!--                                  fill="#6e6d6d"/>-->
              <!--                              </svg>-->
              <!--                              <input-->
              <!--                                accept=".png, .jpg, .jpeg"-->
              <!--                                name="profile_avatar"-->
              <!--                                type="file"-->
              <!--                                @change="previewSectionOneImage($event )"-->
              <!--                              />-->

              <!--                              <input name="profile_avatar_remove" type="hidden"/>-->
              <!--                            </label>-->
              <!--                          </div>-->
              <!--                        </div>-->
              <!--                        <v-row>-->

              <!--                          <v-col-->
              <!--                            cols="6">-->
              <!--                            <v-text-field-->
              <!--                              v-model="form.section_one_item.title"-->
              <!--                              :error-messages="$page.props.errors['section_one_item.title']"-->
              <!--                              dense-->
              <!--                              label="العنوان"-->
              <!--                              outlined-->
              <!--                              placeholder="العنوان"-->
              <!--                              prepend-inner-icon="mdi-format-title"-->
              <!--                            ></v-text-field>-->
              <!--                          </v-col>-->

              <!--                          <v-col-->
              <!--                            cols="3"-->
              <!--                          >-->
              <!--                            <v-text-field-->
              <!--                              v-model="form.section_one_item.button_text"-->
              <!--                              :error-messages="$page.props.errors['section_one_item.button_text']"-->
              <!--                              dense-->
              <!--                              label="عنوان الزر"-->
              <!--                              outlined-->
              <!--                              placeholder="عنوان الزر"-->
              <!--                              prepend-inner-icon="mdi-button-cursor"-->
              <!--                            ></v-text-field>-->
              <!--                          </v-col>-->
              <!--                          <v-col-->
              <!--                            cols="3"-->
              <!--                          >-->
              <!--                            <v-text-field-->
              <!--                              v-model="form.section_one_item.button_url"-->
              <!--                              :error-messages="$page.props.errors['section_one_item.button_url']"-->
              <!--                              dense-->
              <!--                              label="رابط الزر"-->
              <!--                              outlined-->
              <!--                              placeholder="رابط الزر"-->
              <!--                              prepend-inner-icon="mdi-button-cursor"-->
              <!--                            ></v-text-field>-->
              <!--                          </v-col>-->

              <!--                        </v-row>-->

              <!--                        <v-row>-->
              <!--                          <v-col-->
              <!--                            cols="12"-->
              <!--                          >-->
              <!--                            <v-textarea-->
              <!--                              v-model="form.section_one_item.paragraph"-->
              <!--                              :error-messages="$page.props.errors['section_one_item.paragraph']"-->
              <!--                              label="الفقرة"-->
              <!--                              outlined-->
              <!--                              prepend-inner-icon="mdi-comment"-->
              <!--                              rows="1"-->
              <!--                            ></v-textarea>-->
              <!--                          </v-col>-->
              <!--                        </v-row>-->
              <!--                      </div>-->
              <!--                    </v-card-text>-->
              <!--                  </v-card>-->
              <!--                </v-col>-->
              <!--              </v-row>-->
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center mb-3">
                      <v-card-title>التحكم بالسيكشن الثاني</v-card-title>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <div class="text-center  mb-5">
                          <div class="image-input">
                            <div
                              :style="
                                  form.section_two_item.preview_image != undefined
                                    ? { 'background-image': `url(${ form.section_two_item.preview_image})` }
                                    : { 'background-image': `url(${ form.section_two_item.preview_image})` }
                                "
                              class="image-input-wrapper"
                            ></div>

                            <label class="btn-icon btn-add" data-original-title="Change avatar">
                              <svg
                                height="12"
                                viewBox="0 0 512 512"
                                width="12"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                  fill="#6e6d6d"/>
                              </svg>
                              <input
                                accept=".png, .jpg, .jpeg ,.svg"
                                name="profile_avatar"
                                type="file"
                                @change="previewSectionTwoImage($event )"
                              />

                              <input name="profile_avatar_remove" type="hidden"/>
                            </label>
                          </div>
                        </div>
                        <v-row>
                          <v-col
                            cols="12">
                            <v-text-field
                              v-model="form.section_two_item.title"
                              :error-messages="$page.props.errors['section_two_item.title']"
                              dense
                              label="العنوان"
                              outlined
                              placeholder="العنوان"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                        </v-row>

                        <v-row>
                          <v-col
                            cols="12"
                          >
                            <v-textarea
                              v-model="form.section_two_item.paragraph"
                              :error-messages="$page.props.errors['section_two_item.paragraph']"
                              label="الفقرة"
                              outlined
                              prepend-inner-icon="mdi-comment"
                              rows="1"
                            ></v-textarea>
                          </v-col>
                        </v-row>
                        <v-row>
                          <v-col
                            cols="12">
                            <v-text-field
                              v-model="form.section_two_item.button_url"
                              :error-messages="$page.props.errors['section_two_item.button_url']"
                              dense
                              label="رابط الفيديو"
                              outlined
                              placeholder="رابط الفيديو"
                              prepend-inner-icon="mdi-link"
                            ></v-text-field>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <!--              <v-row class="match-height">-->
              <!--                <v-col-->
              <!--                  cols="12"-->
              <!--                  md="12"-->
              <!--                >-->
              <!--                  <v-card>-->
              <!--                    <div class="d-flex justify-space-between align-center  mb-3">-->
              <!--                      <v-card-title>التحكم بالسيكشن الثالث</v-card-title>-->
              <!--                      <v-btn-->
              <!--                        class="ml-3 v-btn v-btn&#45;&#45;is-elevated v-btn&#45;&#45;has-bg theme&#45;&#45;dark v-size&#45;&#45;default primary"-->
              <!--                        color="primary"-->
              <!--                        dark-->
              <!--                        @click="add_new_section_three_item"-->
              <!--                      >-->
              <!--                        <v-icon>-->
              <!--                          mdi-plus-->
              <!--                        </v-icon>-->
              <!--                        إضافة عنصر جديد-->
              <!--                      </v-btn>-->
              <!--                    </div>-->
              <!--                    <v-card-text>-->
              <!--                      <v-row>-->
              <!--                        <v-col-->
              <!--                          cols="12">-->
              <!--                          <v-text-field-->
              <!--                            v-model="form.section_three_item.title"-->
              <!--                            :error-messages="$page.props.errors['section_three_item.title']"-->
              <!--                            dense-->
              <!--                            label="العنوان"-->
              <!--                            outlined-->
              <!--                            placeholder="العنوان"-->
              <!--                            prepend-inner-icon="mdi-format-title"-->
              <!--                          ></v-text-field>-->
              <!--                        </v-col>-->

              <!--                      </v-row>-->
              <!--                      <v-row v-for="(item,index) in form.section_three_items" :key="index">-->
              <!--                        <div class="image-input mb-2">-->
              <!--                          <div-->
              <!--                            :style="-->
              <!--                                  item.preview_image != undefined-->
              <!--                                    ? { 'background-image': `url(${item.preview_image})` }-->
              <!--                                    : { 'background-image': `url(${item.preview_image})` }-->
              <!--                                "-->
              <!--                            class="image-input-wrapper"-->
              <!--                          ></div>-->

              <!--                          <label class="btn-icon btn-add" data-original-title="Change avatar">-->
              <!--                            <svg-->
              <!--                              height="12"-->
              <!--                              viewBox="0 0 512 512"-->
              <!--                              width="12"-->
              <!--                              xmlns="http://www.w3.org/2000/svg"-->
              <!--                            >-->
              <!--                              <path-->
              <!--                                d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"-->
              <!--                                fill="#6e6d6d"/>-->
              <!--                            </svg>-->
              <!--                            <input-->
              <!--                              accept=".png, .jpg, .jpeg"-->
              <!--                              name="profile_avatar"-->
              <!--                              type="file"-->
              <!--                              @change="previewSectionThreeImage($event , index)"-->
              <!--                            />-->

              <!--                            <input name="profile_avatar_remove" type="hidden"/>-->
              <!--                          </label>-->
              <!--                        </div>-->
              <!--                        <div v-if="$page.props.errors['section_three_items.' + index + '.image']"-->
              <!--                             class="error&#45;&#45;text">-->
              <!--                          {{ $page.props.errors['section_three_items.' + index + '.image'] }}-->
              <!--                        </div>-->
              <!--                        <v-col-->
              <!--                          cols="4">-->
              <!--                          <v-text-field-->
              <!--                            v-model="item.title"-->
              <!--                            :error-messages="$page.props.errors['section_three_items.'+index+'.title']"-->
              <!--                            dense-->
              <!--                            label="العنوان"-->
              <!--                            outlined-->
              <!--                            placeholder="العنوان"-->
              <!--                            prepend-inner-icon="mdi-format-title"-->
              <!--                          ></v-text-field>-->
              <!--                        </v-col>-->

              <!--                        <v-col-->
              <!--                          cols="4">-->
              <!--                          <v-text-field-->
              <!--                            v-model="item.sub_title"-->
              <!--                            :error-messages="$page.props.errors['section_three_items.'+index+'.sub_title']"-->
              <!--                            dense-->
              <!--                            label="العنوان الفرعي"-->
              <!--                            outlined-->
              <!--                            placeholder="العنوان الفرعي"-->
              <!--                            prepend-inner-icon="mdi-text-long"-->
              <!--                          ></v-text-field>-->
              <!--                        </v-col>-->

              <!--                        <v-btn-->
              <!--                          class="mt-3 v-btn v-btn&#45;&#45;is-elevated v-btn&#45;&#45;has-bg theme&#45;&#45;dark v-size&#45;&#45;default danger"-->
              <!--                          color="red"-->
              <!--                          dark-->
              <!--                          @click="deleteSectionThreeItem(index)"-->
              <!--                        >حذف-->
              <!--                        </v-btn>-->
              <!--                      </v-row>-->
              <!--                    </v-card-text>-->
              <!--                  </v-card>-->
              <!--                </v-col>-->
              <!--              </v-row>-->
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center mb-3">
                      <v-card-title>التحكم بالسيكشن الرابع</v-card-title>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <div class="text-center  mb-5">
                          <div class="image-input">
                            <div
                              :style="
                                  form.section_four_item.preview_image != undefined
                                    ? { 'background-image': `url(${ form.section_four_item.preview_image})` }
                                    : { 'background-image': `url(${ form.section_four_item.preview_image})` }
                                "
                              class="image-input-wrapper"
                            ></div>

                            <label class="btn-icon btn-add" data-original-title="Change avatar">
                              <svg
                                height="12"
                                viewBox="0 0 512 512"
                                width="12"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                  fill="#6e6d6d"/>
                              </svg>
                              <input
                                accept=".png, .jpg, .jpeg,.svg"
                                name="profile_avatar"
                                type="file"
                                @change="previewSectionFourImage($event )"
                              />

                              <input name="profile_avatar_remove" type="hidden"/>
                            </label>
                          </div>
                        </div>
                        <v-row>

                          <v-col
                            cols="6">
                            <v-text-field
                              v-model="form.section_four_item.title"
                              :error-messages="$page.props.errors['section_four_item.title']"
                              dense
                              label="العنوان"
                              outlined
                              placeholder="العنوان"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>

                          <v-col
                            cols="3"
                          >
                            <v-text-field
                              v-model="form.section_four_item.button_text"
                              :error-messages="$page.props.errors['section_four_item.button_text']"
                              dense
                              label="عنوان الزر"
                              outlined
                              placeholder="عنوان الزر"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="3"
                          >
                            <v-text-field
                              v-model="form.section_four_item.button_url"
                              :error-messages="$page.props.errors['section_four_item.button_url']"
                              dense
                              label="رابط الزر"
                              outlined
                              placeholder="رابط الزر"
                              prepend-inner-icon="mdi-button-cursor"
                            ></v-text-field>
                          </v-col>

                        </v-row>

                        <v-row>
                          <v-col
                            cols="12"
                          >
                            <v-textarea
                              v-model="form.section_four_item.paragraph"
                              :error-messages="$page.props.errors['section_four_item.paragraph']"
                              label="الفقرة"
                              outlined
                              prepend-inner-icon="mdi-comment"
                              rows="1"
                            ></v-textarea>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center  mb-3">
                      <v-card-title>التحكم بالسيكشن الخامس</v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_section_five_item"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة عنصر جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <v-row>
                        <v-col
                          cols="12">
                          <v-text-field
                            v-model="form.section_five_item.title"
                            :error-messages="$page.props.errors['section_five_item.title']"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>

                        <v-col
                          cols="12"
                        >
                          <v-textarea
                            v-model="form.section_five_item.paragraph"
                            :error-messages="$page.props.errors['section_five_item.paragraph']"
                            label="الفقرة"
                            outlined
                            prepend-inner-icon="mdi-comment"
                            rows="1"
                          ></v-textarea>
                        </v-col>


                      </v-row>
                      <v-row v-for="(item,index) in form.section_five_items" :key="index">
                        <div class="image-input mb-2">
                          <div
                            :style="
                                  item.preview_image != undefined
                                    ? { 'background-image': `url(${item.preview_image})` }
                                    : { 'background-image': `url(${item.preview_image})` }
                                "
                            class="image-input-wrapper"
                          ></div>

                          <label class="btn-icon btn-add" data-original-title="Change avatar">
                            <svg
                              height="12"
                              viewBox="0 0 512 512"
                              width="12"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                fill="#6e6d6d"/>
                            </svg>
                            <input
                              accept=".png, .jpg, .jpeg,.svg"
                              name="profile_avatar"
                              type="file"
                              @change="previewSectionFiveImage($event , index)"
                            />

                            <input name="profile_avatar_remove" type="hidden"/>
                          </label>
                        </div>
                        <div v-if="$page.props.errors['section_five_items.' + index + '.image']"
                             class="error--text">
                          {{ $page.props.errors['section_five_items.' + index + '.image'] }}
                        </div>
                        <v-col
                          cols="4">
                          <v-text-field
                            v-model="item.title"
                            :error-messages="$page.props.errors['section_five_items.'+index +'.title']"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>

                        <v-col
                          cols="4">
                          <v-text-field
                            v-model="item.sub_title"
                            :error-messages="$page.props.errors['section_five_items.'+index +'.sub_title']"
                            dense
                            label="العنوان الفرعي"
                            outlined
                            placeholder="العنوان الفرعي"
                            prepend-inner-icon="mdi-text-long"
                          ></v-text-field>
                        </v-col>

                        <v-btn
                          class="mt-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                          color="red"
                          dark
                          @click="deleteSectionFiveItem(index)"
                        >حذف
                        </v-btn>
                      </v-row>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center  mb-3">
                      <v-card-title>التحكم بالسيكشن السادس</v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_section_six_item"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة عنصر جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <v-row>
                        <v-col
                          cols="12">
                          <v-text-field
                            v-model="form.section_six_item.title"
                            :error-messages="$page.props.errors['section_six_item.title']"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>

                      </v-row>
                      <v-row v-for="(item,index) in form.section_six_items" :key="index">
                        <div class="image-input mb-2">
                          <div
                            :style="
                                  item.preview_image != undefined
                                    ? { 'background-image': `url(${item.preview_image})` }
                                    : { 'background-image': `url(${item.preview_image})` }
                                "
                            class="image-input-wrapper"
                          ></div>

                          <label class="btn-icon btn-add" data-original-title="Change avatar">
                            <svg
                              height="12"
                              viewBox="0 0 512 512"
                              width="12"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                fill="#6e6d6d"/>
                            </svg>
                            <input
                              accept=".png, .jpg, .jpeg,.svg"
                              name="profile_avatar"
                              type="file"
                              @change="previewSectionSixImage($event , index)"
                            />

                            <input name="profile_avatar_remove" type="hidden"/>
                          </label>
                        </div>
                        <div v-if="$page.props.errors['section_six_items.' + index + '.image']"
                             class="error--text">
                          {{ $page.props.errors['section_six_items.' + index + '.image'] }}
                        </div>
                        <v-col
                          cols="3">
                          <v-text-field
                            v-model="item.title"
                            :error-messages="$page.props.errors['section_six_items.'+index +'.title']"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="2">
                          <v-text-field
                            v-model="item.sub_title"
                            :error-messages="$page.props.errors['section_six_items.'+index +'.sub_title']"
                            dense
                            label="العنوان الفرعي"
                            outlined
                            placeholder="العنوان الفرعي"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="3">
                          <v-text-field
                            v-model="item.button_url"
                            :error-messages="$page.props.errors['section_six_items.'+index +'.button_url']"
                            dense
                            label="الرابط"
                            outlined
                            placeholder="الرابط"
                            prepend-inner-icon="mdi-link"
                          ></v-text-field>
                        </v-col>


                        <v-btn
                          class="mt-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                          color="red"
                          dark
                          @click="deleteSectionSixItem(index)"
                        >حذف
                        </v-btn>
                      </v-row>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center  mb-3">
                      <v-card-title>التحكم بالسيكشن السابع</v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_section_seven_item"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة عنصر جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <v-row>
                        <v-col
                          cols="12">
                          <v-text-field
                            v-model="form.section_seven_item.title"
                            :error-messages="$page.props.errors['section_seven_item.title']"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>

                      </v-row>
                      <v-row v-for="(item,index) in form.section_seven_items" :key="index">
                        <div class="image-input mb-2">
                          <div
                            :style="
                                  item.preview_image != undefined
                                    ? { 'background-image': `url(${item.preview_image})` }
                                    : { 'background-image': `url(${item.preview_image})` }
                                "
                            class="image-input-wrapper"
                          ></div>

                          <label class="btn-icon btn-add" data-original-title="Change avatar">
                            <svg
                              height="12"
                              viewBox="0 0 512 512"
                              width="12"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                fill="#6e6d6d"/>
                            </svg>
                            <input
                              accept=".png, .jpg, .jpeg,.svg"
                              name="profile_avatar"
                              type="file"
                              @change="previewSectionSevenImage($event , index)"
                            />

                            <input name="profile_avatar_remove" type="hidden"/>
                          </label>
                        </div>
                        <div v-if="$page.props.errors['section_seven_items.' + index + '.image']"
                             class="error--text">
                          {{ $page.props.errors['section_seven_items.' + index + '.image'] }}
                        </div>
                        <v-col
                          cols="4">
                          <v-text-field
                            v-model="item.title"
                            :error-messages="$page.props.errors['section_seven_items.'+index +'.title']"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>

                        <v-col
                          cols="4">
                          <v-text-field
                            v-model="item.sub_title"
                            :error-messages="$page.props.errors['section_seven_items.'+index +'.sub_title']"
                            dense
                            label="العنوان الفرعي"
                            outlined
                            placeholder="العنوان الفرعي"
                            prepend-inner-icon="mdi-text-long"
                          ></v-text-field>
                        </v-col>

                        <v-btn
                          class="mt-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                          color="red"
                          dark
                          @click="deleteSectionSevenItem(index)"
                        >حذف
                        </v-btn>
                      </v-row>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center mb-3">
                      <v-card-title>التحكم بالسيكشن التاسع</v-card-title>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row>

                          <v-col
                            cols="6">
                            <v-text-field
                              v-model="form.section_nine_item.title"
                              :error-messages="$page.props.errors['section_nine_item.title']"
                              dense
                              label="العنوان"
                              outlined
                              placeholder="العنوان"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>


                          <v-col
                            cols="3"
                          >
                            <v-text-field
                              v-model="form.section_nine_item.button_text"
                              :error-messages="$page.props.errors['section_nine_item.button_text']"
                              dense
                              label="عنوان الزر"
                              outlined
                              placeholder="عنوان الزر"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="3"
                          >
                            <v-text-field
                              v-model="form.section_nine_item.button_url"
                              :error-messages="$page.props.errors['section_nine_item.button_url']"
                              dense
                              label="رابط الزر"
                              outlined
                              placeholder="رابط الزر"
                              prepend-inner-icon="mdi-button-cursor"
                            ></v-text-field>
                          </v-col>

                        </v-row>

                        <v-row>
                          <v-col
                            cols="12"
                          >
                            <v-textarea
                              v-model="form.section_nine_item.paragraph"
                              :error-messages="$page.props.errors['section_nine_item.paragraph']"
                              label="الفقرة"
                              outlined
                              prepend-inner-icon="mdi-comment"
                              rows="1"
                            ></v-textarea>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center  mb-3">
                      <v-card-title>التحكم بالسيكشن العاشر</v-card-title>
                      <!--                      <v-btn-->
                      <!--                        class="ml-3 v-btn v-btn&#45;&#45;is-elevated v-btn&#45;&#45;has-bg theme&#45;&#45;dark v-size&#45;&#45;default primary"-->
                      <!--                        color="primary"-->
                      <!--                        dark-->
                      <!--                        @click="add_new_section_ten_item"-->
                      <!--                      >-->
                      <!--                        <v-icon>-->
                      <!--                          mdi-plus-->
                      <!--                        </v-icon>-->
                      <!--                        إضافة عنصر جديد-->
                      <!--                      </v-btn>-->
                    </div>
                    <v-card-text>
                      <v-row>
                        <v-col
                          cols="12">
                          <v-text-field
                            v-model="form.section_ten_item.title"
                            :error-messages="$page.props.errors['section_ten_item.title']"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>

                        <v-col
                          cols="12"
                        >
                          <v-textarea
                            v-model="form.section_ten_item.paragraph"
                            :error-messages="$page.props.errors['section_ten_item.paragraph']"
                            label="الفقرة"
                            outlined
                            prepend-inner-icon="mdi-comment"
                            rows="1"
                          ></v-textarea>
                        </v-col>


                      </v-row>

                      <!--                      <v-row v-for="(item,index) in form.section_ten_items" :key="index">-->
                      <!--                        <v-col cols="12" lg="2">-->
                      <!--                          <div class="image-input mb-2">-->
                      <!--                            <div-->
                      <!--                              :style="-->
                      <!--                                  item.preview_image != undefined-->
                      <!--                                    ? { 'background-image': `url(${item.preview_image})` }-->
                      <!--                                    : { 'background-image': `url(${item.preview_image})` }-->
                      <!--                                "-->
                      <!--                              class="image-input-wrapper"-->
                      <!--                            ></div>-->

                      <!--                            <label class="btn-icon btn-add" data-original-title="Change avatar">-->
                      <!--                              <svg-->
                      <!--                                height="12"-->
                      <!--                                viewBox="0 0 512 512"-->
                      <!--                                width="12"-->
                      <!--                                xmlns="http://www.w3.org/2000/svg"-->
                      <!--                              >-->
                      <!--                                <path-->
                      <!--                                  d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"-->
                      <!--                                  fill="#6e6d6d"/>-->
                      <!--                              </svg>-->
                      <!--                              <input-->
                      <!--                                accept=".png, .jpg, .jpeg"-->
                      <!--                                name="profile_avatar"-->
                      <!--                                type="file"-->
                      <!--                                @change="previewSectionTenImage($event , index)"-->
                      <!--                              />-->

                      <!--                              <input name="profile_avatar_remove" type="hidden"/>-->
                      <!--                            </label>-->
                      <!--                          </div>-->

                      <!--                        </v-col>-->
                      <!--                        <v-col cols="12" lg="10">-->
                      <!--                          <v-row>-->
                      <!--                            <v-col cols="12" lg="3">-->
                      <!--                              <v-text-field-->
                      <!--                                v-model="item.title"-->
                      <!--                                :error-messages="$page.props.errors['section_ten_items.'+index +'.title']"-->
                      <!--                                dense-->
                      <!--                                label="الإسم"-->
                      <!--                                outlined-->
                      <!--                                placeholder="الإسم"-->
                      <!--                                prepend-inner-icon="mdi-account"-->
                      <!--                              ></v-text-field>-->
                      <!--                            </v-col>-->
                      <!--                            <v-col cols="12" lg="3">-->
                      <!--                              <v-text-field-->
                      <!--                                v-model="item.sub_title"-->
                      <!--                                :error-messages="$page.props.errors['section_ten_items.'+index +'.sub_title']"-->
                      <!--                                dense-->
                      <!--                                label="المسمى  "-->
                      <!--                                outlined-->
                      <!--                                placeholder="المسمى  "-->
                      <!--                                prepend-inner-icon="mdi-account-child-circle"-->
                      <!--                              ></v-text-field>-->
                      <!--                            </v-col>-->
                      <!--                            <v-col cols="12" lg="3">-->
                      <!--                              <v-text-field-->
                      <!--                                v-model="item.twitter_url"-->
                      <!--                                :error-messages="$page.props.errors['section_ten_items.'+index +'.twitter_url']"-->
                      <!--                                dense-->
                      <!--                                label="رابط التويتر  "-->
                      <!--                                outlined-->
                      <!--                                placeholder="رابط التويتر  "-->
                      <!--                                prepend-inner-icon="mdi-twitter"-->
                      <!--                              ></v-text-field>-->
                      <!--                            </v-col>-->
                      <!--                          </v-row>-->
                      <!--                          <v-row>-->

                      <!--                            <v-col cols="12" lg="3">-->
                      <!--                              <v-text-field-->
                      <!--                                v-model="item.facebook_url"-->
                      <!--                                :error-messages="$page.props.errors['section_ten_items.'+index +'.facebook_url']"-->
                      <!--                                dense-->
                      <!--                                label="رابط الفيس بوك  "-->
                      <!--                                outlined-->
                      <!--                                placeholder="رابط الفيس بوك  "-->
                      <!--                                prepend-inner-icon="mdi-facebook"-->
                      <!--                              ></v-text-field>-->
                      <!--                            </v-col>-->
                      <!--                            <v-col cols="12" lg="3">-->
                      <!--                              <v-text-field-->
                      <!--                                v-model="item.instagram_url"-->
                      <!--                                :error-messages="$page.props.errors['section_ten_items.'+index +'.instagram_url']"-->
                      <!--                                dense-->
                      <!--                                label="رابط الانستجرام  "-->
                      <!--                                outlined-->
                      <!--                                placeholder="رابط الانستجرام  "-->
                      <!--                                prepend-inner-icon="mdi-instagram"-->
                      <!--                              ></v-text-field>-->
                      <!--                            </v-col>-->
                      <!--                            <v-col cols="12" lg="3">-->
                      <!--                              <v-text-field-->
                      <!--                                v-model="item.linked_in_url"-->
                      <!--                                :error-messages="$page.props.errors['section_ten_items.'+index +'.linked_in_url']"-->
                      <!--                                dense-->
                      <!--                                label="رابط اللينكد ان  "-->
                      <!--                                outlined-->
                      <!--                                placeholder="رابط اللينكد ان  "-->
                      <!--                                prepend-inner-icon="mdi-linkedin"-->
                      <!--                              ></v-text-field>-->
                      <!--                            </v-col>-->
                      <!--                            <v-col cols="12" lg="3">-->
                      <!--                              <v-btn-->
                      <!--                                class="mt-3 v-btn v-btn&#45;&#45;is-elevated v-btn&#45;&#45;has-bg theme&#45;&#45;dark v-size&#45;&#45;default danger"-->
                      <!--                                color="red"-->
                      <!--                                dark-->
                      <!--                                @click="deleteSectionTenItem(index)"-->
                      <!--                              >حذف-->
                      <!--                              </v-btn>-->
                      <!--                            </v-col>-->
                      <!--                          </v-row>-->
                      <!--                        </v-col>-->
                      <!--                      </v-row>-->
                      <!--                      <v-row>-->


                      <!--                      </v-row>-->
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center mb-3">
                      <v-card-title>التحكم بالسيكشن الحادي عشر</v-card-title>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <div class="text-center  mb-5">
                          <div class="image-input">
                            <div
                              :style="
                                  form.section_eleven_item.preview_image != undefined
                                    ? { 'background-image': `url(${ form.section_eleven_item.preview_image})` }
                                    : { 'background-image': `url(${ form.section_eleven_item.preview_image})` }
                                "
                              class="image-input-wrapper"
                            ></div>

                            <label class="btn-icon btn-add" data-original-title="Change avatar">
                              <svg
                                height="12"
                                viewBox="0 0 512 512"
                                width="12"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                  fill="#6e6d6d"/>
                              </svg>
                              <input
                                accept=".png, .jpg, .jpeg ,.svg"
                                name="profile_avatar"
                                type="file"
                                @change="previewSectionElevenImage($event )"
                              />

                              <input name="profile_avatar_remove" type="hidden"/>
                            </label>
                          </div>
                        </div>
                        <v-row>

                          <v-col
                            cols="6">
                            <v-text-field
                              v-model="form.section_eleven_item.title"
                              :error-messages="$page.props.errors['section_eleven_item.title']"
                              dense
                              label="العنوان"
                              outlined
                              placeholder="العنوان"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>

                          <v-col
                            cols="3"
                          >
                            <v-text-field
                              v-model="form.section_eleven_item.button_text"
                              :error-messages="$page.props.errors['section_eleven_item.button_text']"
                              dense
                              label="عنوان الزر"
                              outlined
                              placeholder="عنوان الزر"
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>
                          <v-col
                            cols="3"
                          >
                            <v-text-field
                              v-model="form.section_eleven_item.button_url"
                              :error-messages="$page.props.errors['section_eleven_item.button_url']"
                              dense
                              label="رابط الزر"
                              outlined
                              placeholder="رابط الزر"
                              prepend-inner-icon="mdi-button-cursor"
                            ></v-text-field>
                          </v-col>

                        </v-row>

                        <v-row>
                          <v-col
                            cols="12"
                          >
                            <v-textarea
                              v-model="form.section_eleven_item.paragraph"
                              :error-messages="$page.props.errors['section_eleven_item.paragraph']"
                              label="الفقرة"
                              outlined
                              prepend-inner-icon="mdi-comment"
                              rows="1"
                            ></v-textarea>
                          </v-col>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>

              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center  mb-3">
                      <v-card-title>التحكم بالسيكشن الاخير</v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_section_twelve_item"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة عنصر جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <v-row>
                        <v-col
                          cols="12">
                          <v-text-field
                            v-model="form.section_twelve_item.title"
                            :error-messages="$page.props.errors['section_twelve_item.title']"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>

                      </v-row>
                      <v-row v-for="(item,index) in form.section_twelve_items" :key="index">
                        <div class="image-input mb-2">
                          <div
                            :style="
                                  item.preview_image != undefined
                                    ? { 'background-image': `url(${item.preview_image})` }
                                    : { 'background-image': `url(${item.preview_image})` }
                                "
                            class="image-input-wrapper"
                          ></div>

                          <label class="btn-icon btn-add" data-original-title="Change avatar">
                            <svg
                              height="12"
                              viewBox="0 0 512 512"
                              width="12"
                              xmlns="http://www.w3.org/2000/svg"
                            >
                              <path
                                d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                fill="#6e6d6d"/>
                            </svg>
                            <input
                              accept=".png, .jpg, .jpeg ,.svg"
                              name="profile_avatar"
                              type="file"
                              @change="previewSectionTwelveImage($event , index)"
                            />

                            <input name="profile_avatar_remove" type="hidden"/>
                          </label>
                        </div>
                        <div v-if="$page.props.errors['section_twelve_items.' + index + '.image']"
                             class="error--text">
                          {{ $page.props.errors['section_twelve_items.' + index + '.image'] }}
                        </div>
                        <v-col
                          cols="3">
                          <v-text-field
                            v-model="item.title"
                            :error-messages="$page.props.errors['section_twelve_items.' + index + '.title']"
                            dense
                            label="الاسم"
                            outlined
                            placeholder="الاسم"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>

                        <v-col
                          cols="3">
                          <v-text-field
                            v-model="item.sub_title"
                            :error-messages="$page.props.errors['section_twelve_items.' + index + '.sub_title']"
                            dense
                            label="  المسمى"
                            outlined
                            placeholder="المسمى  "
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>
                        <v-col cols="3">
                          <v-textarea
                            v-model="item.paragraph"
                            :error-messages="$page.props.errors['section_twelve_items.' + index + '.paragraph']"
                            label="الفقرة"
                            outlined
                            prepend-inner-icon="mdi-comment"
                            rows="1"
                          ></v-textarea>
                        </v-col>

                        <v-btn
                          class="mt-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                          color="red"
                          dark
                          @click="deleteSectionTwelveItem(index)"
                        >حذف
                        </v-btn>
                      </v-row>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>

              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center  mb-3">
                      <v-card-title>مواقع التواصل الاجتماعي</v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_social_media_item"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة موقع جديد
                      </v-btn>
                    </div>
                    <v-card-text>

                      <v-row v-for="(item,index) in form.social_media_items" :key="index">

                        <v-col
                          cols="5"
                        >
                          <v-text-field
                            v-model="item.url"
                            :error-messages="$page.props.errors['social_media_items.' + index + '.url']"
                            dense
                            label="الرابط "
                            outlined
                            placeholder="الرابط  "
                            prepend-inner-icon="mdi-button-cursor"
                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="12"
                          md="6"
                        >
                          <v-select
                            v-model="item.title"
                            :error-messages="$page.props.errors['social_media_items.' + index + '.title']"
                            :items="social_media_names"
                            dense
                            item-text="name"
                            item-value="id"
                            label="المنصة"
                            outlined
                            prepend-inner-icon="mdi-account-credit-card-outline"
                          ></v-select>
                        </v-col>
                        <v-btn
                          class="mt-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                          color="red"
                          dark
                          @click="deleteSocialMediaItem(index)"
                        >حذف
                        </v-btn>
                      </v-row>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center  mb-3">
                      <v-card-title>التحكم بالفوتر</v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_footer_item"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة رابط جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <v-row>
                        <v-col
                          cols="12">
                          <v-textarea
                            v-model="form.footer_item.paragraph"
                            :error-messages="$page.props.errors['footer_item.paragraph']"
                            label="النص"
                            outlined
                            prepend-inner-icon="mdi-comment"
                            rows="1"
                          ></v-textarea>

                        </v-col>

                      </v-row>
                      <v-row v-for="(item,index) in form.footer_items" :key="index">
                        <v-col
                          cols="5"
                        >
                          <v-text-field
                            v-model="item.button_text"
                            :error-messages="$page.props.errors['footer_items.' + index + '.button_text']"
                            dense
                            label="عنوان الرابط "
                            outlined
                            placeholder="عنوان الرابط   "
                            prepend-inner-icon="mdi-button-cursor"
                          ></v-text-field>
                        </v-col>
                        <v-col
                          cols="5"
                        >
                          <v-text-field
                            v-model="item.button_url"
                            :error-messages="$page.props.errors['footer_items.' + index + '.button_url']"
                            dense
                            label="الرابط "
                            outlined
                            placeholder="الرابط  "
                            prepend-inner-icon="mdi-button-cursor"
                          ></v-text-field>
                        </v-col>

                        <v-btn
                          class="mt-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                          color="red"
                          dark
                          @click="deleteFooterItem(index)"
                        >حذف
                        </v-btn>
                      </v-row>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>
              <v-row class="match-height">
                <v-col
                  cols="12"
                  md="12"
                >
                  <v-card>
                    <div class="d-flex justify-space-between align-center  mb-3">
                      <v-card-title>التحكم بالشركاء </v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_partner_item"
                      >
                        <v-icon>
                          mdi-plus
                        </v-icon>
                        إضافة شريك جديد
                      </v-btn>
                    </div>
                    <v-card-text>
                      <div id="rows">
                        <v-row v-for="(item,index) in form.partner_items" :key="index">

                          <div class="image-input mb-2">
                            <div
                              :style="
                                  item.preview_image != undefined
                                    ? { 'background-image': `url(${item.preview_image})` }
                                    : { 'background-image': `url(${item.preview_image})` }
                                "
                              class="image-input-wrapper"
                            ></div>

                            <label class="btn-icon btn-add" data-original-title="Change avatar">
                              <svg
                                height="12"
                                viewBox="0 0 512 512"
                                width="12"
                                xmlns="http://www.w3.org/2000/svg"
                              >
                                <path
                                  d="M410.3 231l11.3-11.3-33.9-33.9-62.1-62.1L291.7 89.8l-11.3 11.3-22.6 22.6L58.6 322.9c-10.4 10.4-18 23.3-22.2 37.4L1 480.7c-2.5 8.4-.2 17.5 6.1 23.7s15.3 8.5 23.7 6.1l120.3-35.4c14.1-4.2 27-11.8 37.4-22.2L387.7 253.7 410.3 231zM160 399.4l-9.1 22.7c-4 3.1-8.5 5.4-13.3 6.9L59.4 452l23-78.1c1.4-4.9 3.8-9.4 6.9-13.3l22.7-9.1v32c0 8.8 7.2 16 16 16h32zM362.7 18.7L348.3 33.2 325.7 55.8 314.3 67.1l33.9 33.9 62.1 62.1 33.9 33.9 11.3-11.3 22.6-22.6 14.5-14.5c25-25 25-65.5 0-90.5L453.3 18.7c-25-25-65.5-25-90.5 0zm-47.4 168l-144 144c-6.2 6.2-16.4 6.2-22.6 0s-6.2-16.4 0-22.6l144-144c6.2-6.2 16.4-6.2 22.6 0s6.2 16.4 0 22.6z"
                                  fill="#6e6d6d"/>
                              </svg>
                              <input
                                accept=".png, .jpg, .jpeg ,.svg"
                                name="profile_avatar"
                                type="file"
                                @change="previewPartnerImage($event , index)"
                              />

                              <input name="profile_avatar_remove" type="hidden"/>
                            </label>
                          </div>
                          <div v-if="$page.props.errors['partner_items.' + index + '.image']"
                               class="error--text">
                            {{ $page.props.errors['partner_items.' + index + '.image'] }}
                          </div>

                          <v-col
                            cols="6"
                          >
                            <v-text-field
                              v-model="item.button_url"
                              :error-messages="$page.props.errors['partner_items.' + index + '.button_url']"
                              dense
                              label="  الرابط"
                              outlined
                              placeholder="الرابط  "
                              prepend-inner-icon="mdi-format-title"
                            ></v-text-field>
                          </v-col>

                          <v-btn
                            class="mt-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default danger"
                            color="red"
                            dark
                            @click="deletePartnerItem(index)"
                          >حذف
                          </v-btn>
                        </v-row>
                      </div>
                    </v-card-text>
                  </v-card>
                </v-col>
              </v-row>

            </v-card-text>
            <v-card-actions>
              <v-row>
                <v-col cols="12">
                  <v-btn :loading="form.processing"
                         class=" mx-2 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default  "
                         color="#0007a5"
                         type="submit">
                    <v-icon>
                      mdi-plus
                    </v-icon>
                    حفظ
                  </v-btn>
                </v-col>
              </v-row>
            </v-card-actions>
          </v-form>
        </v-card>
      </v-col>
    </v-row>
  </v-container>
</template>
<script>

export default {
  name: "Create",
  props: {
    header_items: Array,
    section_one_item: Object,
    section_two_item: Object,
    section_three_items: Array,
    section_three_item: Object,
    section_four_item: Object,
    section_five_items: Array,
    section_five_item: Object,
    section_six_item: Object,
    section_six_items: Array,
    section_seven_item: Object,
    section_seven_items: Array,
    section_eleven_item: Object,
    section_nine_item: Object,
    section_ten_item: Object,
    section_ten_items: Array,
    section_twelve_item: Object,
    section_twelve_items: Array,
    social_media_items: Array,
    footer_item: Object,
    slider_items: Array,
    footer_items: Array,
    partner_items:Array

  },
  data() {
    return {
      form: this.$inertia.form({
        header_items: this.header_items,
        section_one_item: this.section_one_item,
        section_two_item: this.section_two_item,
        section_three_items: this.section_three_items,
        section_three_item: this.section_three_item,
        section_four_item: this.section_four_item,
        slider_items: this.slider_items,

        section_five_items: this.section_five_items,
        section_five_item: this.section_five_item,
        section_eleven_item: this.section_eleven_item,

        section_six_items: this.section_six_items,
        section_six_item: this.section_six_item,

        social_media_items: this.social_media_items,
        section_seven_items: this.section_seven_items,
        section_seven_item: this.section_seven_item,

        section_nine_item: this.section_nine_item,


        section_ten_item: this.section_ten_item,
        section_ten_items: this.section_ten_items,

        section_twelve_item: this.section_twelve_item,
        section_twelve_items: this.section_twelve_items,
        footer_item: this.footer_item,
        footer_items: this.footer_items,
        partner_items:this.partner_items
      }),
      social_media_names: [
        {
          id: 1,
          name: 'فيس بوك'
        },
        {
          id: 2,
          name: 'انستغرام'
        },
        {
          id: 3,
          name: 'واتس اب'
        },
        {
          id: 4,
          name: 'لينكد ان'
        },
        {
          id: 5,
          name: 'تويتر'
        },
        {
          id: 6,
          name: 'يوتيوب'
        },


      ],
    }
  },
  methods: {
    submit() {
      this.form.post('/admin/main_page_control',
        {
          onError: (errors) => {
          }
        })
    },

    previewSectionThreeImage(event, index) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_three_items[index].preview_image = e.target.result;
          this.form.section_three_items[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewSectionOneImage(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_one_item.preview_image = e.target.result;
          this.form.section_one_item.image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewSliderImage(event, index) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.slider_items[index].preview_image = e.target.result;
          this.form.slider_items[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewSectionTwoImage(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_two_item.preview_image = e.target.result;
          this.form.section_two_item.image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewSectionFourImage(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_four_item.preview_image = e.target.result;
          this.form.section_four_item.image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    previewSectionNineImage(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_nine_item.preview_image = e.target.result;
          this.form.section_nine_item.image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewSectionTenImage(event, index) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_ten_items[index].preview_image = e.target.result;
          this.form.section_ten_items[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    previewSectionElevenImage(event) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_eleven_item.preview_image = e.target.result;
          this.form.section_eleven_item.image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewSectionTwelveImage(event, index) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_twelve_items[index].preview_image = e.target.result;
          this.form.section_twelve_items[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    previewSectionFiveImage(event, index) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_five_items[index].preview_image = e.target.result;
          this.form.section_five_items[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    previewSectionSixImage(event, index) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_six_items[index].preview_image = e.target.result;
          this.form.section_six_items[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    previewSectionSevenImage(event, index) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.section_seven_items[index].preview_image = e.target.result;
          this.form.section_seven_items[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewPrizeImage(event, index) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.prize_section_item.preview_image = e.target.result;
          this.form.prize_section_item.image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },
    previewPartnerImage(event, index) {
      var input = event.target;
      if (input.files && input.files[0]) {
        var reader = new FileReader();
        reader.onload = (e) => {
          this.form.partner_items[index].preview_image = e.target.result;
          this.form.partner_items[index].image = input.files[0];
        };
        reader.readAsDataURL(input.files[0]);
      }
    },

    add_new_social_media_item() {
      this.form.social_media_items.push({
        url: null,
        title: null,
        type: "new"
      })
    },
    add_new_section_three_item() {
      this.form.section_three_items.push({
        title: null,
        sub_title: null,
        image: null,
        preview_image: null,
        type: "new"
      })
    },
    add_new_section_twelve_item() {
      this.form.section_twelve_items.push({
        title: null,
        sub_title: null,
        image: null,
        preview_image: null,
        type: "new"
      })
    },
    add_new_section_five_item() {
      this.form.section_five_items.push({
        title: null,
        sub_title: null,
        image: null,
        preview_image: '/get_file/website_images/logo.jfif',
        type: "new"
      })
    },
    add_new_slider_item() {
      this.form.slider_items.push({
        title: null,
        paragraph: null,
        image: null,
        button_text: null,
        button_url: null,
        preview_image: '/get_file/website_images/logo.jfif',
        type: "new"
      })
    },

    add_new_section_six_item() {
      this.form.section_six_items.push({
        title: null,
        sub_title: null,
        image: null,
        preview_image: '/get_file/website_images/logo.jfif',
        type: "new",
        button_url:null
      })
    },

    add_new_section_seven_item() {
      this.form.section_seven_items.push({
        title: null,
        sub_title: null,
        image: null,
        preview_image: '/get_file/website_images/logo.jfif',
        type: "new"
      })
    },

    add_new_section_ten_item() {
      this.form.section_ten_items.push({
        title: null,
        image: null,
        preview_image: '/get_file/website_images/logo.jfif',
        type: "new"
      })
    },
    add_new_about_us_item() {
      this.form.about_us_items.push({
        title: null,
        sub_title: null,
        type: "new"
      })
    },
    add_new_social_media_item() {
      this.form.social_media_items.push({
        url: null,
        title: null,
        type: "new"
      })
    },
    add_new_partner_item() {
      this.form.partner_items.push({
         button_url: null,
        image: null,
        preview_image: '/get_file/website_images/logo.jfif',
        type: "new"
      })
    }, add_new_footer_item() {
      this.form.footer_items.push({
        button_text: null,
        button_url: null,
        type: "new"
      })
    },
    deleteSliderItem(index) {
      this.form.slider_items.splice(index, 1)
    },
    deleteSocialMediaItem(index) {
      this.form.social_media_items.splice(index, 1)
    },
    deleteSectionThreeItem(index) {
      this.form.section_three_items.splice(index, 1)
    },
    deleteSectionTwelveItem(index) {
      this.form.section_twelve_items.splice(index, 1)
    },

    deleteSectionFiveItem(index) {
      this.form.section_five_items.splice(index, 1)
    },
    deleteSectionTenItem(index) {
      this.form.section_ten_items.splice(index, 1)
    },
    deleteSectionSixItem(index) {
      this.form.section_six_items.splice(index, 1)
    },
    deleteSectionSevenItem(index) {
      this.form.section_seven_items.splice(index, 1)
    },
    deleteItem(index) {
      this.form.header_items.splice(index, 1)
    },
    deleteFooterItem(index) {
      this.form.footer_items.splice(index, 1)
    },
    deletePartnerItem(index) {
      this.form.partner_items.splice(index, 1)
    },
  },
}
</script>

<style>
.v-list-item--dense .v-list-item__title,
.v-list-item--dense .v-list-item__subtitle,
.v-list--dense .v-list-item .v-list-item__title,
.v-list--dense .v-list-item .v-list-item__subtitle {
  font-size: 0.8125rem;
  font-weight: 500;
  line-height: 2rem;
}

v-card-title {
  color: black !important;
}

</style>
<style lang="scss">
.image-input {
  //margin: 60px 100px;
  position: relative;
  display: inline-block;
  border-radius: 0.42rem;
  background-repeat: no-repeat;
  background-size: cover;

  .image-input-wrapper {
    width: 120px;
    height: 120px;
    border-radius: 0.42rem;
    background-repeat: no-repeat;
    background-size: cover;
    border: 3px solid #ffffff;
    -webkit-box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.075);
    box-shadow: 0 0.5rem 1.5rem 0.5rem rgba(0, 0, 0, 0.075);
    color: #3f4254;
    background-color: #ffffff;
    border-color: #ffffff;
    display: -webkit-inline-box;
    display: -ms-inline-flexbox;
    display: inline-flex;
    -webkit-box-align: center;
    -ms-flex-align: center;
    align-items: center;
    -webkit-box-pack: center;
    -ms-flex-pack: center;
    justify-content: center;
    padding: 0;
    font-size: 1rem;
    font-weight: 400;
    outline: none !important;
    vertical-align: middle;
  }

  input {
    width: 0 !important;
    height: 0 !important;
    overflow: hidden;
    opacity: 0;
  }

  .btn-icon {
    -webkit-box-shadow: 0px 9px 16px 0px rgba(24, 28, 50, 0.25) !important;
    box-shadow: 0px 9px 16px 0px rgba(24, 28, 50, 0.25) !important;
    border-radius: 50%;
    height: 24px;
    width: 24px;
    background-color: #fff;
    cursor: pointer;
    display: flex;
    align-items: center;
    justify-content: center;

    &.btn-add {
      position: absolute;
      right: -10px;
      top: -10px;
    }

    &.btn-remove {
      position: absolute;
      right: -10px;
      bottom: -5px;
    }
  }
}
</style>
