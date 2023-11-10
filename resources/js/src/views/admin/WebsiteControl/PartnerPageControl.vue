<template>
  <v-container fluid>
    <v-row>
      <v-col cols="12" md="12" sm="12">
        <v-card>
          <v-toolbar class="header_title" color="#0007a5" dark>
            <v-row>
              <h3 class="mt-2" style="padding-right:13px">
                التحكم بصفحة الشركاء
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
                            <div v-if="$page.props.errors['slider_items.' + index + '.image']"
                                 class="error--text">
                              {{ $page.props.errors['slider_items.' + index + '.image'] }}
                            </div>
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
                          <div v-if="$page.props.errors['section_two_item.image']"
                               class="error--text">
                            {{ $page.props.errors['section_two_item.image'] }}
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
                      <v-card-title>التحكم بالسيكشن الثالث</v-card-title>
                      <v-btn
                        class="ml-3 v-btn v-btn--is-elevated v-btn--has-bg theme--dark v-size--default primary"
                        color="primary"
                        dark
                        @click="add_new_section_three_item"
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
                            v-model="form.section_three_item.title"
                            :error-messages="$page.props.errors['section_three_item.title']"
                            dense
                            label="العنوان"
                            outlined
                            placeholder="العنوان"
                            prepend-inner-icon="mdi-format-title"
                          ></v-text-field>
                        </v-col>

                      </v-row>
                      <v-row v-for="(item,index) in form.section_three_items" :key="index">
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
                              @change="previewSectionThreeImage($event , index)"
                            />

                            <input name="profile_avatar_remove" type="hidden"/>
                          </label>
                          <div v-if="$page.props.errors['section_three_items.' + index + '.image']"
                               class="error--text">
                            {{ $page.props.errors['section_three_items.' + index + '.image'] }}
                          </div>
                        </div>

                        <v-col
                          cols="4">
                          <v-text-field
                            v-model="item.title"
                            :error-messages="$page.props.errors['section_three_items.'+index +'.title']"
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
                            :error-messages="$page.props.errors['section_three_items.'+index +'.sub_title']"
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
                          @click="deleteSectionThreeItem(index)"
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
                            <div v-if="$page.props.errors['section_four_item.image']"
                                 class="error--text">
                              {{ $page.props.errors['section_four_item.image'] }}
                            </div>
                          </div>
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
                      <v-card-title>التحكم بالسيكشن الاخير</v-card-title>
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
                              accept=".png, .jpg, .jpeg ,.svg"
                              name="profile_avatar"
                              type="file"
                              @change="previewSectionSixImage($event , index)"
                            />

                            <input name="profile_avatar_remove" type="hidden"/>
                          </label>
                          <div v-if="$page.props.errors['section_six_items.' + index + '.image']"
                               class="error--text">
                            {{ $page.props.errors['section_six_items.' + index + '.image'] }}
                          </div>
                        </div>

                        <v-col
                          cols="3">
                          <v-text-field
                            v-model="item.title"
                            :error-messages="$page.props.errors['section_six_items.' + index + '.title']"
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
                            :error-messages="$page.props.errors['section_six_items.' + index + '.sub_title']"
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
                            :error-messages="$page.props.errors['section_six_items.' + index + '.paragraph']"
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
                          @click="deleteSectionSixItem(index)"
                        >حذف
                        </v-btn>
                      </v-row>
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
    section_two_item: Object,
    section_three_items: Array,
    section_three_item: Object,
    section_four_item: Object,
    section_six_item: Object,
    section_six_items: Array,
    slider_items: Array
  },
  data() {
    return {
      form: this.$inertia.form({
        section_one_item: this.section_one_item,
        section_two_item: this.section_two_item,
        section_three_items: this.section_three_items,
        section_three_item: this.section_three_item,
        section_four_item: this.section_four_item,
        slider_items: this.slider_items,
        section_six_items: this.section_six_items,
        section_six_item: this.section_six_item,

      }),
    }
  },
  methods: {
    submit() {
      this.form.post('/admin/partner_page_control',
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


    add_new_section_three_item() {
      this.form.section_three_items.push({
        title: null,
        sub_title: null,
        image: null,
        preview_image: null,
        type: "new"
      })
    },
    add_new_section_six_item() {
      this.form.section_six_items.push({
        title: null,
        sub_title: null,
        image: null,
        preview_image: null,
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


    deleteSliderItem(index) {
      this.form.slider_items.splice(index, 1)
    },

    deleteSectionThreeItem(index) {
      this.form.section_three_items.splice(index, 1)
    },
    deleteSectionSixItem(index) {
      this.form.section_six_items.splice(index, 1)
    },

    deleteItem(index) {
      this.form.header_items.splice(index, 1)
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
